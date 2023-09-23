<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Traits\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer\Traits\Relationship\Relationship;

/**
 * Class Customer
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */
class Customer extends Model
{
    use HasFactory, Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_customers";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "name", 
        "phone_number",
        "designation",
        "email",
        "registered_at",
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
