<?php

require 'conn/conn.php';

if(isset($_POST['pageNow']) && !empty($_POST['pageNow'])){

	$p = $_POST['pageNow'];
}

if(isset($_POST['id']) && !empty($_POST['id'])){

	$id = $_POST['id'];
}

if(isset($_POST['pagebreak']) && !empty($_POST['pagebreak'])){

	$pagebreak = $_POST['pagebreak'];
}


$sql = "select content from archives where aid=".$id;

$row = $conne->getRowsRst($sql);
$content = $row['content'];

$content = explode(htmlspecialchars($pagebreak),$content);

echo htmlspecialchars_decode($content[$p-1]);



