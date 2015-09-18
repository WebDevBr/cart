<?php

namespace CakePhpBrasil\Cart;

use CakePhpBrasil\Cart\Adapter\AdapterFactory;

class Cart
{

    const ORDER_BY_VALUE = 'orderByValue';

    private $products = [];
    private $adapter;

    public function __construct(AdapterFactory $adapter)
    {
        $this->adapter = $adapter;
    }

    public function add(Array $product)
    {
        $this->products = $this->adapter->add($product);
        return $this;
    }

    public function delete($id)
    {
        $this->products = $this->adapter->delete($id);
        return $this;
    }

    public function order($by, $inverse = false)
    {
        usort($this->products, [$this, $by]);

        if ($inverse) {
            $this->products = array_reverse($this->products);
        }

        return $this;
    }

    public function all()
    {
        if (empty($this->products)) {
            return $this->adapter->all();
        }

        return $this->products;
    }

    private function orderByValue($a, $b)
    {
        if ($a['value'] == $b['value']) {
            return 0;
        }

        return ($a['value'] < $b['value']) ? -1 : 1;
    }

    private function orderByTitle($a, $b)
    {
        return strcmp($a['title'], $b['title']);
    }
}
