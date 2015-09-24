<?php

namespace CakePhpBrasil\Cart\Adapter;

class ArrayAdapter implements AdapterFactory
{
    protected $products = [];

    public function add(Array $product)
    {
        $this->products = array_merge($this->products, [$product]);
        return $this->products;
    }
    
    public function delete($id)
    {
        $key = array_search($id, array_column($this->products, 'id'));
        
        if ($key !== false) {
            unset($this->products[$key]);
        }

        $this->products = array_values($this->products);

        return $this->products;
    }

    public function all()
    {
        return $this->products;
    }
}
