<?php

namespace CakePhpBrasil\Cart;

use CakePhpBrasil\Cart\Adapter\AdapterFactory;

class Cart
{

	const ORDER_BY_VALUE = false;

	public function __construct(AdapterFactory $adapter)
	{

	}

	public function add(Array $product)
	{
		return $this;
	}

	public function delete($id)
	{
		return $this;
	}

	public function order($by, Boolean $inverse)
	{

	}

	public function all()
	{

	}
}