<?php

namespace App\Exercise\Shipping;

interface ShippingMethod
{
    public function calculatePrice(string $zipCode): float;
}
