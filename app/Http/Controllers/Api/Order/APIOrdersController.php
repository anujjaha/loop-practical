<?php

namespace App\Http\Controllers\Api\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\Order\PayRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\AddProductRequest;
use App\Http\Transformers\Order\OrderTransformer;
use App\Repositories\Order\EloquentOrderRepository;

/**
 * APIOrdersController 
 */
class APIOrdersController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var EloquentOrderRepository
     */
    protected $orderRepository;

    /**
     * OrderTransform
     *
     * @var Object
     */
    protected $orderTransformer;

    const NO_ORDERS_FOUND_MESSAGE           = 'No orders found.';
    const ORDER_CREATED_MESSAGE             = 'Order created successfully.';
    const ORDER_CREATE_FAIL_MESSAGE         = 'Order fail to create.';
    const ORDER_PAID_SUCCESS_MESSAGE        = 'Order is paid successfully';
    const ORDER_PAID_REQUEST_FAIL_MESSAGE   = 'Order payment request failed';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->orderRepository = new EloquentOrderRepository;
        $this->orderTransformer = new OrderTransformer;
    }

    /**
     * List of All Orders
     *
     * @param Request $request
     * @return jsonResponse
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->getAll();
        if($orders && count($orders))
        {
            return $this->successResponse($this->orderTransformer->transformCollection($orders));
        }

        return $this->setStatusCode(404)->failureResponse(self::NO_ORDERS_FOUND_MESSAGE);
    }

    /**
     * Show Order
     *
     * @param Request $request
     * @param int $orderId
     *
     * @return jsonResponse
     */
    public function show(Request $request, int $orderId)
    {
        $order = $this->orderRepository->getById($orderId);
        if($order) {
            return $this->successResponse($this->orderTransformer->transform($order));
        }

        return $this->setStatusCode(404)->failureResponse(self::NO_ORDERS_FOUND_MESSAGE);
    }

    /**
     * Store Order
     *
     * @param StoreRequest $request
     * @return jsonResponse
     */
    public function store(StoreRequest $request)
    {
        $order = $this->orderRepository->create($request->all());

        if($order) {
            return $this->successResponse($this->orderTransformer->transform($order), self::ORDER_CREATED_MESSAGE);
        }

        return $this->setStatusCode(400)->failureResponse(self::ORDER_CREATE_FAIL_MESSAGE);
    }

    /**
     * Destroy Order
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request, int $orderId)
    {
        $status = $this->orderRepository->destroy($orderId);
        
        if($status) {
            return $this->setStatusCode(202)->successResponse();
        }
        
        return $this->setStatusCode(404)->failureResponse(self::NO_ORDERS_FOUND_MESSAGE);        
    }
    
    /**
     * Pay
     *
     * @param PayRequest $request
     * @return jsonResponse
     */
    public function pay(PayRequest $request)
    {
        $order = $request->getOrder();
        $status = $this->orderRepository->pay($order);

        if($status) {
            return $this->successResponse($this->orderTransformer->transform($order), self::ORDER_PAID_SUCCESS_MESSAGE);
        }

        return $this->setStatusCode(400)->failureResponse(self::ORDER_PAID_REQUEST_FAIL_MESSAGE);
    }
}
