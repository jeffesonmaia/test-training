<?php

namespace App\Exercise\Shipping;

class ShippingService
{
    const FREE_SHIPPING_MIN_VALUE = 100;
    private ShippingMethod $shippingMethod;

    public function __construct(ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function calculate(Cart $cart): float
    {
        if ($cart->getTotals() >= self::FREE_SHIPPING_MIN_VALUE) {
            return 0;
        }

        return $this->shippingMethod->calculatePrice($cart->getUser()->getCep());
    }
}
