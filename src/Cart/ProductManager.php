<?php

namespace WebDevBr\Cart;

class ProductManager implements Contract
{
    protected $products = [];

    public function add(Array $product)
    {
        $key = $this->getKey($product['id']);
        if ($key === false) {
            $this->products = array_merge($this->products, [$product]);
        } else {
            $this->products[$key] = $this->changeValue($this->products[$key]);
            $this->products[$key]['qtd'] += 1;
        }
        $this->products = array_values($this->products);
        return $this;
    }
    
    public function delete($id)
    {
        $key=$this->getKey($id);
        
        if ($key !== false) {
            $this->products[$key] = $this->changeValue($this->products[$key], true);
            $this->products[$key]['qtd'] -= 1;
            if ($this->products[$key]['qtd'] <= 0) {
                unset($this->products[$key]);
            }
        }
        $this->products = array_values($this->products);
        return $this;
    }
    public function all(Array $products = null)
    {
        if ($products) {
            $this->products = $products;
        }
        return array_values($this->products);
    }
    protected function getKey($id)
    {
        return array_search($id, array_column($this->products, 'id'));
    }
    protected function changeValue($product, $remove = false)
    {
        $value = $product['value']/$product['qtd'];
        if ($remove) {
            $product['value'] -= $value;
        } else {
            $product['value'] += $value;
        }
        return $product;
    }
}
