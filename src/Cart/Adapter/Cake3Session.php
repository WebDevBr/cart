<?php

namespace CakePhpBrasil\Cart\Adapter;

use Cake\Network\Session;

class Cake3Session implements AdapterFactory
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function add(Array $product)
    {
        $products = $this->getSession();
        array_push($products, $product);
        $this->session->write('store.cart', $products);
        return $products;
    }
    
    public function delete($id)
    {
        $products = $this->getSession();
        $key = array_search($id, array_column($products, 'id'));
        
        if ($key !== false) {
            unset($products[$key]);
        }

        $products = array_values($products);

        $this->session->write('store.cart', $products);

        return $products;
    }

    public function all()
    {
        return $this->getSession();
    }

    protected function getSession()
    {
        if (!$this->session->check('store.cart')) {
            $this->session->write('store.cart', []);
        }

        return $this->session->read('store.cart');
    }
}
