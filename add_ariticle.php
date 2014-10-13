<?php

require 'init.inc.php';

$smarty->assign("ROOT",ROOT);
$smarty->assign("ROOT_URL",ROOT_URL);
$smarty->assign("Template_Dir",Template_Dir);

$smarty->display("add_article.html");