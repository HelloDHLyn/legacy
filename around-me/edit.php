<!DOCTYPE html>

<!-- 삭제, 선택, 즐겨찾기 -->
<html>
    <head>
        <meta charset="utf-8" />
        <title>Around Me | 경로 수정</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />   
        <link rel="stylesheet" href="dist/semantic.css" />    
        <script type="text/javascript" src="js/jquery.js"></script>        
        <script src="dist/semantic.js"></script>   
        <script>  
            function convertVisibility(num) 
            {    
                var id = "des" + num;    
                var display = document.getElementById(id).style.display;    
                if (display == "none") $('#' + id).removeAttr('style');    
                else document.getElementById(id).setAttribute("style", "display: none");   
            }   
            function change_favorite(code)
            {
                var pushUrl="favorite.php?index="+code;
                $.get(pushUrl).done(function(data){});

                var starClassNumber = document.getElementById("star" + code).className;
                if (starClassNumber === "star icon")
                    document.getElementById("star" + code).className = "empty star icon";
                else
                    document.getElementById("star" + code).className = "star icon";
            }
            function select_route(code)
            {
                var pushUrl="route_select.php?index="+code;
                $.get(pushUrl).done(function(data){}); 
                location.replace("content1.php");
            }
            function delete_route(code)
            {
                var pushUrl="route_delete.php?index="+code;
                $.get(pushUrl).done(function(data){});
                location.reload();                
            }
        </script>
        <style>
            .head {
                text-align: center;
                background-color: #7ac943;
                padding: 5%;
                margin-top: 0;
                width: 100%;    
            }

            .ui.header {
                padding-top: 10px;
                padding-bottom: 10px;
                margin-top: 0;
                color: #ffffff;
                font-weight: bold;
                font-family: "Nanum Gothic";
            }

            .header { 
                line-height: 40px; 
                font-size: 120%; 
            }

            footer {
                text-align: center;
                vertical-align: bottom;
                height: 15%;
                bottom: 0;
                width: 100%;
                position: absolute;
            }
        </style>
    </head>
    <body>

        <?php
            $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");
            mysqli_set_charset($db_connect, 'utf8'); 
        ?>
        <div class="head">
            <a href="main.php"><i class="angle down icon"></i></a>
            <h1 class="ui header">경로 선택</h1>
        </div>

        <div class="ui fluid center aligned segment" style="margin:0; text-align:left;">
            <div class="ui divided list">
                <?php
                    $sql_query = "SELECT * FROM sting_route WHERE member_num=".$_COOKIE["member_num"];
                    $row = $db_connect -> query($sql_query);    
                    $num = mysqli_num_rows($row);

                    if($num == 0)
                    {
                        echo '<script>alert("남아있는 경로가 없습니다!");</script>';
                        echo '<script>location.replace("content1.php");</script>';
                    }

                    for ($i = 0; $i < $num; $i++) 
                    {
                        $value = $row -> fetch_assoc();
                        if($value["is_favorite"] != 1)    continue;

                        echo '<div class="item">';
                        echo '<a href="javascript:change_favorite('.$value["code"].')">';
                        echo '<i id="star' . $value['code'] .'" class="star icon" style="float:right; font-size:22pt;"></i>';
                        echo '</a>';
                        echo '<div class="content">';

                        echo '<a class="header"  onclick="convertVisibility(' . $i . ')">'.$value['name'].'</a>';

                        echo '<div class="description" id="des' . $i . '" style="display: none;">';
                        for($j = 0 ; $j < $value['vianum']+2 ; $j++)
                        {
                            if($j == 0)
                                echo $value['name'.$j] ;
                            else
                                echo " -> ".$value['name'.$j] ;                            
                        }
                        echo '<a href="javascript:select_route('.$value["code"].')"><div>선택</div></a>';
                        echo '<a href="javascript:delete_route('.$value["code"].')"><div>삭제</div></a>';
                        echo '</div></div></div>';
                    }

                    $row = $db_connect -> query($sql_query);  
                
                    for ($i = 0; $i < $num; $i++) 
                    {
                        $value = $row -> fetch_assoc();
                        if($value["is_favorite"] != 0)    continue;

                        echo '<div class="item">';
                        echo '<a href="javascript:change_favorite('.$value["code"].')">';
                        echo '<i id="star' . $value['code'] .'" class="empty star icon" style="float:right; font-size:22pt;"></i>';
                        echo '</a>';
                        echo '<div class="content">';

                        echo '<a class="header"  onclick="convertVisibility(' . $i . ')">'.$value['name'].'</a>';

                        echo '<div class="description" id="des' . $i . '" style="display: none;">';
                        for($j = 0 ; $j < $value['vianum']+2 ; $j++)
                        {
                            if($j == 0)
                                echo $value['name'.$j] ;
                            else
                                echo " -> ".$value['name'.$j] ;                            
                        }
                        echo '<a href="javascript:select_route('.$value["code"].')"><div>선택</div></a>';
                        echo '<a href="javascript:delete_route('.$value["code"].')"><div>삭제</div></a>';
                        echo '</div></div></div>';
                    }

                ?>
            </div>
        </div>
    </body>
    <footer>
        <div class="ui divider"></div>
        <p class="to_main">메인 화면으로 돌아가려면 <i class="angle down icon" style="color:#009fda;"></i>를 밑으로 내려주세요</p>
    </footer>
</html>