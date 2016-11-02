<?php 

    $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");  
    mysqli_set_charset($db_connect, 'utf8');   
    $index = $_GET["index"];  

    date_default_timezone_set('Asia/Seoul'); 
    $day = date("Y-m-d H:i:s"); 

    $mysql_query = "UPDATE sting_route SET date = '" . $day . "' WHERE code = " . $index . ";";  
    $db_connect->query($mysql_query); 
?>