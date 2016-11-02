<?php 

	header("Content-Type: text/html; charset=UTF-8"); 

    if (isset($_POST['uid']) && isset($_POST['upassword'])) {
        $uid = $_POST['uid']; 
        $upw = $_POST['upassword'];
    } else {
        echo '<script>alert("아이디 또는 비밀번호가 입력되지 않았습니다");</script>';
        echo '<meta http-equiv="refresh" content="0; url=./index.php">';
    }

    if (isset($_POST['autolog'])) {
        $autolog = $_POST['autolog'];
    }

	$db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server"); 
	if(mysqli_connect_error()) { 
		echo "Fail to connect database."; 
	} 
	mysqli_set_charset($db_connect, 'utf8'); 

	$sql_query = "SELECT * FROM sting_member WHERE id = '$uid' AND password = '$upw'"; 
	$result = $db_connect -> query($sql_query); 
	$is_member = mysqli_num_rows($result); 

	if($uid == "" || $upw == "") {
		echo '<script>alert("아이디 또는 비밀번호가 입력되지 않았습니다");</script>';
		echo '<meta http-equiv="refresh" content="0; url=./index.php">';
	}

	else if ($is_member > 0) {
		$row=$result->fetch_assoc(); 
		$uname=$row["name"];
		$member_num = $row["member_num"];

			setcookie("uid","$uid",time()-3600); 
			setcookie("uname","$uname",time()-3600);
			setcookie("member_num","$member_num",time()-3600);
			setcookie("uid","$uid");//3hours
			setcookie("uname",$uname);
			setcookie("member_num","$member_num");

		if(isset($autolog)) {
			setcookie("uid","$uid",time()-3600); 
			setcookie("uname","$uname",time()-3600); 
			setcookie("member_num","$member_num",time()-3600);
			setcookie("uid","$uid",time()+60*60*24*90);//90 days
			setcookie("uname",$uname,time()+60*60*24*90);
			setcookie("member_num","$member_num",time()+60*60*24*90);
		}
		echo '<meta http-equiv="refresh" content="0; url=./main.php">'; 
	} else { 
		echo '<script>alert("아이디 혹은 비밀번호가 잘못되었습니다");</script>'; 
		echo '<meta http-equiv="refresh" content="0; url=./index.php">'; 
	} 

?>