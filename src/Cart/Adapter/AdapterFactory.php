<?php

namespace CakePhpBrasil\Cart\Adapter;

interface AdapterFactory
{
    public function add(Array $product);
    public function delete($id);
}
