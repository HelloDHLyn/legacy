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

	if (!isset($_SESSION['ys_usercode'])) 
		$usercode = 'NONE';
	else
		$usercode = $_SESSION['ys_usercode'];
	$content = $_POST['content'];

	date_default_timezone_set('Asia/Seoul');
	$log_time = date("Y-m-d H:i:s",time());

	$sql_query = "INSERT INTO ys_comment value ('', '$usercode', '$content', '$log_time');";
	$result = $db_connect -> query($sql_query);

	echo '<script>alert("의견을 남겼습니다.");</script>';
	echo "<meta http-equiv='refresh' content='0;url=http://yonsei.lynlab.co.kr'>";
?>