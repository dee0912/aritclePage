<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 04:06:58
         compiled from "D:\site\articlePage\templates\error.html" */ ?>
<?php /*%%SmartyHeaderCode:26212543c925b877d48-65894249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4aa52fcae6ee6c23a93e77eb5020f6656aa8515b' => 
    array (
      0 => 'D:\\site\\articlePage\\templates\\error.html',
      1 => 1413257133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26212543c925b877d48-65894249',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543c925b8cc1e4_43569164',
  'variables' => 
  array (
    'do' => 0,
    'addr' => 0,
    'Template_Dir' => 0,
    'ROOT_URL' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543c925b8cc1e4_43569164')) {function content_543c925b8cc1e4_43569164($_smarty_tpl) {?><div id="textBox"><?php echo $_smarty_tpl->tpl_vars['do']->value;?>
失败，<span id="second"></span>  秒钟后跳转至<?php echo $_smarty_tpl->tpl_vars['addr']->value;?>
...</div>
<script src="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/js/showTime.js"></script>		
<script>
	var href='<?php echo $_smarty_tpl->tpl_vars['ROOT_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
';
	showTime(href);
</script><?php }} ?>
