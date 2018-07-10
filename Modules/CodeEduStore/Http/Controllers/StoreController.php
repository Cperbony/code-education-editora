<?php

namespace CodeEduStore\Http\Controllers;

use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\OrderRepository;
use CodeEduStore\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Stripe\Error\Card;

class StoreController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * StoreController constructor.
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        OrderRepository $orderRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = $this->productRepository->home();
        return view('codeedustore::store.home', compact('products'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($id)
    {
        $category = $this->categoryRepository->find($id);
        $products = $this->productRepository->findByCategory($id);
        return view('codeedustore::store.home', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = $this->productRepository->like($search);
        return view('codeedustore::store.search', compact('products'));
    }

    public function showProduct($slug)
    {
        $product = $this->productRepository->findBySlug($slug);
        return view('codeedustore::store.show-product', compact('product'));

    }

    public function checkout($id)
    {
        $product = $this->productRepository->find($id);
        return view('codeedustore::store.checkout-product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function process(Request $request, $id)
    {
//        dd($request->all());
        $productStore = $this->productRepository->makeProductStore($id);
        $user = $request->user();
        $token = $request->get('stripeToken');
        try {
            $order = $this->orderRepository->process($token, $user, $productStore);
            $status = true;

        } catch (Card $exception) {
            $status = false;
        }
        return view('codeedustore::store.process', compact('order', 'status'));

        //Efetuar oPagamento

        //Renderizar sucesso ou fracasso, sif true-> download.
    }

    public function orders()
    {
        $orders = $this->orderRepository->all();
        return view('codeedustore::store.orders', compact('orders'));
    }

}
