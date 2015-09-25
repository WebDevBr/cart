<?php

namespace CakePhpBrasil\Cart\Adapter;

class ArrayAdapter implements AdapterFactory
{
    protected $products = [];

    public function add(Array $product)
    {
        $key = $this->getKey($product['id']);

        if ($key === false) {
            $this->products = array_merge($this->products, [$product]);
        } else {
            $this->products[$key]['qtd'] += 1;
        }

        return $this;
    }
    
    public function delete($id)
    {
        
        if (($key=$this->getKey($id)) !== false) {
            $this->products[$key]['qtd'] -= 1;

            if ($this->products[$key]['qtd'] <= 0) unset($this->products[$key]);
        }

        return $this;
    }

    public function all(Array $products = null)
    {
        if ($products)
            $this->products = $products;
        
        return array_values($this->products);
    }

    protected function getKey($id)
    {
        return array_search($id, array_column($this->products, 'id'));
    }

    
}
