<?php

namespace CakePhpBrasil\Cart\Adapter;

class ArrayAdapterTest extends TestCase
{
    public function setUp()
    {
    	parent::setUp();
        $this->adapter = new ArrayAdapter();
    }
}
