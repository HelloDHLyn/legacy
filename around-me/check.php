<?php 
    header("Content-Type: text/html; charset=UTF-8");  

    $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");  

    $result = $_GET["id"]; 
    $sql_query = "SELECT * FROM sting_member WHERE id = '$result'"; 
    $row = $db_connect -> query($sql_query); 
    $num = mysqli_num_rows($row); 

    if($num > 0) { 
    ?> 
        <script> 
            alert("<?=$result?>은(는) 이미 가입된 아이디 입니다."); 
            parent.document.getElementById("check").value = -1; 
        </script> 
    <?php 
    } 

    else { 
    ?> 
        <script> 
            alert("<?=$result?>은(는) 중복된 아이디가 없습니다. 사용하셔도 좋습니다."); 
            parent.document.getElementById("check").value = 1; 
        </script> 
    <?php 
    } 
?>