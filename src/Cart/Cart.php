<?php

namespace CakePhpBrasil\Cart;

use CakePhpBrasil\Cart\Adapter\AdapterFactory;

class Cart
{
    private static $adapter;
    private static $instance;

    public static function configure(AdapterFactory $adapter)
    {
        static::$adapter = $adapter;
    }
    
    public static function get()
    {
        if (null === static::$instance) {
            static::$instance = new CartBr(static::$adapter);
        }
        
        return static::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
