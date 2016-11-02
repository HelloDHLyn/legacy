<?php
	header("Content-Type: text/html; charset=UTF-8");
?>

<?php
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
	if(mysqli_connect_error()) {
		echo "Fail to connect database.";
	}
	mysqli_set_charset($db_connect, 'utf8');

	$uid = $_POST['uid'];
	$upw = $_POST['upw'];

	$sql = "SELECT * FROM os_member WHERE id = '$uid' AND password = '$upw'";
	$result = mysqli_query($db_connect, $sql) or die(mysql_error());
	$is_member = mysqli_num_rows($result);

	$row = $result->fetch_assoc();

	$login_ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('Asia/Seoul');
	$login_time = date("Y-m-d H:i:s",time());

	if($is_member > 0) {
		$dt = new DateTime();
        $datetime = $dt -> format('Y-m-d H:i');

		$sql_query = "INSERT INTO os_history value ('$datetime', '.', '$uid', 1);";
		$result = $db_connect -> query($sql_query);

		echo '<script type="text/javascript">alert("'. $row['name']. '님, 환영합니다.")</script>';
		session_start();
		$_SESSION['user_id'] = $uid;
		$_SESSION['user_name'] = $row['name'];
		$_SESSION['user_route'] = $uid.'/'.$row['route'];
		echo "<meta http-equiv='refresh' content='0; url=http://server2.lynlab.co.kr/open_server'>";
	}
	else {
		$result = $db_connect -> query($sql_query);

		echo '<script type="text/javascript">alert("Wrong ID or password.")</script>';
		echo "<meta http-equiv='refresh' content='0; url=http://server2.lynlab.co.kr/open_server'>";
	}
?>
