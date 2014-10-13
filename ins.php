<?php

	require 'conn/conn.php';

	if(isset($_POST['title']) && !empty($_POST['title'])){

		if(get_magic_quotes_gpc()){
			
			$title = trim($_POST['title']);

		}else{
			
			$title = addslashes(trim($_POST['title']));
		}
	}

	if(isset($_POST['content']) && !empty($_POST['content'])){
	
		$content = $_POST['content'];
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

	echo "success";
}