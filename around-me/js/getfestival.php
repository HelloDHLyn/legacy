<html>
<head>
	<meta type="text/html" charset="utf-8" />
	<script src="jquery.js"></script>
</head>
<body>
<script>
	var date = new Date();
	var today = "2015";
	if(date.getMonth() < 9)
		today += "0" + (date.getMonth() + 1);
	else
		today += (date.getMonth() + 1);
	if(date.getDate() < 10)
		today += "0" + date.getDate();
	else
		today += date.getDate();

	var url = "http://api.visitkorea.or.kr/openapi/service/rest/KorService/searchFestival?";
        		url += "ServiceKey=";
        		url += ("C%2FLPglwTdwLIueXg8x6fe6dBm1fhsqjXUlWiXMAxnMAo00uIQsmrQ%2BAdUCtrxgy%2F%2F4F%2B%2Fz4RYK3fxMEY8PboXQ%3D%3D");
        		url += "&MobileOS=AND";
        		url += "&MobileApp=STING";
        		url += "&numOfRows=100";
        		url += "&pageNo=1";
        		url += "&eventStartDate=" + today;
        		url += "&eventEndDate=" + today;
        		url += "&_type=json";

    var result;

    $.getJSON(url, function (data) { 
    	result = data;
    	pushData();
    });

    function pushData() {
    	for (var i = 0; i < 100; i++) {
    		var title = result.response.body.items.item[i].title;	
    		var startDate = result.response.body.items.item[i].eventstartdate;
    		var endDate = result.response.body.items.item[i].eventenddate;
    		var address = result.response.body.items.item[i].addr1;
			var mapx = result.response.body.items.item[i].mapx;
    		var mapy = result.response.body.items.item[i].mapy;

    		var pushUrl = "pushtodatabase.php?title=" + title
    					+ "&startDate=" + startDate
    					+ "&endDate=" + endDate
    					+ "&mapx=" + mapx
    					+ "&mapy=" + mapy
    					+ "&address=" + address;

    		$.get(pushUrl).done(function(data) { });
    	}
    }
    /*
	$.ajax({  
		headers: {'Access-Control-Allow-Origin': '*'}, 
		dataType: "json",
		url: url, 
		data: data, 
		success: function(data) { 
			var name = response.body.items.item[0].title;
			document.writeln(name);
		} 
	}).error(function(XMLHttpRequest, textStatus, errorThrown) { 

	}).complete(function() {

	}); */
</script>
	<p>Hello, world!</p>
	<script>
	
	</script>
</body>
</html>