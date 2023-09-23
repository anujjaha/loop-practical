<?php 

namespace App\Models\Order\Traits\Relationship;

use App\Models\Customer\Customer;
use App\Models\OrderDetail\OrderDetail;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */
trait Relationship
{
    /**
     * BelongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * HasMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}