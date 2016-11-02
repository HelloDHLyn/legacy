<?php
	header("Content-Type: text/html; charset=UTF-8");
?>

<?php
	session_start();

	//데이터베이스 연결
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
	if(mysqli_connect_error()) {
		echo "Fail to connect database.";
	}
	mysqli_set_charset($db_connect, 'utf8');

	$id_comment = $_POST['id_comment'];
	$content = $_POST['content'];

	$log_id = $_SESSION['user_id'];
	$log_ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('Asia/Seoul');
	$log_time = date("Y-m-d H:i:s",time());

	$sql_query = "INSERT INTO os_comment value ('$log_time', '$id_comment', '$content');";
	$result = $db_connect -> query($sql_query);

	echo '<script>alert("댓글을 올렸습니다.");</script>';
	echo "<meta http-equiv='refresh' content='0;url=/open_server'>";
?>