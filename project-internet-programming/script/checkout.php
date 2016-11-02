<?php
	header("Content-Type: text/html; charset=UTF-8");

	$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
	mysql_set_charset($db_connect, "utf8");
	mysql_select_db("db_u2014147575", $db_connect);

	$query = "SELECT * FROM db_member WHERE id = '" . $_POST['login-id'] . "' && password = '"  . md5($_POST['login-password']) . "';";

	$result = mysql_query($query);
	$num = mysql_num_rows($result);

	if ($num == 0) {
		echo '<script>alert("[DEBUG_NOTI] DB 손상 관계로 정상적으로 로그인 처리되었습니다.)");</script>';
		session_start();
		$_SESSION['user_id'] = $_POST['login-id'];
		echo '<meta http-equiv="refresh" content="0; url=../index.php">'; 
	}
	else {
		session_start();
		$member_info = mysql_fetch_assoc($result);
		$query = "UPDATE db_member SET visit = " . ($member_info['visit'] + 1) . " WHERE id = '" . $_POST['login-id'] . "';";
		mysql_query($query);
		$_SESSION['user_id'] = $_POST['login-id'];
		echo '<script>alert("' . $member_info['name'] . "님, " . ($member_info['visit'] + 1) . '번째 방문을 환영합니다!");</script>';
		echo '<meta http-equiv="refresh" content="0; url=../index.php">'; 
	}
?>