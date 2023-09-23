<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Product\Product;

class AddProductRequest extends FormRequest
{
    protected $order = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $productId = $request->get('product_id');
        $product = Product::find($productId);

        if($product) {
            $this->setProduct($product);
        }

        return $product ?? false;
    }

    /**
     * Set Product
     * 
     * @param Product $product
     * @return self
     */
    private function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get Product
     * 
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required'
        ];
    }
}
