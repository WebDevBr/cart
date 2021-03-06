<?php

namespace WebDevBr\Cart;

class ProductManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $product_one = [
        'id'=>1,
        'title'=>'Celular MotoG 3',
        'qtd'=>2,
        'value'=>1599.98,
        'value_unt'=>799.99
    ];

    protected $product_two = [
        'id'=>2,
        'title'=>'Game Playstation 5',
        'qtd'=>1,
        'value'=>4599.99,
        'value_unt'=>4599.99
    ];

    /** @var ArrayAdapter */
    protected $adapter;

    public function setUp()
    {
        parent::setUp();
        $this->adapter = new ProductManager();
        $this->product_one['qtd']=2;
        $this->product_two['qtd']=1;
    }

    public function testImplementsAdapterFactory()
    {
        $this->assertInstanceOf('WebDevBr\Cart\Contract', $this->adapter);
    }

    public function testAdicionarItem()
    {
        $this->adapter->add($this->product_one);

        $expected = [
            $this->product_one
        ];

        $cart = $this->adapter->all();

        $this->assertEquals($expected, $cart);
    }

    public function testAdicionarMultiplosItens()
    {
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_two);

        $expected = [
            $this->product_one,
            $this->product_two
        ];

        $cart = $this->adapter->all();

        $this->assertEquals($expected, $cart);
    }

    public function testRemovendoItem1()
    {
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_two);

        $this->adapter->delete(1);
        $this->adapter->delete(1);

        $expected = [
            $this->product_two
        ];

        $cart = $this->adapter->all();

        $this->assertEquals($expected, $cart);
    }

    public function testRemovendoItem2()
    {
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_two);

        $this->adapter->delete(2);

        $expected = [
            $this->product_one
        ];

        $cart = $this->adapter->all();

        $this->assertEquals($expected, $cart);
    }

    public function testIncrementaQuantidade()
    {
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_two);
        $this->adapter->add($this->product_two);
        $this->adapter->add($this->product_two);
        $this->adapter->add($this->product_two);

        $value_one = $this->product_one['value']/$this->product_one['qtd'];
        $value_two = $this->product_two['value']/$this->product_two['qtd'];

        $value_two *= 3;

        $this->product_one['qtd']+=1;
        $this->product_two['qtd']+=3;

        $this->product_one['value']+=$value_one;
        $this->product_two['value']+=$value_two;

        $expected = [
            $this->product_one,
            $this->product_two
        ];

        $this->assertEquals($expected, $this->adapter->all());
    }

    public function testDecrementarERemoverQuantidade()
    {
        $this->adapter->add($this->product_one);
        $this->adapter->add($this->product_two);
        $this->adapter->delete(1);
        $this->adapter->delete(2);

        $value_one = $this->product_one['value']/$this->product_one['qtd'];

        $this->product_one['qtd']=1;

        $this->product_one['value']-=$value_one;

        $expected = [
            $this->product_one
        ];

        $this->assertEquals($expected, $this->adapter->all());
    }
}
