<?php

use App\Exercise\Shipping\Cart;
use App\Exercise\Shipping\PacCorreiosShippingMethod;
use App\Exercise\Shipping\Product;
use App\Exercise\Shipping\ShippingService;
use App\Exercise\Shipping\User;
use PHPUnit\Framework\TestCase;

class ShippingTest extends TestCase
{
    public function testShouldCreateAEmptyCart()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $this->assertEquals(0, $cart->getTotals());
    }

    public function testShouldAddAProductImAEmptyCart()
    {
        $user = $this->createMock(User::class);
        $product = new Product(1, 'Product One', 10.99);
        $cart = new Cart($user);
        $cart->addItem($product, 1);
        $this->assertEquals(10.99, $cart->getTotals());
    }

    public function testShouldAddAProductThatExistsInACart()
    {
        $user = $this->createMock(User::class);
        $product = new Product(1, 'Product One', 10.99);
        $cart = new Cart($user);
        $cart->addItem($product, 1);
        $cart->addItem($product, 1);
        $this->assertEquals(21.98, $cart->getTotals());
        $this->assertCount(1, $cart->getItems());
    }

    public function testShouldRemoveAAddedProductInACart()
    {
        $user = $this->createMock(User::class);
        $product = new Product(1, 'Product One', 10.99);
        $cart = new Cart($user);
        $cart->addItem($product, 1);
        $cart->removeItem($product, 1);
        $this->assertEquals(0, $cart->getTotals());
        $this->assertCount(0, $cart->getItems());
    }

    public function testShouldRemoveAItemsInACart()
    {
        $user = $this->createMock(User::class);
        $product = new Product(1, 'Product One', 10.99);
        $product2 = new Product(2, 'Product Two', 22.99);
        $cart = new Cart($user);
        $cart->addItem($product, 1);
        $cart->addItem($product2, 3);
        $cart->removeAllItems();
        $this->assertEquals(0, $cart->getTotals());
        $this->assertCount(0, $cart->getItems());
    }

    public function testShouldCalculateFreeShipping()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $product = new Product(1, 'Book A', 100);
        $cart->addItem($product, 1);
        $pacCorreiosShippingMethod = new PacCorreiosShippingMethod();
        $shippingService = new ShippingService($pacCorreiosShippingMethod);
        $total = $cart->getTotals() + $shippingService->calculate($cart);
        $this->assertEquals($cart->getTotals(), $total);
    }

    public function testShouldCalculateNoFreeShipping()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);
        $cart->addItem($productA, 1);
        $pacCorreiosShippingMethod = new PacCorreiosShippingMethod();
        $shippingService = new ShippingService($pacCorreiosShippingMethod);
        $total = $cart->getTotals() + $shippingService->calculate($cart);
        $this->assertGreaterThan($cart->getTotals(), $total);
    }

    public function testShouldCalculateShippingExecutedOnce()
    {
        $correiosService = $this->createMock(PacCorreiosShippingMethod::class);
        $correiosService->expects($spy = $this->any())->method('calculatePrice');
        $correiosService->calculatePrice('62870000');
        $this->assertEquals(1, $spy->getInvocationCount());
    }
}
