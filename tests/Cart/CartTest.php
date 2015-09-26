<?php

namespace WebDevBr\Cart;

use WebDevBr\Cart\ProductManager;

class CartTest extends \PHPUnit_Framework_TestCase
{
    protected $product_one = [
        'id'=>1,
        'title'=>'Celular MotoG 3',
        'qtd'=>2,
        'value'=>799.99
    ];

    protected $product_two = [
        'id'=>2,
        'title'=>'Game Playstation 5',
        'qtd'=>1,
        'value'=>4599.99
    ];

    protected $product_tree = [
        'id'=>3,
        'title'=>'Notebook Lenovo G400s',
        'qtd'=>8,
        'value'=>1499.99
    ];

    public function setUp()
    {
        parent::setUp();
        $this->cart = new Cart(new ProductManager);
    }

    public function testAdicionandoProdutoNoCarrinho()
    {
        $this->cart->add($this->product_one);

        $expected = [
            $this->product_one
        ];
        $this->assertEquals($expected, $this->cart->all());
    }

    public function testAdicionandoMultiplosProdutosNoCarrinho()
    {
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $expected = [
            $this->product_one,
            $this->product_two,
            $this->product_tree
        ];

        $this->assertEquals($expected, $this->cart->all());
    }

    public function testRemovendoProdutosDoCarrinho()
    {
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->cart->delete(2);

        $expected = [
            $this->product_one,
            $this->product_tree
        ];

        $this->assertEquals($expected, $this->cart->all());
    }

    public function testOrdenacaoDosProdutosPorValorMenor()
    {
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->cart->order(Cart::ORDER_BY_VALUE);

        $expected = [
            $this->product_one,
            $this->product_tree,
            $this->product_two
        ];

        $this->assertEquals($expected, $this->cart->all());
    }

    public function testOrdenacaoDosProdutosPorValorMaior()
    {
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->cart->order(Cart::ORDER_BY_VALUE, true);

        $expected = [
            $this->product_one,
            $this->product_tree,
            $this->product_two
        ];

        $expected = [
            $this->product_two,
            $this->product_tree,
            $this->product_one
        ];

        $this->assertEquals($expected, $this->cart->all());
    }
}
