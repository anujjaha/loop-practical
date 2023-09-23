<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product\Traits\Relationship\Relationship;

/**
 * Class Product
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */
class Product extends Model
{
    use HasFactory, Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_products";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "name", 
        "price",
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
