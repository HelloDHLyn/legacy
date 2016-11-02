var longitude,latitude;   
var address = "";   
var weather;  

function getLocation()    
{    
    if (navigator.geolocation)          
    {    
        navigator.geolocation.watchPosition(processPosition);    
    }     
    else     
    {     
        // <!-- 예외처리 하세요-->   
    }    
}    

function setCurrentPosition()   
{       
    var data;   
    var url = "https://apis.daum.net/local/geo/coord2addr?apikey=e1a79bd94d9e980b197e3f4fdcae6452";   
    url += "&longitude=" + longitude;   
    url += "&latitude=" + latitude;   
    url += "&inputCoordSystem=WGS84&output=json";   

    $.ajax({   
        headers: {'Access-Control-Allow-Origin': '*'},   
        dataType: "jsonp",   
        url: url,   
        data: data,   
        success: function(data) {   
            address += data.name2 + " " + data.name3;   
        }   
    }).error(function(XMLHttpRequest, textStatus, errorThrown) {   
        console.log(errorThrown);   
        address = "";   
    }).complete(function() {   
        var location = document.getElementById("location");    
        location.innerHTML = address;   
           getWeather();  
    });   
}   

function processPosition(position)    
{    
    latitude = position.coords.latitude;    
    longitude = position.coords.longitude;  
    document.cookie = "xpos = " + longitude + ";" + "expires = Fri, 1 Jan 2016 12:00:00 UTC";  
    document.cookie = "ypos = " + latitude + ";" + "expires = Fri, 1 Jan 2016 12:00:00 UTC";  

}    

function checkDetection() {    
    if (longitude == null)    
        setTimeout("checkDetection();", 1000);    
    else    
    {   
        setCurrentPosition();   
        document.getElementById("location").innerHTML = address;    
    }   
}    

function getWeather()  
{  
    var data;  
    var url="http://api.openweathermap.org/data/2.5/weather?";  
    url+="lat="+latitude;  
    url+="&lon="+longitude;  

    $.ajax({    
        headers: {'Access-Control-Allow-Origin': '*'},   
        dataType: "jsonp",   
        url: url,   
        data: data,   
        success: function(data) {   
            weather=data.weather[0].id;  
        }   
    }).error(function(XMLHttpRequest, textStatus, errorThrown) {   
        weather="";  
    }).complete(function() {  
        setWeatherImage();   
        setWeather();   
        setMent();   
    });   
}  

function logout()  
{  
    document.cookie="uname=;expires=Thu, 01 Jan 1970 00:00:01 GMT";  
    document.cookie="uid=;expires=Thu, 01 Jan 1970 00:00:01 GMT";  
    alert("로그아웃이 정상적으로 되었습니다.");  
    window.location.href = "index.php";  
}  

function setWeatherImage()   
{   
    var image=document.getElementById("weatherImage");   

    if(weather==800)   
    {   
        image.setAttribute("src","img/sunny.png");   
    }      
    else if(weather==801 || weather==802)   
    {   
        image.setAttribute("src","img/littlecloudy.png");   
    }           
    else if(weather>800)   
    {   
        image.setAttribute("src","img/cloudy.png");   
    }      
    else if( (weather >= 300 && weather < 600) &&  weather != 511)   
    {   
        image.setAttribute("src","img/rainy.png");                           
    }      
    else if( weather==600 || weather==601 || weather==602 || weather==620 ||    
            weather==621 || weather==622 ||  weather == 511)   
    {   
        image.setAttribute("src","img/snow.png");                           
    }          
    else if(weather > 600 && weather < 700)   
    {   
        image.setAttribute("src","img/rainandsnow.png");       
    }      
    else if( weather==200 || weather==201 || weather==202 || weather==230 ||    
            weather==231 || weather==232)   
    {   
        image.setAttribute("src","img/thunderandrain.png");                           
    }    
    else if(weather>200 && weather < 300)   
    {   
        image.setAttribute("src","img/thunder.png");                               
    }   
    else   
    {   
        image.setAttribute("src","img/fog.png");   
    }   

    document.getElementById('loader').className = "ui loader";
    document.getElementById('dimmer').className = "ui dimmer";
}  

function setGreet()  
{  
    if(time>=6 && time<12)  
    {  
        var limit=4;  
        var index=Math.floor(Math.random()*limit);  
        if(index<2)  
        {  
            var str=["좋은 아침이에요!","오늘도 즐거운 하루 되세요!"];  
            ment.innerHTML=str[index];  
        }  
        else if(current.getDay()<=5)  
        {  
            var str=["졸음을 이겨내고 오늘도 화이팅!","어서 일어나셔야죠! 아침이 밝았어요! OOO님!"];  
            ment.innerHTML=str[index-2];  
        }  
        else  
        {  
            var str=["편안한 아침, 여유롭게 하루를 시작하세요!","오늘 하루종일 뭐하고 보내실 지 생각해놓으셨나요?"];  
            ment.innerHTML=str[index-2];  
        }  
    }  
    else if(time>=12 && time<=18)  
    {  
        var limit=4;  
        var index=Math.floor(Math.random()*limit);  
        if(index<3)  
        {  
            var str=["점심은 드셨나요?","오늘 하루 어떻게 보내고 계신가요,","남은 하루 알차게 보내세요!"];  
            ment.innerHTML=str[index];  
        }  
        else if(current.getDay()<=5)  
        {  
            ment.innerHTML="조금만 더 힘냅시다! 화이팅!";  
        }  
        else  
        {  
            ment.innerHTML="즐거운 휴식이 되고 계신가요,";  
        }  
    }  
    else  
    {
        var limit=4;  
        var index=Math.floor(Math.random()*limit);  
        if(index<3)  
        {  
            var str=["오늘 하루 잘 보내셨나요?","저녁은 맛있게 드셨나요,","남은 하루 즐겁게 보내세요!"];  
            ment.innerHTML=str[index];  
        }  
        else if(current.getDay()<=5)  
        {  
            ment.innerHTML="피곤하지 않으신가요,";  
        }  
        else  
        {  
            ment.innerHTML="오늘 하루 잘 쉬셨나요,";  
        }  
    }  
}

function setTime()  
{  
    if(hour<12)//오전  
    {  
        if(minute<10)  
            time.innerHTML="오전 "+hour+":0"+minute;  
        else  
            time.innerHTML="오전 "+hour+":"+minute;                              
    }  
    else  
    {  
        if(minute<10)  
            time.innerHTML="오후 "+(hour-12)+":0"+minute;  
        else  
            time.innerHTML="오후 "+(hour-12)+":"+minute;    
    }  
}  

function setWeather()  
{  
    var text=document.getElementById("weatherText");  

    if(weather==800)  
    {  
        text.innerHTML="맑음";  
    }     
    else if(weather==801 || weather==802)  
    {  
        text.innerHTML="구름 낌";  
    }    
    else if(weather>800)  
    {  
        text.innerHTML="흐림";  
    }     
    else if( (weather >= 300 && weather < 600) &&  weather != 511)  
    {  
        text.innerHTML="비";                      
    }     
    else if( weather==600 || weather==601 || weather==602 || weather==620 ||   
            weather==621 || weather==622 ||  weather == 511)  
    {  
        text.innerHTML="눈";                          
    }         
    else if(weather > 600 && weather < 700)  
    {  
        text.innerHTML="눈과 비";      
    }     
    else if( weather==200 || weather==201 || weather==202 || weather==230 ||   
            weather==231 || weather==232)  
    {  
        text.innerHTML="천둥번개와 비";                      
    }   
    else if(weather>200 && weather < 300)  
    {  
        text.innerHTML="천둥번개";                              
    }  
    else  
    {  
        text.innerHTML="안개";  
    }  
}

function setMent()  
{  
    var limit=3;  
    var index=Math.floor(Math.random()*limit);  
    if(weather==800)  
    {  
        var str=["화창한 날씨에요! 외출하기 딱 좋네요!","기분 좋은 날씨네요! 구름 한 점 없어요!","오늘 날씨처럼 밝고 기분좋은 하루 보내세요!"];  
        ment.innerHTML=str[index];  
    }     
    else if(weather==801 || weather==802)  
    {  
        var str=["구름이 살짝 낀 화창한 날씨입니다!","외출하기에 딱 좋은 날씨에요!","구름이 조금 꼈지만 기분 좋은 날씨입니다!"];  
        ment.innerHTML=str[index];  
    }    
    else if(weather>800)  
    {  
        var str=["기분까지 우중충해지는 날씨지만 오늘도 힘내세요!","흐리지만 마음만은 밝게 가집시다!","구름이 많이 꼈습니다. 혹시 모를 강우에 대비하세요!"];  
        ment.innerHTML=str[index];  
    }     
    else if( (weather >= 300 && weather < 600) &&  weather != 511)  
    {    
        var str=["쫄딱 젖을 수도 있으니까 우산 꼭 챙기세요!","강우가 있습니다! 길이 미끄러울 수 있으니 조심하세요","우산 꼭 챙기시고 옷이 젖지 않게 조심하세요!"];  
        ment.innerHTML=str[index];                   
    }     
    else if( weather==600 || weather==601 || weather==602 || weather==620 ||   
            weather==621 || weather==622 ||  weather == 511)  
    {      
        var str=["눈이 오네요! 따뜻하게 입으세요!","운전 시 길이 미끄러울 수 있습니다! 안전 운전 하세요!","눈이 쌓일 지도 몰라요! 오늘은 밖에서 즐거운 시간을 보내보는 건 어떨까요?"];  
        ment.innerHTML=str[index];                      
    }         
    else if(weather > 600 && weather < 700)  
    {  
        var str=["눈인 듯 비인 듯 애매하네요.... 일단 우산은 챙깁시다!","비와 눈이 같이 옵니다. 적절히 대비하세요!","비를 동반한 눈이니 우산 꼭 챙기세요!"];  
        ment.innerHTML=str[index];  
    }     
    else if( weather==200 || weather==201 || weather==202 || weather==230 ||   
            weather==231 || weather==232)  
    {     
        var str=["무서운 천둥번개가 칠 예정입니다. 안전사고에 유의하세요!","천둥번개가 칩니다 가급적 외출은 삼가주세요!","날씨가 좋지 못합니다. 외출 시 주의하세요!"];  
        ment.innerHTML=str[index];  
    }   
    else if(weather>200 && weather < 300)  
    {      
        var str=["무서운 천둥번개가 칠 예정입니다. 안전사고에 유의하세요!","천둥번개가 칩니다 가급적 외출은 삼가주세요!","날씨가 좋지 못합니다. 외출 시 주의하세요!"];  
        ment.innerHTML=str[index];                          
    }  
    else  
    {  
        var str=["안개가 짙어요! 운전할 때 꼭 조심하세요!","안개 때문에 시야가 좋지 못합니다! 안전 사고에 유의하세요!","안개는 교통 사고의 원인이 됩니다! 조심하세요!"];  
        ment.innerHTML=str[index];  
    }  
}