<?php

namespace App\Exercise\Shipping;

class Cart
{
    private int $id;
    private User $user;
    /** @var Product[] */
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

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotals()
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            /** @var Product $product */
            $product = $item['product'];
            $total += ($product->getPrice() * $item['qty']);
        }

        return $total;
    }

    public function addItem(Product $product, int $qty): void
    {
        foreach ($this->getItems() as $key => $item) {
            /** @var Product $productItem */
            $productItem = $item['product'];
            if ($productItem->getId() === $product->getId()) {
                $this->items[$key]['qty'] += $qty;
                return;
            }
        }
        $this->items[] = [
            'product' => $product,
            'qty' => $qty,
        ];
    }

    public function removeItem(Product $product, int $qty = null): void
    {
        foreach ($this->getItems() as $key => $item) {
            /** @var Product $productItem */
            $productItem = $item['product'];
            if ($product->getId() != $productItem->getId()) {
                continue;
            }
            if (!is_null($qty) || $item['qty'] <= $qty) {
                unset($this->items[$key]);
                break;
            }
            $this->items[$key] = [
                'product' => $product,
                'qty' => ($item['qty'] - $qty)
            ];
        }
    }

    public function removeAllItems(): void
    {
        $this->items = [];
    }
}
