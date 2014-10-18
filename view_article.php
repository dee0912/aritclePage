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

	die("select error!");
}

$content = $row['content'];
$pagebreak = "&lt;!-- pagebreak --&gt;"; //<!-- pagebreak -->
$page_act = 1; //设置分页方式 0:url 1:ajax

$perPage = 4; //前分页偏移量
$floPage = 4; //后分页偏移量
$preFonts = ""; //"前一页"文字内容
$nextFonts = ""; //"下一页"文字内容

if($page_act == 0){

	//url分页时的$p
	$p = isset($_GET['p'])?$_GET['p']:1; //当前页码
}else{

	//ajax分页时$p来自viwe_article.html
	$p = isset($_POST['p'])?$_POST['p']:1;
}

//实例化
$mypage = new MyArcPage($content,$pagebreak,$page_act,$p,$perPage,$floPage);

//获得content
$content = $mypage->check();

//htmlspecialchars_decode处理。如果文章带分页，那么获取到的$content就是一个一维数组，需要把数组中的每个元素即每页展现的内容进行decode
if(is_array($content)){

	for($i=1;$i<=count($content);$i++){
	
		$content[$i-1] = htmlspecialchars_decode($content[$i-1]);
	}
}else{

	$content = htmlspecialchars_decode($content);
}

//上一页，下一页
$preFonts = $mypage->getPreFonts($preFonts);
$nextFonts = $mypage->getNextFonts($nextFonts);

//总条数
$totalPage = $mypage->getTotalPage();

//显示页码
$page = $mypage->page($preFonts,$nextFonts);

$smarty->assign("ROOT",ROOT);
$smarty->assign("ROOT_URL",ROOT_URL);
$smarty->assign("Template_Dir",Template_Dir);
$smarty->assign("row",$row);

$smarty->assign("content",$content);

//ajax要用到的参数
$smarty->assign("id",$id);
$smarty->assign("pagebreak",$pagebreak);
$smarty->assign("perPage",$perPage); //前分页偏移量
$smarty->assign("floPage",$floPage); //后分页偏移量

$smarty->assign("page",$page);
$smarty->assign("pageNow",$p); //传递当前页
$smarty->assign("totalPage",$totalPage); //传递总页数
$smarty->assign("page_act",$page_act); //传递分页方式
$smarty->assign("preFonts",$preFonts); //传递上一页文字信息
$smarty->assign("nextFonts",$nextFonts); //传递下一页文字信息

$smarty->display("view_article.html");