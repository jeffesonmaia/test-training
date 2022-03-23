<?php

namespace App\Exercise\Shipping;

class Cart
{
    private User $user;
    /** @var array<CartItem> */
    private array $items;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->items = [];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /** @return array<CartItem> */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotals(): float
    {
        $total = 0;
        /** @var CartItem $item */
        foreach ($this->getItems() as $item) {
            $product = $item->getProduct();
            $total += ($product->getPrice() * $item->getQty());
        }

        return $total;
    }

    public function addItem(Product $product, int $qty): void
    {
        /** @var CartItem $item */
        foreach ($this->getItems() as $key => $item) {
            $productItem = $item->getProduct();
            if ($productItem->getId() === $product->getId()) {
                $this->items[$key]->setQty($item->getQty() + $qty);
                return;
            }
        }
        $this->items[] = new CartItem($product, $qty);
    }

    public function removeItem(Product $product, int $qty = null): void
    {
        /** @var CartItem $item */
        foreach ($this->getItems() as $key => $item) {
            if ($product->getId() != $item->getProduct()->getId()) {
                continue;
            }
            if (!is_null($qty) || $item->getQty() <= $qty) {
                unset($this->items[$key]);
                break;
            }
            $this->items[$key]->setQty($item->getQty() - $qty);
        }
    }

    public function removeAllItems(): void
    {
        $this->items = [];
    }
}
