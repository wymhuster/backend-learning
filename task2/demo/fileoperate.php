<?php 

//文件操作
$document_root = $_SERVER['DOCUMENT_ROOT'];

//写文件
$f = fopen("$document_root/zhongwen.txt", 'a+');
flock($f, LOCK_EX);
$str1 = "add a line\n";
fwrite($f, $str1);
$str2 = "add a new line";
fwrite($f, $str2);
flock($f, LOCK_UN);
fclose($f);

//读文件
$str = "";
$f = fopen("$document_root/zhongwen.txt", 'r+');
//
flock($f, LOCK_SH);
while(!feof($f))
{
    $str .= fgets($f);
}
rewind($f);
flock($f, LOCK_UN);
fclose($f);
echo "$str" . "</br>";

readfile("$document_root/zhongwen.txt");
$arr = file("$document_root/zhongwen.txt");
$strs = file_get_contents("$document_root/zhongwen.txt");
var_dump($arr);
var_dump($strs);

echo "success";
