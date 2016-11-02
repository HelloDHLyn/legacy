<?php 

    header("Content-Type: text/html; charset=UTF-8"); 

    $uname = $_POST['uname']; 
    $uid = $_POST['uid']; 
    $upw = $_POST['upassword']; 

    $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server"); 

    if(mysqli_connect_error()) { 
        echo "Fail to connect database."; 
    } 
    mysqli_set_charset($db_connect, 'utf8'); 

    $sql_query = "SELECT * FROM sting_member"; 
    $result = $db_connect -> query($sql_query); 
    $unum = mysqli_num_rows($result) + 1; 

    $sql_query = "INSERT INTO sting_member VALUES('$unum', '$uid', '$upw', '$uname')"; 
    $result = $db_connect -> query($sql_query);

    echo '<script> alert("가입 완료!");</script>';
	echo '<meta http-equiv="refresh" content="0; url=./index.php">';
?>
