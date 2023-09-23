<?php 

namespace App\Models\Order\Traits\Relationship;

use App\Models\Order\Order;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */
trait OrderDetailRelationship
{
    /**
     * HasOne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}