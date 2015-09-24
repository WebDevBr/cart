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
        $key = array_search($id, $this->array_column($this->products, 'id'));
        
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

    protected function array_column($array,$column_name)
    {
        if(!function_exists("array_column")) {
            return array_map(function($element)use($column_name){
                return $element[$column_name];
            }, $array);
        }

        return array_column($this->products, 'id');
    }
}
