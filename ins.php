<?php

	require 'conn/conn.php';
	require 'init.inc.php';

	if(isset($_POST['title']) && !empty($_POST['title'])){

		if(get_magic_quotes_gpc()){
			
			$title = trim($_POST['title']);

		}else{
			
			$title = addslashes(trim($_POST['title']));
		}
	}

	if(isset($_POST['content']) && !empty($_POST['content'])){
	
		$content = htmlspecialchars($_POST['content']);
	}

	function check_input($value){
	
		// 如果不是数字则加引号
		if (!is_numeric($value)){
		
			$value = mysql_real_escape_string($value);
		}
		return $value;
	}

	$title = check_input($title);


	//插入数据
	$sql = "insert into archives (title,content,pubdate)values('".$title."','".$content."','".time()."')";


	if($conne->uidRst($sql) == 1){
		
		//当前时间存入session
		$_SESSION['t'] = $t;
	
		$smarty->assign("Template_Dir",Template_Dir);
		$smarty->assign("ROOT_URL",$ROOT_URL);

		//跳转参数
		$smarty->assign("do","添加");
		$smarty->assign("addr","列表页");
		$smarty->assign("url","list.php");

		$smarty->display("success.html");
	}else{

		$smarty->assign("Template_Dir",Template_Dir);
		$smarty->assign("ROOT_URL",$ROOT_URL);

		//跳转参数
		$smarty->assign("do","添加");
		$smarty->assign("addr","添加页");
		$smarty->assign("url","add_article.php");

		$smarty->display("error.html");
	}