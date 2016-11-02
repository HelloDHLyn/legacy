<?php 
    if(isset($_COOKIE["uname"])) {    
        echo '<meta http-equiv="refresh" content="0; url=./main.php">'; 
    } 
?> 

<html>  
    <head>  
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="style.css"> 
        <link rel="stylesheet" href="dist/semantic.css" /> 
        <script src="dist/semantic.js"></script>
        <script type="text/javascript">
            $('.ui.checkbox')
                .checkbox()
            ;
        </script>
        <title>AROUND ME</title>  
    </head>  
    <body>  
        <h1 id="ui title" style="background-color:#7ac943; padding:7%; color: #ffffff; margin-bottom:0;">AROUND ME</h1> 
        <div class="ui segment" style="margin-top:0; padding-top:10%;"> 
            <div class="relaxed fitted stackable grid"> 
                <div class="ui form input"> 
                    <form method="post" action="login.php">  
                        <div class="field"> 
                            <div class="ui left icon input"> 
                                <input type="text" name="uid" class="textbox" placeholder="아이디" /> 
                                <i class="users icon"></i> 
                            </div> 
                            <div class="ui left icon input"> 
                                <input type="password" name="upassword" class="textbox" placeholder="비밀번호" /> 
                                <i class="lock icon"></i> 
                            </div> 
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="autolog" id="autolog" />
                                <label for="autolog">자동 로그인</label>
                            </div>
                        </div> 
                        <div class="field"> 
                            <div class="ui"> 
                                <input type="submit" value="로그인" class="ui button" /> 
                            </div> 
                        </div>
                    </form>
                </div> 

                <div class="ui divider"></div> 

                <div class="ui"> 
                    <p>처음이세요? <a href="join.php">새로 만들기</a></p> 
                    <div class="ui celled horizontal list"> 
                        <div class="item"><a href="">아이디 찾기</a></div> 
                        <div class="item"><a href="">비밀번호 찾기</a></div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </body> 

    <footer>  
        <div id="copy"> 
            <strong id="copyright_text" style="color: #ffffff;">&copy; Copyright by STING 2015</strong> 
        </div> 
    </footer>  
</html>