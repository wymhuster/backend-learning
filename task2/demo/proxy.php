<?php

//代理模式简单demo

interface People
{
    function doHomework();
    function sendEmail();
    function attendClass();
}

class Student implements People
{
    public $name = NULL;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function doHomework()
    {
        echo ucwords($this->name) . ",do homework.</br>";
    }

    public function sendEmail()
    {
        echo ucwords($this->name) . ",send email.</br>";
    }

    public function attendClass()
    {
        echo ucwords($this->name) . ",attend class.</br>";
    }
}

class Proxy implements People
{
    public $pro;

    public function __construct($name)
    {
        $this->pro = new Student($name);
    }

    public function doHomework()
    {
        $this->pro->doHomework();
    }

    public function sendEmail()
    {
        $this->pro->sendEmail();
    }

    public function attendClass()
    {
        $this->pro->attendClass();
    }
}

$p = new Proxy("xiao ming");
$p->doHomework();
$p->sendEmail();
$p->attendClass();
