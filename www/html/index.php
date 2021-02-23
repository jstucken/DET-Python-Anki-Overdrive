<?php
require_once ('includes/site_config.php');
require_once ('includes/smarty_config.php');
require_once ('includes/header.php');


$smarty->assign('template', getPageTemplate());
$smarty->display('default.tpl');
//dbug($_SESSION,'$_SESSION','green');
?>