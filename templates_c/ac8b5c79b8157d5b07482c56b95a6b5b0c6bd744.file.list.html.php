<?php /* Smarty version Smarty-3.1.18, created on 2014-10-15 05:27:08
         compiled from "D:\site\articlePage\templates\list.html" */ ?>
<?php /*%%SmartyHeaderCode:7335543c98de658351-09336153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac8b5c79b8157d5b07482c56b95a6b5b0c6bd744' => 
    array (
      0 => 'D:\\site\\articlePage\\templates\\list.html',
      1 => 1413350417,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7335543c98de658351-09336153',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543c98de7310d3_73565350',
  'variables' => 
  array (
    'Template_Dir' => 0,
    'rowsArray' => 0,
    'ROOT_URL' => 0,
    'val' => 0,
    'mypage' => 0,
    'pageNow' => 0,
    'page_act' => 0,
    'perpageNum' => 0,
    'totalPage' => 0,
    'preFonts' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543c98de7310d3_73565350')) {function content_543c98de7310d3_73565350($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>列表页</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/css/list.css"  rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/css/page.css"  rel="stylesheet" type="text/css">
<script id="jq" src="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/js/jquery-1.8.3.min.js"></script>
</head>
<body>

	<div id="list">
		
		<ul id="newsul">
			
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rowsArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['ROOT_URL']->value;?>
view_article.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['aid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></li>
			<?php } ?>

		</ul>

	</div>
	<div id="page"><?php echo $_smarty_tpl->tpl_vars['mypage']->value;?>
</div>
	<input id="pageNow" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['pageNow']->value;?>
">
	<!--分页方式-->
	<input id="page_act" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['page_act']->value;?>
">
	<!--每页几条数据-->
	<input id="perpageNum" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['perpageNum']->value;?>
">
	<!--总页数-->
	<input id="totalPage" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['totalPage']->value;?>
">
	<!--//把smarty的变量传递给外部js-->
	<input id="Template_Dir" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
">
	<input id="preFonts" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['preFonts']->value;?>
">
</body>
<script>

	$(function(){
	
		//遍历a
		$(".pagenum").each(function(){
		
			if($(this).text() == $("#pageNow").val()){
		
				$(this).addClass("selected");
			}
		});
		
		//如果存在跳转输入框
		if($("#skip").length>0){
		
			$("#skip").keydown(function(){
			
				if(event.keyCode == 13){ //回车
				
					self.location="view_article.php?p="+$(this).val();
				}
			});
		}

		//点击"GO"按钮跳转
		if($("#go").length>0){
		
			$("#go").click(function(){
			
				self.location="view_article.php?p="+$("#skip").val();
			});
		}
		
		//如果分页方式是ajax，则加载外部ajax.js
		if($("#page_act").val() == 1){
		
			//把smarty的变量传递给外部js
			$Template_Dir = $("#Template_Dir").val();
			$preFonts = $("#preFonts").val();

			$insertAjax = $("<script src=\"<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/js/ajax.js\"><\/script>");
			$insertAjax.insertAfter($("#jq"));
		}

		//最后一行row去掉border-bottom
		$("#list ul").children("li:last").css("border-bottom",0);
	});
</script>
</html>



<?php }} ?>
