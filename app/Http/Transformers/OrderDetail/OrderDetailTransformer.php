<?php
namespace App\Http\Transformers\OrderDetail;

use App\Http\Transformers\Transformer;

class OrderDetailTransformer extends Transformer
{
    /**
     * Transform
     *
     * @param array $data
     * @return array
     */
    public function transform($item)
    {
        if(is_array($item))
        {
            $item = (object)$item;
        }

        return [
			"id"        => (int) $item->id,
            "qty"       => $item->qty,
            "price"     => $item->price,
            "total"     => $item->total,
            "product"   => $item->product,
            "order"     => $item->order,
		];
    }
}
