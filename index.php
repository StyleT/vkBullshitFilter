<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<div>
		<?php
			$mysql_host=$_SERVER['MYSQL_HOST'];
			$mysql_user=$_SERVER['MYSQL_USER'];
			$mysql_pass=$_SERVER['MYSQL_PASS'];
			$mysql_db=$_SERVER['MYSQL_DB'];
			
			//Подключаемся к БД
			$db = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
			if (!$db) {die('Could not connect mysql: ' . mysql_error());}
			mysql_select_db($mysql_db, $db) or die ('Can\'t use foo : ' . mysql_error());
			
			$query="SELECT COUNT(*) AS count FROM `blacklist`";
			$rows_count= mysql_query($query)or die("Invalid query [".$query."]: " . mysql_error());
			$rows_count= mysql_fetch_all($rows_count);
			echo "Количество записей в черном списке: ".$rows_count[0]["count"];
			
			mysql_close($db);
		?>	
		</div>
	</body>
</html>
