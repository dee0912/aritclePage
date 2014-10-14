<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 09:04:59
         compiled from "D:\site\articlePage\templates\add_article.html" */ ?>
<?php /*%%SmartyHeaderCode:18836543b41386c9095-03099743%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec0007bb371d39eafbc0968e9bc37acec39c2b87' => 
    array (
      0 => 'D:\\site\\articlePage\\templates\\add_article.html',
      1 => 1413277380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18836543b41386c9095-03099743',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543b41387667b2_32202777',
  'variables' => 
  array (
    'Template_Dir' => 0,
    'ROOT_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543b41387667b2_32202777')) {function content_543b41387667b2_32202777($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP文章分页类</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/css/style_control.css"  rel="stylesheet" type="text/css">
<script src="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/js/jquery-1.8.3.min.js"></script>

<!-- tinymce 4.1.6 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['ROOT_URL']->value;?>
tinymce/tinymce.min.js"></script>
<script>

    tinymce.init({

        selector:'#content',          //编辑区域
        theme: "modern",              //主题
        language: "zh_cn",            //语言(中文需要到官网下载)

		width:800, //编辑框宽
		height: 300, //编辑框高

		 plugins: [

			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern"
		],

		//第一行工具栏
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image", 

		//第二行工具栏
		toolbar2: "print preview media | forecolor backcolor emoticons", 

		image_advtab: true,   
		
		//初始时提供的默认格式
		style_formats: [      
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		]
	}); 

</script>
</head>
<body>

	<form id="arc_form" action="ins.php" method="post">

		标题:<br />
		<input type="text" id="title" name="title" autocomplete="off" /><br /><br />
		内容:<br />
		<textarea id="content" name="content"></textarea><br />
		<input type="button" id="sub" value="提交" />

	</form>

</body>
<script>

	$(function(){
		
		$("#sub").click(function(){
		
			//var con=tinymce.get('content').getContent();
			//alert(con);

			//tinymce.activeEditor.setContent(con+"<p style='color:red;'>测试</p>");

			if($("#title").val() != ""){

				$("#arc_form").submit();
			}else{
			
				alert("标题不能为空");
			}
		});
	});
</script>
</html>



<?php }} ?>
