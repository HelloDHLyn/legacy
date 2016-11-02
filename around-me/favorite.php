<?php 
     
    $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server"); 
    mysqli_set_charset($db_connect, 'utf8');  
    $index = $_GET["index"]; 
    $sql_query = "SELECT * FROM sting_route WHERE code = " . $index . ";"; 

    $row = $db_connect->query($sql_query); 

    $value = $row->fetch_assoc(); 
    $mysql_query="";
    if($value["is_favorite"]==0)     
    { 
        $mysql_query = "UPDATE sting_route SET is_favorite = 1 WHERE code = " . $index . ";"; 
    } 
    else 
    { 
        $mysql_query = "UPDATE sting_route SET is_favorite = 0 WHERE code = " . $index . ";"; 
    } 
    $db_connect->query($mysql_query);
?>