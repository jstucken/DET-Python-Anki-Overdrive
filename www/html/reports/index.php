<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/site_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/smarty_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/login_check.php');


// get all reports from DB
// with counts of number of students and tasks attached to each report
$select_sql = "
SELECT r.*,
	(SELECT COUNT(id) FROM students WHERE report_id = r.id) AS num_students,
    (SELECT COUNT(id) FROM tasks WHERE report_id = r.id) AS num_tasks,
    (SELECT COUNT(id) FROM templates WHERE report_id = r.id) AS num_templates
FROM reports r
ORDER BY r.id DESC
";

$select_results = $db->getRows($select_sql);
//dbug($select_results,'select_results');

$smarty->assign('results', $select_results);

$smarty->assign('template', getPageTemplate());
$smarty->display('default.tpl');

//dbug($_SESSION,'$_SESSION');
?>