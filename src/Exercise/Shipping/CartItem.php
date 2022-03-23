<?php

namespace App\Exercise\Shipping;

class CartItem
{
    private Product $product;
    private int $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }
}
