<?php 

namespace App\Models\Order\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */
trait Attribute
{
    /**
     * Is Paid
     * 
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->payed == 1;
    }

    /**
     * Is Payable
     * 
     * @return bool
     */
    public function isPayable(): bool
    {
        return count($this->details);
    }
}