<?php

interface Computer
{
    function sale();
}

class DellComputer implements Computer
{
    public function sale()
    {
        echo "卖出了一台戴尔电脑</br>";
    }
}

class LenovoComputer implements Computer
{
    public function sale()
    {
        echo "卖出了一台联想电脑</br>";
    }
}

class HaseeComputer implements Computer
{
    public function sale()
    {
        echo "卖出了一台神舟电脑</br>";
    }
}