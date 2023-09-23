<?php

namespace App\Models\OrderDetail;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail\Traits\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OrderDetail\Traits\Relationship\Relationship;

/**
 * Class OrderDetail
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */
class OrderDetail extends Model
{
    use HasFactory, Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "order_details";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "order_id",
        "product_id",
        "qty",
        "price",
        "total",
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
