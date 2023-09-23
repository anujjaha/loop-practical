<?php
namespace App\Http\Transformers\Order;

use App\Http\Transformers\Transformer;

class OrderTransformer extends Transformer
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
			"id"            => (int) $item->id,
            "payed"         => $item->payed,
            "payed_response"=> $item->payed_response,
            "customer"      => $item->customer,
            "details"       => $item->details,
		];
    }
}