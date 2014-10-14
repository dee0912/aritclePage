<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 03:18:26
         compiled from "D:\site\articlePage\templates\view_article.html" */ ?>
<?php /*%%SmartyHeaderCode:16742543c83334aefb1-92148839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4061cba78bfbc96ee3e22e6587210367aed71c66' => 
    array (
      0 => 'D:\\site\\articlePage\\templates\\view_article.html',
      1 => 1413256703,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16742543c83334aefb1-92148839',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543c8333560e08_99264320',
  'variables' => 
  array (
    'Template_Dir' => 0,
    'row' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543c8333560e08_99264320')) {function content_543c8333560e08_99264320($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>文章页</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/css/style_arc_view.css"  rel="stylesheet" type="text/css">
</head>
<body>

	<div id="container">
	
		<div id="title"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</div>
		<div id="content"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</div>

	</div>

</body>
</html><?php }} ?>
