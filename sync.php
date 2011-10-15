<?php
error_reporting (E_ALL ^ E_NOTICE);
/*$mysql_host="localhost";
$mysql_user="root";
$mysql_pass="";
$mysql_db="vkbullshit.my";*/

$mysql_host=$_SERVER['MYSQL_HOST'];
$mysql_user=$_SERVER['MYSQL_USER'];
$mysql_pass=$_SERVER['MYSQL_PASS'];
$mysql_db=$_SERVER['MYSQL_DB'];
$data=json_decode($_POST["data"]);
$task=$_POST["task"];
///

//Подключаемся к БД
$db = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
if (!$db) {die('Could not connect mysql: ' . mysql_error());}
mysql_select_db($mysql_db, $db) or die ('Can\'t use foo : ' . mysql_error());
if($task=="fullsync"){
	echo fullSync($data);
}
mysql_close($db);


function mysql_fetch_all($res) {//Возвращает массив ассоциативных массивов
   while($row=mysql_fetch_assoc($res)) {
       $return[] = $row;
   }
   return $return;
}
function fullSync($data){
	//Строим запрос добавления записей в БД
	$query="INSERT IGNORE INTO `blacklist` (`link`) VALUES ";
	for($i=0; $i<count($data); $i++){
		if($i!=0)
			$query.=", ";
		$query.="('".$data[$i]->link."')";
	}
	mysql_query($query)or die("Invalid query [".$query."]: " . mysql_error());
	$query="SELECT link FROM `blacklist` WHERE link NOT IN (";
	for($i=0; $i<count($data); $i++){
		if($i!=0)
			$query.=", ";
		$query.="'".$data[$i]->link."'";
	}
	$query.=")";
	$new_entries= mysql_query($query)or die("Invalid query [".$query."]: " . mysql_error());
	$new_entries= mysql_fetch_all($new_entries);
	return json_encode($new_entries);
}
?>
