<?php  
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT"); //Date in the past  
	header("Cache-Control: no-store, no-cache, must-revalidate"); //HTTP/1  
	if(!isset($_COOKIE["uname"]))  
	{  
		echo '<script> alert("다시 로그인을 해주세요"); </script>';  
		setcookie("uid", "$uid", time() - 3600);
		setcookie("uname", "$uname", time() - 3600);  
		echo '<meta http-equiv="refresh" content="0; url=./index.php">';
	}  
?> 

<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" /> 
	<script type="text/javascript" src="js/jquery.js"></script> 
	<link rel="stylesheet" href="dist/semantic.css" /> 
	<script src="dist/semantic.js"></script> 
    <script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=adc714cf983ffe3f1228c52fa13c71a4"></script>
	<script>
		var pointName = new Array(0);
		var longitude = new Array(0);
		var latitude = new Array(0);

        function pushToDatabase() {
            var member_num = <?php echo '"' . $_COOKIE['member_num'] . '"'; ?>;

            var routeName = prompt("추가 할 경로의 별칭을 입력하세요.");

            var pushUrl = "script/pushtodatabase.php?mode=route"
                        + "&name=" + routeName
                        + "&vianum=" + (pointName.length - 2)
                        + "&name0=" + pointName[0]
                        + "&lng0=" + longitude[0]
                        + "&lat0=" + latitude[0]
                        + "&name1=" + pointName[1]
                        + "&lng1=" + longitude[1]
                        + "&lat1=" + latitude[1]
                        + "&name2=" + pointName[2]
                        + "&lng2=" + longitude[2]
                        + "&lat2=" + latitude[2]
                        + "&name3=" + pointName[3]
                        + "&lng3=" + longitude[3]
                        + "&lat3=" + latitude[3]
                        + "&name4=" + pointName[4]
                        + "&lng4=" + longitude[4]
                        + "&lat4=" + latitude[4];

            $.get(pushUrl).done(function(data) { });
            moveParent();
        }

        function moveParent() {
        	$(location).attr('href', './content1.php');
        }
	</script>
	<title>AROUND ME | 루트 설정</title> 
</head> 
<body> 
	<h1 id="ui title" style="background-color:#7ac943; padding:7%; color: #ffffff; margin-bottom:0; text-align: center;">경로 설정</h1> 
	<div class="ui form segment" style="margin-top: 0;">
		<div class="ui field">
		<div class="ui search">
			<div class="ui fluid action input">
				<input class="prompt" type="text" id="query0" onblur="offList(0)" placeholder="출발지 검색...">
				<button onclick="updateResults(0)" class="ui button">검색</button>
			</div>
			<div class="results transition hidden" id="result0">
			</div>
		</div>
		</div>
		<div class="ui field">
		<div class="ui search">
			<div class="ui fluid action input">
				<input class="prompt" type="text" id="query1" onblur="offList(1)" placeholder="경유지 검색...">
				<button onclick="updateResults(1)" class="ui button">검색</button>
			</div>
			<div class="results transition hidden" id="result1">
			</div>
		</div>
		</div>
		<div class="ui field">
		<div class="ui search">
			<div class="ui fluid action input">
				<input class="prompt" type="text" id="query2" onblur="offList(2)" placeholder="도착지 검색...">
				<button onclick="updateResults(2)" class="ui button">검색</button>
			</div>
			<div class="results transition hidden" id="result2">
			</div>
		</div>
    </div>
    <div class="ui middle aligned grid">
        <div class="center aligned column">
            <div class="green ui labeld icon button" onclick="pushToDatabase()"><i class="checkmark icon"></i> 완료</div>
            <div class="red ui labeld icon button" onclick="moveParent()"><i class="remove icon"></i> 취소</div>
        </div>
    </div>

		<script>
			var data;

			function offList(num) {
				document.getElementById("result" + num).className = "results transition hidden";
			}

			function selectItem(lon, lat, name, num) {
				offList(num);
				longitude[num] = lon;
				latitude[num] = lat;
				pointName[num] = name;

                document.getElementById("query" + num).value = name;

                var searchPosition = new daum.maps.LatLng(lat, lon); 
                map.setCenter(searchPosition);
                var marker = new daum.maps.Marker( {
                    position: searchPosition
                });
                marker.setMap(map);

				offList(num);
			}

			function updateResults(num) {

				var url = "https://apis.daum.net/local/v1/search/keyword.{format}?apikey=e1a79bd94d9e980b197e3f4fdcae6452";  
				url += "&query=" + document.getElementById("query" + num).value;
				url += "&output=json";  

				if (document.getElementById("query" + num).value == "") {
					document.getElementById("result" + num).className = "results transition hidden";
				}

				else {
					document.getElementById("result" + num).className = "results transition visible";

					$.ajax({	
						headers: {'Access-Control-Allow-Origin': '*'},
						dataType: "jsonp",
						url: url,  
						data: data,
						success: function(data) {
							var data_num = parseInt(data.channel.info.count);

							var content = "";

							if (data_num == 0) {
								content += '<a class="result">';
								content += '<div class="content">';
								content += '<div class="title">검색 결과가 없습니다.</div>';
								content += '<div class="description">검색어를 바꿔서 다시 검색해주세요.</div>';
								content += '</div></a>';
							}
							else {
								for (var i = 0; i < data_num; i++) {
									content += '<a class="result" href="javascript:selectItem('
										+ data.channel.item[i].longitude + ', ' + data.channel.item[i].latitude + ', \'' + data.channel.item[i].title + '\', ' + num + ')">';
									content += '<div class="content">';
									content += '<div class="title">' + data.channel.item[i].title + '</div>';
									content += '</div></a>';
								}
							}

							document.getElementById("result" + num).innerHTML = content;
						}  
					}).error(function(XMLHttpRequest, textStatus, errorThrown) {	
						console.log(errorThrown);  
					}).complete(function() {  

					});
				}
			}
		</script>

		<div class="ui segment" id="map" style="height: 250px">
		</div>

        <script>
            var container = document.getElementById('map'); 
            var options = { 
                center: new daum.maps.LatLng(33.450701, 126.570667), 
                level: 5
            };

            var map = new daum.maps.Map(container, options);
        </script>
	</div>
</body> 
</html>