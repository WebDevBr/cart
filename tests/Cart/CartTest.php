<?php

namespace WebDevBr\Cart;

use WebDevBr\Cart\ProductManager;

class CartTest extends \PHPUnit_Framework_TestCase
{
    protected $product_one = [
        'id'=>1,
        'title'=>'Celular MotoG 3',
        'qtd'=>2,
        'wheight'=>10,
        'value'=>1599.98,
        'value_unt'=>799.99
    ];

    protected $product_two = [
        'id'=>2,
        'title'=>'Game Playstation 5',
        'qtd'=>1,
        'wheight'=>12,
        'value'=>4599.99,
        'value_unt'=>4599.99
    ];

    protected $product_tree = [
        'id'=>3,
        'title'=>'Notebook Lenovo G400s',
        'qtd'=>8,
        'wheight'=>13,
        'value'=>11999.92,
        'value_unt'=>1499.99
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
            $this->product_two,
            $this->product_tree,
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
            $this->product_tree,
            $this->product_two,
            $this->product_one,
        ];

        $this->assertEquals($expected, $this->cart->all());
    }

    public function testTotalDosValoresDosProdutos()
    {
        $this->product_one['qtd'] = 1;
        $this->product_two['qtd'] = 1;
        $this->product_tree['qtd'] = 1;
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->assertEquals(6899.97, $this->cart->total());
    }

    public function testTotalDosValoresDosProdutosComVariasQtds()
    {
        $this->product_one['qtd'] = 1;
        $this->product_two['qtd'] = 2;
        $this->product_tree['qtd'] = 2;
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->assertEquals(12999.95, $this->cart->total());
    }

    public function testTotalDoPesoDosProdutos()
    {
        $this->product_one['qtd'] = 1;
        $this->product_two['qtd'] = 1;
        $this->product_tree['qtd'] = 2;
        $this->cart->add($this->product_one)
            ->add($this->product_two)
            ->add($this->product_tree);

        $this->assertEquals(48, $this->cart->wheight());
    }
}
