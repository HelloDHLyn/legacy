<?php
	$db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");
	if(mysqli_connect_error()) {
		echo 'Fail to connect database.';
	}
	mysqli_set_charset($db_connect, 'utf8');

	$sql_query = "SELECT * FROM sting_festival WHERE x = '" . $_GET['mapx'] . "';";
	$result = $db_connect -> query($sql_query);
	$num_result = $result -> num_rows;

	if ($num_result == 0) {
		$sql_query = "INSERT INTO sting_festival VALUES ('', '".$_GET['title']."', '".$_GET['startDate']."', '".$_GET['endDate']."', '".$_GET['mapx']."', '".$_GET['mapy']."', '".$_GET['address']."');";
		$result = $db_connect -> query($sql_query);
	}
?>