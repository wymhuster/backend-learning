<?php

//工厂模式
include "factory.php";

$com1 = ComputerFactory::returnGoods("Dell");
$com2 = ComputerFactory::returnGoods("Hasee");
$com3 = ComputerFactory::returnGoods("Lenovo");

$com1->sale();
$com2->sale();
$com3->sale();
