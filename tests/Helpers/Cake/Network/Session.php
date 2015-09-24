<?php

namespace Cake\Network;

class Session
{
	private $session;

	public function check($var)
	{
		return !is_null($this->session);
	}

	public function write($var, $var2)
	{
		return $this->session = $var2;
	}

	public function read($var)
	{
		return $this->session;
	}
}