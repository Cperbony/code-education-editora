<?php

namespace CodePub\Listeners;

use \CodeEduStore\Events\OrderPostProcessEvent;


class BookRankingUpdate
{

    /**
     * Handle the event.
     *
     * @param  OrderPostProcessEvent  $event
     * @return void
     */
    public function handle(OrderPostProcessEvent $event)
    {
        $order = $event->getOrder();
        $order->orderable->searchable();
    }
}
