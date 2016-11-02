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

<?php	   
	header("Content-Type: text/html; charset=UTF-8");		 



	function get_distance($lat1, $lon1, $lat2, $lon2) //km	   
	{	   
	  /* WGS84 stuff */	   
	  $a = 6378137;	   
	  $b = 6356752.3142;	   
	  $f = 1/298.257223563;	   
	  /* end of WGS84 stuff */	   

	  $L = deg2rad($lon2-$lon1);	   
	  $U1 = atan((1-$f) * tan(deg2rad($lat1)));	   
	  $U2 = atan((1-$f) * tan(deg2rad($lat2)));	   
	  $sinU1 = sin($U1);	   
	  $cosU1 = cos($U1);	   
	  $sinU2 = sin($U2);	   
	  $cosU2 = cos($U2);	   

	  $lambda = $L;	   
	  $lambdaP = 2*pi();	   
	  $iterLimit = 20;	   
	  while ((abs($lambda-$lambdaP) > pow(10, -12)) && ($iterLimit-- > 0)) {	   
		$sinLambda = sin($lambda);	   
		$cosLambda = cos($lambda);	   
		$sinSigma = sqrt(($cosU2*$sinLambda) * ($cosU2*$sinLambda) + ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda) * ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda));	   

		if ($sinSigma == 0) {	   
		  return 0;	   
		}	   

		$cosSigma   = $sinU1*$sinU2 + $cosU1*$cosU2*$cosLambda;	   
		$sigma	  = atan2($sinSigma, $cosSigma);	   
		$sinAlpha   = $cosU1 * $cosU2 * $sinLambda / $sinSigma;	   
		$cosSqAlpha = 1 - $sinAlpha*$sinAlpha;	   
		$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;	   

		if (is_nan($cos2SigmaM)) {	   
		  $cos2SigmaM = 0;	   
		}	   

		$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));	   
		$lambdaP = $lambda;	   
		$lambda = $L + (1-$C) * $f * $sinAlpha *($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));	   
	  }	   

	  if ($iterLimit == 0) {	   
		// formula failed to converge	   
		return NaN;	   
	  }	   

	  $uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b);	   
	  $A = 1 + $uSq/16384*(4096+$uSq*(-768+$uSq*(320-175*$uSq)));	   
	  $B = $uSq/1024 * (256+$uSq*(-128+$uSq*(74-47*$uSq)));	   
	  $deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM)));	   

	  return round($b*$A*($sigma-$deltaSigma) / 1000);	   


	/* sphere way */	   
	  $distance = rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));	

	  $distance *= 111.18957696; // Convert to km	   

	  return $distance;	   
	}	   
?>	   
<?php 
  $db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");	   
  mysqli_set_charset($db_connect, 'utf8');   
  $sql_query_route="SELECT * FROM sting_route WHERE member_num='".$_COOKIE['member_num']."' ORDER BY date DESC";	   
  $row_route = $db_connect -> query($sql_query_route);		
  $num_route = mysqli_num_rows($row_route);
  $value_route = $row_route -> fetch_assoc();		
?> 
<html>		 
	<head>		 
		<meta charset='utf-8'/>		 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />	   
		<link rel="stylesheet" href="dist/semantic.css" />		
		<script type="text/javascript" src="js/jquery.js"></script>		
		<script src="dist/semantic.js"></script>	   
		<script type="text/javascript">  
			function convertVisibility(num) {	   
				var id = "des" + num;	   
				var display = document.getElementById(id).style.display;	   
				if (display == "none") $('#' + id).removeAttr('style');	   
				else document.getElementById(id).setAttribute("style", "display: none");	  
			}  

			var traf;  
			var data; 

			function traffic() {   
   
			  var url="https://apis.skplanetx.com/tmap/traffic?version=1";   
			  url+="&appKey=c6541474-81d0-34f2-97d7-6a07cd360120"; 
			  url+="&reqCoordType=WGS84GEO"; 
			  url+="&resCoordType=WGS84GEO"; 
			  url+="&trafficType=AROUND";   
			  url+="&radius=5";   
			  url+="&"+"centerLat="+<?php echo $_COOKIE['ypos']; ?>;   
			  url+="&"+"centerLon="+<?php echo $_COOKIE['xpos']; ?>;   
			  url+="&zoomLevel=17";  
			  url+="&callback=getTraffic"; 

			  $.ajax({   
				  headers: { 
					Accept : "application/javascript;" 
				  },   
				  dataType: "json",   
				  url: url,   
				  data: data,	 
				  success: function(data) {   
					traf=data; 
				  }	 
				}).error(function(XMLHttpRequest, textStatus, errorThrown) {	 
					console.log(errorThrown);   
				}).complete(function() {  
				  getTraffic(traf);   
				});	 
			}  

		   

			function traffic_route()
			{
			  var iterating = <?php echo $value_route['vianum'];  ?> + 1;
			  <?php echo 'var x=['.$value_route["longitude0"].','.$value_route["longitude1"].','.$value_route["longitude2"].'];'; ?>
			  <?php echo 'var y=['.$value_route["latitude0"].','.$value_route["latitude1"].','.$value_route["latitude2"].'];'; ?>

			  for(var i=0; i<iterating ; i++)
			  {
				var url="https://apis.skplanetx.com/tmap/traffic?version=1";  
				url+="&appKey=c6541474-81d0-34f2-97d7-6a07cd360120"; 

				var miny = Math.min(y[i],y[i+1]);
				var maxy = Math.max(y[i],y[i+1]);
				var minx = Math.min(x[i],x[i+1]);
				var maxx = Math.max(x[i],x[i+1]);

				url+="&minLat="+miny;
				url+="&minLon="+minx;
				url+="&maxLat="+maxy;
				url+="&maxLon="+maxx; 
				url+="&resCoordType=WGS84GEO"; 
				url+="&zoomLevel=12";
				url+="&reqCoordType=WGS84GEO&";

				$.ajax({   
				  headers: { 
					Accept : "application/javascript;" 
				  },   
				  dataType: "json",   
				  url: url,   
				  data: data,	 
				  success: function(data) {   
					traf=data; 
				  }	 
				}).error(function(XMLHttpRequest, textStatus, errorThrown) {	 
					console.log(errorThrown);   
				}).complete(function() {  
				  getTraffic_route(traf);   
				});
			  }
			}

			function getTraffic(data) {  
			  //prevent to have same id num with festival  
			  for(var i = 0 ; i<data.features.length ; i++) {  
				  if(data.features[i] == "")  continue; 
				  if(data.features[i].properties == "") continue; 
				  if(data.features[i].properties.congestion!= 4 || data.features[i].properties.startNodeName=="" || data.features[i].properties.endNodeName=="")  continue; 

				  var appendNode = '<div class="item">'; 
				  appendNode += '<i class="car icon"></i><div class="content">';  
				  appendNode += '<a class="header" >' + data.features[i].properties.startNodeName + " → " + data.features[i].properties.endNodeName + ' <span style="color: #c0392b">정체</span></a></div></div>'; 
				  $('.list1').prepend(appendNode); 
				}  
				
			} 
			function getTraffic_route(data) {  
			  //prevent to have same id num with festival  
			  for(var i = 0 ; i<data.features.length ; i++) {  
				  if(data.features[i] == "")  continue; 
				  if(data.features[i].properties == "") continue; 
				  if(data.features[i].properties.congestion!= 4 || data.features[i].properties.startNodeName=="" || data.features[i].properties.endNodeName=="")  continue; 

				  var appendNode = '<div class="item">'; 
				  appendNode += '<i class="car icon"></i><div class="content">';  
				  appendNode += '<a class="header" >' + data.features[i].properties.startNodeName + " → " + data.features[i].properties.endNodeName + ' <span style="color: #c0392b">정체</span></a></div></div>'; 
				  $('.list2').prepend(appendNode); 
				}  
				
			}  

			/*function disaster()
			{
			  var lat=<?php echo $_COOKIE['ypos']; ?>;
			  var lon=<?php echo $_COOKIE['xpos']; ?>; 
			  var url="https://apis.skplanetx.com/tmap/traffic?version=1";   
			  url+="&appKey=c6541474-81d0-34f2-97d7-6a07cd360120"; 
			  url+="&reqCoordType=WGS84GEO"; 
			  url+="&resCoordType=WGS84GEO"; 
			  url+="&trafficType=ACC"; 
			  url+="&zoomLevel=17";  
			  url+="&minLat="+(lat-0.1);
			  url+="&minLon="+(lon-0.1);
			  url+="&maxLat="+(lat+0.1);
			  url+="&maxLon="+(lon+0.1);

			  $.ajax({   
				  headers: { 
					Accept : "application/javascript;" 
				  },   
				  dataType: "json",   
				  url: url,   
				  data: data,	 
				  success: function(data) {   
					traf=data; 
				  }	 
				}).error(function(XMLHttpRequest, textStatus, errorThrown) {	 
					console.log(errorThrown);   
				}).complete(function() {  
				  getDis(traf);   
				});	 
			}

			function getDis(data)
			{
				for(var i = 0 ; i<data.features.length ; i++) {   
				  if(data.features[i].properties.isAccidentNode!= 'Y')  continue; 

				  var appendNode = '<div class="item">'; 
				  appendNode += '<i class="car icon"></i><div class="content">';  
				  appendNode += '<a class="header" >' + data.features[i].properties.accidentDetailName + ' <span style="color: #c0392b">정체</span></a></div></div>'; 
						
				  appendNode+='<div class="description style="display: none;">';	
				  appendNode+=data.features[i].properties.description'</div>';	 
				  $('.list1').prepend(appendNode); 
				} 
			}*/


		</script>	   
		<style>	 
			.header {	 
				line-height: 40px;	 
				font-size: 120%;	 
			}	 
		</style>	 
	</head>		 
	<body>		
		<h1 id="ui title" style="background-color:#7ac943; padding:7%; color: #ffffff; margin-bottom:0; text-align: center;">AROUND ME</h1> 

		<div class="ui top attached tabular menu">	   
				<a class="active item" data-tab="first">내 주변 소식</a>	   
				<a class="item" data-tab="second">경로 주변 소식</a>	   
		</div>	   
		<div class="ui bottom attached active tab segment" data-tab="first">	   
			<div id="news_list" class="ui divided list list1">  
			<!-- traffics -->  
			<script>traffic();</script>  
			<!-- disaster -->
			<script>disaster();</script>

			<!-- festival -->  
				<?php		  

					$xpos=$_COOKIE["xpos"];  
					$ypos=$_COOKIE["ypos"];  

					$sql_query = "SELECT * FROM sting_festival WHERE 1";		
					$row = $db_connect -> query($sql_query);		
					$num = mysqli_num_rows($row);	   

					for($i = 0; $i < $num; $i++)	   
					{	   
						$value = $row -> fetch_assoc();	   

						if(get_distance($xpos,$ypos,$value['x'],$value['y']) <= 5.0 )	   
						{	   
							echo '<div class="item">';	   
							echo '<i class="bar icon"></i><div class="content">';	   
							echo '<a class="header" onclick="convertVisibility(' . $i . ')">'.$value['name'].'</a>';	  
							echo '<div class="description" id="des' . $i . '" style="display: none;">';	  
							echo '<p>일시 : ' . $value['startdate']." ~ ".$value['enddate'] . '<br/>';	   
							echo '장소 : ' . $value['address'] . '</p>';	   
							echo '</div></div></div>';	   
						}	   
					}	   
				?>  
			</div>	   
		</div>	   

		<div class="ui bottom attached tab segment" data-tab="second">  
			
    <?php
      if ($num_route != 0) { ?>
      <div class="ui divided list">
        <div class="item" id="route">
          <a href="route.php"><div class="right floated compact ui button">경로 추가</div></a>
          <script>traffic_route();</script>  
          <a class="header" href="edit.php">현재 경로 : <?php echo $value_route['name']; ?></a>
         </div>
      <?php } ?>

      </div>
      <div class="ui divided list list2">
				<?php	

				  if($num_route == 0) // route is EMPTY!!	
				  {	
					echo '<div class="item"><h1>경로가 설정되어 있지 않습니다.</h1>';	
					echo '<a href="route.php"><p>경로 설정하러 가기</p></a></div>';	
				  }	 
				  else	
				  {	 
					$value_route = $row_route -> fetch_assoc(); 
					for($i = 0; $i < $value_route['vianum'] + 1; $i++)	   
					{		
							
						$x1 = $value_route['longitude' . $i];	
						$x2 = $value_route['longitude' . ($i+1)];	
						$y1 = $value_route['latitude' . $i];	
						$y2 = $value_route['latitude' . ($i+1)];	

						$min_x=min($x1,$x2);	
						$max_x=max($x1,$x2);	
						$min_y=min($y1,$y2);	
						$max_y=max($y1,$y2);	

						$sql_query = "SELECT * FROM sting_festival WHERE 1";		
						$row = $db_connect -> query($sql_query);	   

						for($j = 0; $j < $num; $j++)	
						{	
						  $value = $row -> fetch_assoc();	 

						  $fest_x = $value['x'];	
						  $fest_y = $value['y'];	

						  if($min_x <= $fest_x && $max_x >= $fest_x && $min_y <= $fest_y && $max_y >= $fest_y)	   
						  {
							  echo '<div class="item">';	   
							  echo '<i class="bar icon"></i><div class="content">';	   
							  echo '<a class="header" onclick="convertVisibility(' . ($j+100000) . ')">'.$value['name'].'</a>';	  
							  echo '<div class="description" id="des' . ($j+100000) . '" style="display: none;">';	  
							  echo '<p>일시 : ' . $value['startdate']." ~ ".$value['enddate'] . '<br/>';	   
							  echo '장소 : ' . $value['address'] . '</p>';	   
							  echo '</div></div></div>';
						  }	   
						}	
					}						
				  }	
				?>	
			</div>	
		</div>	 
		<p>메인 화면으로 돌아가려면 v를 밑으로 내려주세요</p>		

		<script>	 
		  $('.menu .item')	 
			  .tab()	 
		  ;	 
		</script>	 
	</body>		 
</html> 