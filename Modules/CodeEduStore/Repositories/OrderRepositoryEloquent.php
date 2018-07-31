<?php

namespace CodeEduStore\Repositories;

use CodeEduStore\Events\OrderPostProcessEvent;
use CodeEduStore\Models\Order;
use CodeEduStore\Models\ProducStore;
use CodeEduUser\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Stripe\Invoice;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    public function model()
    {
        return Order::class;
    }

    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }


    /**
     * @param $token
     * @param $user
     * @param ProducStore $productStore
     * @return ProducStore|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function process($token, $user, ProducStore $productStore)
    {
        $this->createCustomer($token, $user);
        /** @var Invoice $invoice */
        /** @var User $user */
        $invoice = $user->invoiceFor(
            "{$productStore->getId()} {$productStore->getName()}",
            $productStore->getPrice() * 100);
        $order = $this->create([
            'date_launch' => (new \DateTime())->format('Y-m-d'),
            'price' => $productStore->getPrice(),
            'user_id' => $user->id,
            'invoice_id' => $invoice->id
        ]);
        //Relacionar order com o produto
        $order->orderable()->associate($productStore->getProductOriginal());
        $order->save();
        event(new OrderPostProcessEvent($order));

        /** @var ProducStore $order */
        return $order;
    }

    protected function createCustomer($token, $user)
    {
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer($token);
        }
        $user->updateCard($token);
    }
}
