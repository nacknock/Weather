<?php

date_default_timezone_set('Asia/Seoul');//시간 기준 한국/서울로 바꾸기@@js보다 php가 훨씬 간결해서 php로 구함,js로 구해도 상관없음

$today = date("Ymd"); //날짜 yyyymmdd

$oneHourAgo = date("H", strtotime("-1 hour")) . '00'; //24시간 기준 현재 시간 -1시간 hh

$now_time = date("H") . '00'; //24시간 기준 현재 시간 hh

?>

<!doctype html>
<html lang="ko"> 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>

    <!-- 지도에 띄울 Overlay style -->
    <style>
        .overlay {
        background-color: #4285F4;
        border-radius: 8px;
        color: #FFFFFF;
        font-size: 14px;
        padding: 10px 15px;
        position: relative;
        }

        .overlay::after {
        content: "";
        position: absolute;
        left: 50%;
        top: 100%;
        transform: translate(-50%, 0);
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #4285F4;
        }
    </style>

</head>

<body>
    <!-- 지도를 띄울 div -->
    <div id = "map" style="width:500px;height: 500px;"></div>
<?php
//var_dump($response);
?>
    

</body>
<!-- jquery 3.5.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- 비동기 통신을 위한 jquery -->

<!-- kakao map -->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=Your Key"></script>

<script>
//지도 생성 start//
const container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
let options = { //지도를 생성할 때 필요한 기본 옵션
	center: new kakao.maps.LatLng(36.347119, 127.386566), //지도의 중심좌표.
	level: 13 //지도의 레벨(처음 로드했을때의 확대, 축소 정도)
};
let map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
//지도 생성 end//

// 오버레이를 띄우는 function
function Overlayset(city_name,pty,t1h,map_x,map_y){

// 커스텀 오버레이가 표시될 위치입니다 
const position = new kakao.maps.LatLng(map_x, map_y);  

// 커스텀 오버레이로 쓸 div 생성
const content = document.createElement("div");

content.className = "overlay"; // 생성된 div 클래스 추가
content.innerHTML = city_name + "<br>" + pty + "<br>" + t1h; //생성된 div에 도시명,날씨,기온 입력

// 커스텀 오버레이를 생성합니다
const customOverlay = new kakao.maps.CustomOverlay({
    position: position,
    content: content,
    xAnchor: 0.3,
    yAnchor: 0.91
});

// 커스텀 오버레이를 지도에 표시합니다
customOverlay.setMap(map);

}
//기상을 받아올 도시들의 정보가 들어간 배열(도시명,지도상 좌표xy,기상청 좌표xy)
let cities_xy = [
    {
        name: '서울',
        map_x: 37.5635694,
        map_y: 126.9800083,
        wth_x: 60,
        wth_y: 127
    }
    ,
    {
        name: '부산',
        map_x: 35.1770194,
        map_y: 129.0769527,
        wth_x: 98,
        wth_y: 76
    },
    {
        name: '인천',
        map_x: 37.4532333,
        map_y: 126.7073527,
        wth_x: 55,
        wth_y: 124
    }
    ,
    {
        name: '대구',
        map_x: 35.8685416,
        map_y: 128.6035527,
        wth_x: 89,
        wth_y: 90
    }
    ,
    {
        name: '대전',
        map_x: 36.8798175,
        map_y: 126.9940486,
        wth_x: 67,
        wth_y: 100
    },
    {
        name: '광주',
        map_x: 35.1569749,
        map_y: 126.8533638,
        wth_x: 58,
        wth_y: 74
    },
    {
        name: '울산',
        map_x: 35.5354083,
        map_y: 129.3136888,
        wth_x: 102,
        wth_y: 84
    },
    {
        name: '수원',
        map_x: 37.3010111,
        map_y: 127.0122222,
        wth_x: 60,
        wth_y: 121
    },
    {
        name: '춘천',
        map_x: 37.8785416,
        map_y: 127.7323111,
        wth_x: 73,
        wth_y: 134
    },
    {
        name: '강릉',
        map_x: 37.7491361,
        map_y: 128.8784972,
        wth_x: 92,
        wth_y: 131
    },
    {
        name: '울릉/독도',
        map_x: 37.480575,
        map_y: 130.9037888,
        wth_x: 127,
        wth_y: 127
    },
    {
        name: '청주',
        map_x: 36.5839972,
        map_y: 127.5117305,
        wth_x: 69,
        wth_y: 106
    },
    {
        name: '안동',
        map_x: 36.5654638,
        map_y: 128.7316222,
        wth_x: 91,
        wth_y: 106
    },
    {
        name: '전주',
        map_x: 35.8091888,
        map_y: 127.1219194,
        wth_x: 63,
        wth_y: 89
    },
    {
        name: '포항',
        map_x: 36.0056861,
        map_y: 129.3616666,
        wth_x: 102,
        wth_y: 94
    },
    {
        name: '목포',
        map_x: 34.8087888,
        map_y: 126.3944194,
        wth_x: 50,
        wth_y: 67
    },
    {
        name: '여수',
        map_x: 34.7573111,
        map_y: 127.6643861,
        wth_x: 73,
        wth_y: 66
    },
    {
        name: '제주',
        map_x: 33.4856944,
        map_y: 126.5003333,
        wth_x: 52,
        wth_y: 38
    }
];

//아래 foreach문 안에서 각 항목 별로 구분해서 담아두기 위한 배열들

let pty = []; //날씨

let t1h = []; //기온

let city_name = []; //도시명

let map_x = []; //지도 x값

let map_y = []; //지도 y값

cities_xy.forEach(function(city) { //각 도시의 기상을 받아와서 지도에 오버레이를 추가

var xhr = new XMLHttpRequest();//기상청 xy값 및 현재 시각을 api에 전송, xhr로 결과 받아옴
var url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getUltraSrtNcst'; /*URL*/
var queryParams = '?' + encodeURIComponent('serviceKey') + '='+'Your Service Key'; /*Service Key*/
queryParams += '&' + encodeURIComponent('pageNo') + '=' + encodeURIComponent('1'); /*페이지 넘버*/
queryParams += '&' + encodeURIComponent('numOfRows') + '=' + encodeURIComponent('8'); /*페이지 내 8줄까지의 내용*/
queryParams += '&' + encodeURIComponent('dataType') + '=' + encodeURIComponent('JSON'); /*받아올 결과값 타입(JSON,XML)*/
queryParams += '&' + encodeURIComponent('base_date') + '=' + encodeURIComponent(<?= $today ?>); /*yyyymmdd 형식의 날짜*/
queryParams += '&' + encodeURIComponent('base_time') + '=' + encodeURIComponent(<?= $oneHourAgo ?>); /*hhmm 형식의 시간*/
queryParams += '&' + encodeURIComponent('nx') + '=' + encodeURIComponent(city.wth_x); /*/*기상청 고유 위치좌표 x값,기상청 api 참고문서 내 도시별 값 존재*/*/
queryParams += '&' + encodeURIComponent('ny') + '=' + encodeURIComponent(city.wth_y); /*/*기상청 고유 위치좌표 y값,기상청 api 참고문서 내 도시별 값 존재*/*/

//xhr 통신
xhr.open('GET', url + queryParams);
xhr.onreadystatechange = function () {
    if (this.readyState == 4) { //통신 성공시
        const response = JSON.parse(this.responseText);
        const wth_arr = response.response.body.items.item; //responseText 객체에서 item 배열을 추출

        wth_arr.forEach(function(item) { //wth_arr배열

            // T1H, PTY의 obsrValue만 추출하여 출력
            if (item['category'] == 'T1H' || item['category'] == 'PTY') {
                    if(item.category == 'PTY'){
                        if(item.obsrValue == '0'){
                            pty.push("맑음");
                        }
                        else if(item.obsrValue == '1'){
                            pty.push("비");
                        }
                        else if(item.obsrValue == '2'){
                            pty.push("비/눈");
                        }
                        else if(item.obsrValue == '3'){
                            pty.push("눈");
                        }
                        else if(item.obsrValue == '5'){
                            pty.push("빗방울");
                        }
                        else if(item.obsrValue == '6'){
                            pty.push("빗방울눈날림");
                        }
                        else if(item.obsrValue == '7'){
                            pty.push("눈날림");
                        }
                    }
                    //기온 및 나머지 값들
                    else if(item.category == 'T1H'){
                        t1h.push(item.obsrValue + "℃");

                        city_name.push(city.name);

                        map_x.push(city.map_x);

                        map_y.push(city.map_y);
                    }
              
            }

            for(let num in city_name){ //배열 length만큼 Overlayset function 반복
            Overlayset(city_name[num],pty[num],t1h[num],map_x[num],map_y[num]);
            };
    });
    }
};
//xhr 실행
xhr.send('');


});
</script>
</html>