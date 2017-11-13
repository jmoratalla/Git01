<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);



echo "llega";


require_once("class/db_class.php");
// The instance
$mipdo=new DbPDO();




/*$mipdo->bind("id","1");
$rows = $mipdo->execute("SELECT * FROM dynamic_menu WHERE id=:id");*/

$rows = $mipdo->execute("SELECT id as menu_item_id, parent_id as menu_parent_id, title as menu_item_name,concat('/foldername',url)as url,menu_order,icon FROM dynamic_menu ORDER BY menu_order");

foreach ($rows as $r ) {

	var_dump($r['menu_item_name']);
}
/*echo $rows;*/
var_dump($rows);
 ?>