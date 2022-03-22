<?php

namespace App\Exercise\Shipping;

class PacCorreiosShippingMethod implements ShippingMethod
{
    public function calculatePrice(string $zipCode): float
    {
        return rand(50, 100);
    }
}
