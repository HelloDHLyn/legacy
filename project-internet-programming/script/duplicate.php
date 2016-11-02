<?php
	$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
	mysql_set_charset($db_connect, "utf8");
	mysql_select_db("db_u2014147575", $db_connect);

	$query = "SELECT * FROM db_member WHERE id = '" . $_GET['id'] . "';";

	$result = mysql_query($query);
	$num = mysql_num_rows($result);

	if ($num == 0) $status = "false";
	else $status = "true";

	$arr = array('id' => $_GET['id'], 'isMember' => $status);

	echo json_encode($arr);
?>