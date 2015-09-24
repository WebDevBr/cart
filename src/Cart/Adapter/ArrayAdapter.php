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
        $key = $this->getKey($id);
        
        if ($key !== false) {
            $this->products[$key]['qtd'] -= 1;

            $this->unsetProduct($key);
        }

        return $this;
    }

    public function all()
    {
        return array_values($this->products);
    }

    protected function getKey($id)
    {
        return array_search($id, $this->array_column($this->products, 'id'));
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

    private function unsetProduct($key)
    {
        if ($this->products[$key]['qtd'] <= 0) {
            unset($this->products[$key]);
        }
    }
}
