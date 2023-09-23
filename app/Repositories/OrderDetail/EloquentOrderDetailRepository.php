<?php 

namespace App\Repositories\OrderDetail;

/**
 * Class EloquentOrderDetailRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use Illuminate\Http\Request;
use App\Models\OrderDetail\OrderDetail;
use App\Models\Order\Order;
use App\Exceptions\GeneralException;

/**
 * EloquentOrderDetailRepository
 */
class EloquentOrderDetailRepository
{
    /**
     * OrderDetail Model
     *
     * @var Object
     */
    public $model;
    
    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new OrderDetail;
    }

    /**
     * Add Product
     * 
     * @param Request $request
     * @param int $orderId
     * @param Product $product
     *
     * @return Order|bool
     */
    public function addProduct($request, $orderId, $product)
    {
        $order = Order::find($orderId);
        
        if(isset($order->id) && !$order->isPaid()) {
            $qty = $request->get('qty') ?? 1;

            return $this->model->create([
                'order_id'      => $order->id,
                'product_id'    => $product->id,
                'qty'           => $qty,
                'price'         => $product->price,
                'total'         => $qty * $product->price,
            ]);
        }

        return false;
    }
}