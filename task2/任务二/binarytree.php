<?php
include "treenode.php";

class BinaryTree
{
    public $root;

    public function __construct($data)
    {
        $this->root = new Node($data);
    }

    public function createTree(Node $root)
    {
        $this->root = $root;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public static function createNode($data)
    {
        return new Node($data);
    }

    //二叉树前序遍历（递归）
    public static function preOreder(Node $node=NULL)
    {
        if ($node == NULL) {
            return;
        }
        echo $node->getData();
        self::preOreder($node->getLeftNode());
        self::preOreder($node->getRightNode());
    }

    //二叉树中序遍历（递归）
    public static function inOrder(Node $node=NULL)
    {
        if ($node == NULL) {
            return;
        }
        self::inOrder($node->getLeftNode());
        echo $node->getData();
        self::inOrder($node->getRightNode());
    }

    //二叉树后序遍历（递归）
    public static function postOrder(Node $node=NULL)
    {
        if ($node == NULL) {
            return;
        }
        self::postOrder($node->getLeftNode());
        self::postOrder($node->getRightNode());
        echo $node->getData();
    }

    //二叉树前序遍历（非递归）
    public static function preOreder2(Node $node=null)
    {
        $arr = array();
        $p = $node;
        while ($p!=NULL or $arr!=NULL) {
            while (isset($p)) {
                echo $p->getData();
                array_push($arr, $p);
                $p = $p->getLeftNode();
            }
            if (isset($arr)) {
                $p = end($arr);
                array_pop($arr);
                $p = $p->getRightNode();
            }
        }
    }

    //二叉树中序遍历（非递归）
    public static function inOrder2(Node $node=null)
    {
        $arr = array();
        $p = $node;
        while ($p!=NULL or $arr!=NULL) {
            while (isset($p)) {
                array_push($arr, $p);
                $p = $p->getLeftNode();
            }
            if (isset($arr)) {
                $p = end($arr);
                echo $p->getData();
                array_pop($arr);
                $p = $p->getRightNode();
            }
        }
    }
    
    //二叉树后序遍历（非递归）
    //二叉树的后序非递归遍历没有想到好的方法，参考了网上的思想，将二叉树先进行右节点优先的前序遍历，再将得到的列表反转
    //二叉树的后续遍历为左->右->根，先得到根->右->左的遍历结果再反转列表
    public static function postOrder2(Node $node=NULL)
    {
        $arr = array();
        $arr2 = array();
        $p = $node;
        while ($p!=NULL or $arr!=NULL) {
            while (isset($p)) {
                array_push($arr2, $p->getData());
                array_push($arr, $p);
                $p = $p->getRightNode();
            }
            if (isset($arr)) {
                $p = end($arr);
                array_pop($arr);
                $p = $p->getLeftNode();
            }
        }
        $arr2 = array_reverse($arr2);
        foreach ($arr2 as $a) {
            echo $a;
        }
    }
}
?>