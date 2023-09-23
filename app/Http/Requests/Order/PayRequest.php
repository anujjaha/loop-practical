<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Order\Order;

class PayRequest extends FormRequest
{
    protected $order = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $orderId = $request->route('id');
        $order = Order::with(['details', 'customer'])->find($orderId);
        
        if($order) {
            $this->setOrder($order);
        }

        return $order && !$order->isPaid() ?? false;
    }

    /**
     * Set Order
     * 
     * @param Order $order
     * @return self
     */
    private function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get Product
     * 
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [];
    }
}
