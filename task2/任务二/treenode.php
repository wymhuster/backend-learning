<?php

class Node
{
    public $data;
    public $lnode=NULL;
    public $rnode=NULL;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setLeftNode(Node $lnode)
    {
        $this->lnode = $lnode;
    }

    public function setRightNode(Node $rnode)
    {
        $this->rnode = $rnode;
    }

    public function getLeftNode()
    {
        return $this->lnode;
    }

    public function getRightNode()
    {
        return $this->rnode;
    }

    public function getData()
    {
        return $this->data;
    }
}
