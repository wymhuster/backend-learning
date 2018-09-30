<?php

include "binarytree.php";

$tree = new BinaryTree("A");
$nodeb = new Node("B");
$nodec = new Node("C");
$noded = new Node("D");
$nodee = new Node("E");
$nodef = new Node("F");
$nodeg = new Node("G");
$nodeh = new Node("H");
$nodei = new Node("I");
$tree->root->setLeftNode($nodeb);
$tree->root->setRightNode($nodec);
$nodeb->setLeftNode($noded);
$nodec->setLeftNode($nodee);
$nodec->setRightNode($nodef);
$noded->setLeftNode($nodeg);
$noded->setRightNode($nodeh);
$nodee->setRightNode($nodei);

//递归遍历二叉树
echo "递归遍历</br>" . "前序遍历：";
$tree::preOreder($tree->getRoot());
echo "</br>";
echo "中序遍历：";
$tree::inOrder($tree->getRoot());
echo "</br>";
echo "后序遍历：";
$tree::postOrder($tree->getRoot());
echo "</br>";

//非递归遍历二叉树
echo "非递归遍历</br>" . "前序遍历：";
$tree::preOreder2($tree->getRoot());
echo "</br>";
echo "中序遍历：";
$tree::inOrder2($tree->getRoot());
echo "</br>";
echo "后序遍历：";
$tree::postOrder2($tree->getRoot());
echo "</br>";
