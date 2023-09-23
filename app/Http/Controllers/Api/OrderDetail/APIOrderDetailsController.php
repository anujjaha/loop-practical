<?php

namespace App\Http\Controllers\Api\OrderDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\Order\AddProductRequest;
use App\Http\Transformers\OrderDetail\OrderDetailTransformer;
use App\Repositories\OrderDetail\EloquentOrderDetailRepository;

/**
 * Class APIOrderDetailsController
 */
class APIOrderDetailsController extends Controller
{
    use ApiResponseTrait;

    /**
     * EloquentOrderDetailRepository
     *
     * @var Object
     */
    protected $orderDetailRepo;

    /**
     * OrderDetailTransformer
     *
     * @var Object
     */
    protected $orderDetailTransformer;
    
    const NO_ORDER_FOUND_MESSAGE = 'No order found.';
    const ORDER_DETAIL_CREATED_MESSAGE = 'Order detail created successfully.';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->orderDetailRepo = new EloquentOrderDetailRepository;
        $this->orderDetailTransformer = new OrderDetailTransformer;
    }
    
    /**
     * Add Order Product
     *
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function addProduct(AddProductRequest $request, int $orderId)
    {
        $orderDetails = $this->orderDetailRepo->addProduct($request, $orderId, $request->getProduct());
        
        if($orderDetails) {
            return $this->successResponse($this->orderDetailTransformer->transform($orderDetails), self::ORDER_DETAIL_CREATED_MESSAGE);
        }
        
        return $this->setStatusCode(400)->failureResponse(self::NO_ORDER_FOUND_MESSAGE);
    }    
}
