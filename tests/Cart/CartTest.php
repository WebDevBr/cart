<?php

namespace CakePhpBrasil\Cart;

use CakePhpBrasil\Cart\Adapter\ArrayAdapter;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCart()
    {
        Cart::configure(new ArrayAdapter);
        $cart = Cart::get();

        $this->assertInstanceOf('CakePhpBrasil\Cart\CartBr', $cart);
    }
}
