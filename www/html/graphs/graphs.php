<?php
/*
* This page uses Google Charts
* See:
* https://developers.google.com/chart/interactive/docs/php_example
* https://developers.google.com/chart/interactive/docs/gallery
*/

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/site_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/smarty_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');


// get all records from DB
//$select_sql = "
//SELECT * FROM cars_data ORDER BY id DESC LIMIT 100";

//$select_results = $db->getRows($select_sql);
//dbug($select_results,'select_results');

$smarty->assign('results', $select_results);

$smarty->assign('template', 'graphs/graphs.tpl');
$smarty->display('default.tpl');

//dbug($_SESSION,'$_SESSION');
?>