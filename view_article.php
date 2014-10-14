<?php

require 'init.inc.php';
require 'conn/conn.php';
require 'arc_page.class.php'; //文章分页类

if(isset($_GET['id']) && !empty($_GET['id'])){

	//强制转换为整型
	$id = (int)$_GET['id'];
}

$sql = "select * from archives where aid=".$id;

if($conne->getRowsNum($sql) == 1){

	//查询
	$row = $conne->getRowsRst($sql);
}else{

	die("select error");
}

$content = $row['content'];

//检测是否有分页符

$smarty->assign("ROOT",ROOT);
$smarty->assign("ROOT_URL",ROOT_URL);
$smarty->assign("Template_Dir",Template_Dir);
$smarty->assign("row",$row);
$smarty->assign("content",htmlspecialchars_decode($content));

$smarty->display("view_article.html");