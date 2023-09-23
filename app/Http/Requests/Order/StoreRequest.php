<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;

class StoreRequest extends FormRequest
{
    protected $customer = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $customerId = $request->get('customer_id');
        $customer = Customer::find($customerId);

        if($customer) {
            $this->setCustomer($customer);
        }

        return $customer ?? false;
    }

    /**
     * Set Customer
     * 
     * @param Customer $customer
     * @return self
     */
    private function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Get Customer
     * 
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => 'required'
        ];
    }
}
