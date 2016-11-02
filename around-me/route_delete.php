<?php

    $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server"); 
    mysqli_set_charset($db_connect, 'utf8');  
    $index = $_GET["index"]; 

    $mysql_query = "DELETE FROM sting_route WHERE code = " . $index . ";"; 
    $db_connect -> query($mysql_query);

?>