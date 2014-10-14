<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 04:06:58
         compiled from "D:\site\articlePage\templates\success.html" */ ?>
<?php /*%%SmartyHeaderCode:22519543c9095878800-53904254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53f34705b444ce1e27b022dd511eab86b2319f47' => 
    array (
      0 => 'D:\\site\\articlePage\\templates\\success.html',
      1 => 1413257248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22519543c9095878800-53904254',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543c90958ca975_18158863',
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
<?php if ($_valid && !is_callable('content_543c90958ca975_18158863')) {function content_543c90958ca975_18158863($_smarty_tpl) {?><div id="textBox"><?php echo $_smarty_tpl->tpl_vars['do']->value;?>
成功，<span id="second"></span>  秒钟后跳转至<?php echo $_smarty_tpl->tpl_vars['addr']->value;?>
...</div>
<script src="<?php echo $_smarty_tpl->tpl_vars['Template_Dir']->value;?>
/js/showTime.js"></script>		
<script>
	var href='<?php echo $_smarty_tpl->tpl_vars['ROOT_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
';
	showTime(href);
</script><?php }} ?>
