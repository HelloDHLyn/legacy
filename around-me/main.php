<?php   

    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT"); //Date in the past  
    header("Cache-Control: no-store, no-cache, must-revalidate"); //HTTP/1  
      
    if(!isset($_COOKIE["uname"]))   
    {   
        echo "<script> alert(\"다시 로그인을 해주세요\"); </script>";   
        setcookie("uid","$uid",time()-3600);   
        setcookie("uname","$uname",time()-3600);   
        echo '<meta http-equiv="refresh" content="0; url=./index.php">';  
    }  
?>  

<html>    
<head>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />  
    <meta type="text/html" charset="utf-8" />
    <link rel="stylesheet" href="dist/semantic.css" /> 
    <script type="text/javascript" src="js/jquery.js"></script> 
    <script type="text/javascript" src="dist/semantic.js"></script> 
    <script type="text/javascript" src="js/main.js"></script>
    <style>
    .header {
	    background-color: #7AC943;
		padding: 5%;
		margin-top: 0;
		width : 100%;
		font-size: 15pt;
		color: #ffffff;
	}

	i {
		text-decoration: none;
	}
    </style>
</head>    
<body>
	<div>
		<button id="getlocation" onClick="getLocation()" style="display: none;" ></button>
		<div class="header">
			<div class="ui fluid two column grid">
				<div class="column left aligned" style="height: 1.5em;">
					<i class="location arrow icon"></i> <i id="location">가져오는 중...</i>
				</div>
				<div class="column right aligned" style="height: 1.5em;">
					<a href="javascript:logout()"><div class="mini ui inverted button">로그아웃</div></a>
				</div>

				<div class="ui row" style="text-align: center;">
					<h1 style="padding: 10px 0;">AROUND ME</h1>
				</div>
			</div>

			<script type="text/javascript">    
		        $("#getlocation").click();    
		        checkDetection();    
		    </script>
		</div>  
	</div>  

	<div class="ui fluid center aligned segment" style="margin: 0;">
		<div class="ui fluid">
			<img class="ui small centered image" src="" id="weatherImage"/> 

		    <h1>환영합니다!</h1>  
		    <p>  
		        <i id="greet"></i> <?php echo $_COOKIE["uname"]; ?>님  

		        <script type="text/javascript">  
		            var current = new Date();  
		            var time = current.getHours();  
		            var ment = document.getElementById("greet");  
		            setGreet();
		        </script>  
		    </p>  

		    <p>  
		        <i id="time"></i> | 날씨: <i id="weatherText"></i>  
		        <script type="text/javascript">  
		            var current=new Date();  
		            var hour=current.getHours(),minute=current.getMinutes();  
		            var time=document.getElementById("time");    
		            window.addEventListener("load",setTime);  
		        </script>  
		    </p>

		    <p>  
		        <i id="ment"></i>  
		        <script type="text/javascript">  
		            var ment = document.getElementById("ment");    
		        </script>  
		    </p>  
		</div>

		<div class="ui active inverted dimmer" id="dimmer">
			<div class="ui active text loader" id="loader">위치 정보 확인중...</div>
		</div>

		<footer style="padding-top: 40px;" >
		    <a href="content1.php"><i class="angle up icon"></i></a>
		    <h6>뉴스를 보려면 ^를 위로 올려주세요</h6> 
		</footer>
	</div>
</body>    
</html>