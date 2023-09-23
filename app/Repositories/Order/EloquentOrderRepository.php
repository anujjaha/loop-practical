<?php 

namespace App\Repositories\Order;

/**
 * Class EloquentOrderRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use Illuminate\Http\Request;
use App\Models\Order\Order;
use App\Exceptions\GeneralException;
use App\Http\Traits\SuperPayApiRequest;
use Illuminate\Support\Facades\Log;

class EloquentOrderRepository
{
    use SuperPayApiRequest;

    const PAYMENT_SUCCESSFULL_SUPER_PAY_RESPONSE = 'Payment Successful';

    /**
     * Order Model
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
        $this->model = new Order;
    }

    /**
     * Create Order
     *
     * @param array $input
     * @return Order|bool
     */
    public function create($input):? Order
    {
        return $this->model->create($this->prepareInputData($input));
    }

    /**
     * Update Product
     *
     * @param int $id
     * @param array $input
     * @return bool|Order
     */
    public function update(int $id, array $input)
    {
        $model = $this->model->find($id);
        
        return $model ? $model->update($this->prepareInputData($input, false)) : false;
    }

    /**
     * Destroy Product
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id)
    {
        $model = $this->model->find($id);

        return $model ? $model->delete() : false;
    }

    /**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return Collection
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
        return $this->model->with(['customer', 'details'])->orderBy($orderBy, $sort)->get();
    }

    /**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id = null)
    {
        return $id ? $this->model->with(['customer', 'details'])->find($id) : false;
    }
    
    /**
     * Prepare Input Data
     *
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = true): array
    {
        if($isCreate)
        {
            // if we need to process anything at time of creating, like attach created by id etc
        }

        return $input;
    }

    /**
     * Pay
     * 
     * @param Order $order
     * @return Order|bool
     */
    public function pay(Order $order)
    {
        if($order->isPayable()) {
            try {
                $payStatus = $this->makePayment([
                    "order_id"          => $order->id,
                    "customer_email"    => $order->customer->email,
                    "value"             => $order->details->sum('total')
                ]);

                if($payStatus && $payStatus->message == self::PAYMENT_SUCCESSFULL_SUPER_PAY_RESPONSE) {
                    $order->payed = 1;
                    $order->payed_response = $payStatus->message ?? 'paid';
                    $order->save();
                    
                    return $order;
                }
                
            } catch (Exception $e) {
                Log::info(sprintf('Payment failed for order id %s', $order->id));
                Log::info(sprintf('Received payment response with error: %s', $e->getMessage()));
                return false;
            }
        }

        return false;
    }
}
