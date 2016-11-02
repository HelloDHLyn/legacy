<?php
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
	if (mysqli_connect_error()) echo 'Fail to connect database.';
	mysqli_set_charset($db_connect, 'utf8');

	if (!isset($_POST['uid']) || !isset($_POST['upw'])) {
		echo '잘못된 접근입니다.';
		exit();
	}

	$upw = sha1($_POST['upw']);
	$uid = $_POST['uid'];

	$sql_query = "SELECT * FROM ys_member WHERE password = '$upw' && id = '$uid';";
	$sql_result = $db_connect -> query($sql_query);
	$row_num = $sql_result -> num_rows;

	if ($row_num == 1) {
		session_start();
		$member = $sql_result -> fetch_assoc();
		$_SESSION['ys_usercode'] = $member['code'];
		echo "<script>alert(\"" . $member['name'] . "님, 환영합니다.\");</script>";
		$url = "http://yonsei.lynlab.co.kr/profile/" . $uid;
	} else {
		echo "<script>alert(\"로그인 정보를 다시 입력해주세요.\");</script>";
		$url = "http://yonsei.lynlab.co.kr/";
	}
	header("Location: " . $url);
	exit();
?>