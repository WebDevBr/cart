<?php
namespace WebDevBr\Cart;

use WebDevBr\Cart\Contract;

class Cart
{
    const ORDER_BY_VALUE = 'orderByValue';
    private $products = [];
    private $adapter;
    public function __construct(Contract $adapter)
    {
        $this->adapter = $adapter;
    }
    public function add(Array $product)
    {
        $this->adapter->add($product);
        return $this;
    }
    public function delete($id)
    {
        $this->adapter->delete($id);
        return $this;
    }
    public function order($by, $inverse = false)
    {
        $this->products = $this->adapter->all();
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
        return array_values($this->products);
    }

    public function total()
    {
        $products = $this->products;
        if (empty($this->products)) {
            $products = $this->adapter->all();
        }

        $total = 0;
        foreach ($products as &$product) {
            $total += $product['value'];
        }
        return $total;
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
