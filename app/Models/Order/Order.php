<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order\Traits\Relationship\Relationship;

/**
 * Class Order
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */
class Order extends Model
{
    use HasFactory, Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_orders";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "customer_id", 
        "payed",
        'payed_response'
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}
