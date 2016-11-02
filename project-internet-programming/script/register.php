<?php
	header("Content-Type: text/html; charset=UTF-8");

	$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
	mysql_set_charset($db_connect, "utf8");
	mysql_select_db("db_u2014147575", $db_connect);

	$query = "INSERT INTO db_member VALUES(" .
		"'', " .
		"'" . $_POST['id'] . "', " .
		"'" . md5($_POST['password']) . "', " .
		"'" . $_POST['name'] . "', " .
		"'" . $_POST['postcode1'] . "-" . $_POST['postcode2'] . "', " .
		"'" . $_POST['address1'] . "', " .
		"'" . $_POST['address2'] . "', " .
		"'" . $_POST['address3'] . "', " .
		"'" . $_POST['birthday'] . "', " .
		"'" . $_POST['phonenum'] . "', " .
		"0);";

	$result = mysql_query($query);

	echo '<script>alert("가입되었습니다!");</script>';
	echo '<meta http-equiv="refresh" content="0; url=../login.php">'; 
?>