<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/site_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/smarty_config.php');

// get players
$select_sql = "SELECT player_name,COUNT(*) as counter FROM cars_data GROUP BY player_name";

$select_results = $db->getRows($select_sql);
//dbug($select_results,'select_results');

// sample pie chart
$data = '
{
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],
  "rows": [';

$num_rows = count($select_results);
//dbug($num_rows,'$num_rows');

 foreach ($select_results as $key => $row) {
	 
	 //debug($key,'$key');
	 $player_name = $row['player_name'];
	 $counter = $row['counter'];
	 
	 $data .= '
        {"c":[{"v":"'.$player_name.'","f":null},{"v":'.$counter.',"f":null}]},';
}
	$data .= '{"c":[{"v":"Unknown","f":null},{"v":1,"f":null}]}
      ]
}';

echo $data;

?>