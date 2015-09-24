<?php

namespace CakePhpBrasil\Cart\Adapter;

use Cake\Network\Session;

class Cake3SessionTest extends TestCase
{

    public function setUp()
    {
        $this->adapter = new Cake3Session(new Session);
    }

}
