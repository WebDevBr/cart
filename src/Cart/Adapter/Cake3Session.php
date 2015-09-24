<?php

namespace CakePhpBrasil\Cart\Adapter;

use Cake\Network\Session;

class Cake3Session extends ArrayAdapter implements AdapterFactory
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function add(Array $product)
    {
        $this->products = $this->getSession();
        parent::add($product);
        $this->session->write('store.cart', $this->products);
        return $this->products;
    }
    
    public function delete($id)
    {
        $this->products = $this->getSession();
        parent::delete($id);

        $this->session->write('store.cart', $this->products);

        return $this->products;
    }

    public function all()
    {
        return parent::all($this->getSession());
    }

    protected function getSession()
    {
        if (!$this->session->check('store.cart')) {
            $this->session->write('store.cart', []);
        }

        return $this->session->read('store.cart');
    }
}
