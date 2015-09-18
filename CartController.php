<?php

namespace App\Controller;

use CakePhpBrasil\Cart\Cart;

class CartController extends AppController
{
    protected $products = [
        1 => [
                'id'=>1,
                'title'=>'Celular MotoG 3',
                'qtd'=>2,
                'value'=>799.99
            ],
        2 => [
                'id'=>2,
                'title'=>'Game Playstation 5',
                'qtd'=>1,
                'value'=>4599.99
            ],
        3 => [
                'id'=>3,
                'title'=>'Notebook Lenovo G400s',
                'qtd'=>8,
                'value'=>1499.99
            ]
    ];

    public function index()
    {
        // Cart::get()->all() lista todos os produtos no carrinho
        $products = Cart::get()->all();
        debug($products);
        exit;
    }

    public function add($id)
    {
        // Cart::get()->add() Adiciona um produto ao carrinho
        Cart::get()->add($this->products[$id]);
        return $this->redirect('/cart/index');
    }

    public function delete($id)
    {
        // Cart::get()->delete() Remove um produto do carrinho
        Cart::get()->delete($id);
        return $this->redirect('/cart/index');
    }
}
