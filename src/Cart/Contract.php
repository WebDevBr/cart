<?php

namespace WebDevBr\Cart;

interface Contract
{
    public function add(Array $product);
    public function delete($id);
}
