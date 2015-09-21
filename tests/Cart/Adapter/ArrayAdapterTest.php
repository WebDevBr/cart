<?php

namespace CakePhpBrasil\Cart\Adapter;

// use CakePhpBrasil\Cart\Adapter;

class ArrayAdapterTest extends \PHPUnit_Framework_TestCase
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

    /** @var ArrayAdapter */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new ArrayAdapter();
    }

    public function testImplementsAdapterFactory()
    {
        $this->assertInstanceOf('CakePhpBrasil\Cart\Adapter\AdapterFactory', $this->adapter);
    }

    public function testAdicionarItem()
    {
        $array = new ArrayAdapter();
        $cart = $array->add($this->product_one);

        $expected = [
            $this->product_one
        ];

        $this->assertEquals($expected, $cart);
    }

    public function testAdicionarMultiplosItens()
    {
        $array = new ArrayAdapter();
        $array->add($this->product_one);
        $cart = $array->add($this->product_two);

        $expected = [
            $this->product_one,
            $this->product_two
        ];

        $this->assertEquals($expected, $cart);
    }

    public function testRemovendoItem1()
    {
        $array = new ArrayAdapter();
        $array->add($this->product_one);
        $array->add($this->product_two);

        $cart = $array->delete(1);

        $expected = [
            $this->product_two
        ];

        $this->assertEquals($expected, $cart);
    }

    public function testRemovendoItem2()
    {
        $array = new ArrayAdapter();
        $array->add($this->product_one);
        $array->add($this->product_two);

        $cart = $array->delete(2);

        $expected = [
            $this->product_one
        ];

        $this->assertEquals($expected, $cart);
    }
}
