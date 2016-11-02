<html> 
<head> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>AROUND ME | 회원 가입</title> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="dist/semantic.js"></script>
    <script type="text/javascript"> 
        function id_check() 
        { 
            var f=document.joinform.uid; 
            if(f.value=="") 
            { 
                alert("아이디를 입력하세요"); 
                f.id.focus(); 
                return; 
            } 
            hiddenframe.location.href="./check.php?id="+document.joinform.uid.value; 
        } 

        function Form_Send() 
        { 
            var f=document.joinform; 

            if(f.id_enabled.value=='') 
            { 
                alert("아이디 중복 체크를 하세요"); 
                return; 
            } 
            if(f.uname.value=='') 
            { 
                alert("이름을 입력하세요."); 
                return; 
            } 
            if(f.upassword.value=='') 
            { 
                alert("비밀번호를 입력하세요"); 
                return; 
            } 
            if(f.upasswordCheck.value=='') 
            { 
                alert("비밀먼호 확인을 입력하세요"); 
                return; 
            } 
            if(f.upassword.value!=f.upasswordCheck.value) 
            { 
                alert("비밀번호 확인을 다시하세요 ㅡㅡ"); 
                return; 
            } 
            if(f.id_enabled.value == -1) 
            { 
                alert("중복된 아이디가 있습니다."); 
                return; 
            } 
            document.joinform.submit(); 
        } 
        // <!-- 중복체크 후 다시 입력을 변경한 경우 체크--> 
    </script>
    <link rel="stylesheet" href="dist/semantic.css" />
    <style type="text/css">
        /*
        body {
            text-align: center;
        }

        #title {
            margin-bottom: 15%;
            padding: 7%;
            background-color: #7ac943;
        }

        .ui.form {
            margin-bottom: 0;
        }

        label {
            text-align: left;
            padding-left: 3%;
        }

        .ui.submit.button {
            margin-top: 5%;
            background-color: #7ac943;
        }

        */
        .check_button {
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>  
    <div>
        <h1 id="ui title" style="background-color:#7ac943; padding:7%; color: #ffffff; margin-bottom: 0; text-align: center;">회원 가입</h1> 
        <div class="ui segment" style="margin-top: 0;">
            <div class="ui form" style="margin: 5%;">
                <form name="joinform" method="post" action="register.php" />
                    <div class="ui required field" style="margin-left: auto; margin-right: auto;">
                        <label>이름:</label>
                        <input type="text" name="uname" placeholder="이름"/><br/>
                    </div>
                    <div class="ui required field" style="margin-left: auto; margin-right: auto;">
                        <label>아이디:<span onclick="id_check();" class="check_button">중복체크</span></label>
                        <div class="ui icon input">
                            <input type="text" name="uid" class="_text" placeholder="아이디"/>
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="ui required field" style="margin-left: auto; margin-right: auto;">
                        <label>비밀번호:</label>
                        <div class="ui icon input">
                            <input type="password" name="upassword" placeholder="비밀번호"/>
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui required field" style="margin-left: auto; margin-right: auto;">
                        <label>비밀번호 확인:</label>
                        <div class="ui icon input">
                            <input type="password" name="upasswordCheck" placeholder="비밀번호 확인"/>
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <input type="hidden" id="check" name="id_enabled" value="">   
                    <div onclick="Form_Send();" value="만들기" class="ui submit button">만들기</div>
                    <iframe name="hiddenframe" height="0" width="0"></iframe>   
                </form> 
            </div>
        </div>
    </div> 
</body>   
</html>