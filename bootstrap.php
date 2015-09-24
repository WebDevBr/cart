<?php

$composer = include 'vendor/autoload.php';
$composer->setPsr4('Cake\\', 'tests/Helpers/Cake');
$composer->setPsr4('CakePhpBrasil\\Cart\\', 'tests/Cart');
