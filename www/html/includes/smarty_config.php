<?php

define('SMARTY_DIR', DOCUMENT_ROOT.'smarty/libs/');	// note trailing slash
require SMARTY_DIR.'Smarty.class.php';

//$smarty = new Smarty;
$smarty = new SmartyBC;	// allows {php} tags in smarty templates

$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
$smarty->setCacheDir(DOCUMENT_ROOT.'smarty/cache/');


// set template dir
$smarty->setTemplateDir(DOCUMENT_ROOT.'templates');
$smarty->setCompileDir(DOCUMENT_ROOT.'templates_c');

?>