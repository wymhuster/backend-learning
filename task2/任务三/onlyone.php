<?php

//单例模式demo

class Single
{
    private $name = NULL;
    private static $obj;

    public function __construct()
    {
        $this->name = "wangmeng";
        echo "succeed";
    }

    private function __clone()
    {

    }

    public static function getClass()
    {
        if (self::$obj instanceof self) {
            return self::$obj;
        } else {
            self::$obj = new Single();
            return self::$obj;
        }
    }

    public function returnString()
    {
        echo $this->name . "</br>";
    }
}

$a = Single::getClass();
$b = Single::getClass();

$a->returnString();
$b->returnString();

if ($a == $b) {
    echo "equal";
}
