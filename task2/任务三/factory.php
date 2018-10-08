<?php

include "computer.php";

interface Factory
{
    static function returnGoods($name);
}

class ComputerFactory implements Factory 
{
    public static function returnGoods($name)
    {
        switch ($name) {
            case "Dell":
                return new DellComputer();
                break;
            case "Lenovo":
                return new LenovoComputer();
                break;
            case "Hasee":
                return new HaseeComputer();
                break;
            default:
                return NULL;
                break;
        }
    }
}
