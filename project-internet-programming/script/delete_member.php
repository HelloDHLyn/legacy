<?php
	$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
	mysql_set_charset($db_connect, "utf8");
	mysql_select_db("db_u2014147575", $db_connect);

	$query = "DELETE FROM db_member WHERE member_code = '" . $_GET['code'] . "';";

	$result = mysql_query($query);
?>