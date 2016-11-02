<?php
	header("Content-Type: text/html; charset=UTF-8");
?>

<?php
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");

	if(mysqli_connect_error()) {
		echo "Fail to connect database.";
	}
	mysqli_set_charset($db_connect, 'utf8');

	$ucode = generateRandomString(20);
	$uname = $_POST['name'];
	$uid = $_POST['id'];
	$upw = sha1($_POST['password']);
	$usid = $_POST['student-id'];
	$ucol = $_POST['college'];
	$umajor = $_POST['major'];
	$umail = $_POST['email'];

	$sql_push = "INSERT INTO ys_member value ('$ucode', '$uid', '$upw', '$usid', '$uname', '$ucol', '$umajor', '$umail');";
	$result_push = mysqli_query($db_connect, $sql_push) or die(mysql_error());

	function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
}

	echo "<script>alert(\"가입되었습니다!\");</script>";
	echo "<meta http-equiv='refresh' content='0; url=http://yonsei.lynlab.co.kr/'>";
?>
