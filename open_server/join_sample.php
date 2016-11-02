<?php
	$db_connect = mysqli_connect("localhost", "database_id", "database_pw", "db_name");

	if(mysqli_connect_error()) {
		echo "Fail to connect database.";
	}
	mysqli_set_charset($db_connect, 'utf8');

	$uname = $_POST['uname'];
	$uid = $_POST['uid'];
	$upw1 = $_POST['upw'];

	$sql_push = "INSERT INTO os_member value ('$uid', '$uname', '$upw1', '0');";
	$result_push = mysqli_query($db_connect, $sql_push) or die(mysql_error());
?>