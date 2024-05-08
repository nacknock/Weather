<?php
//기상을 받아올 도시들의 정보가 들어간 배열(도시명,지도상 좌표xy,기상청 좌표xy)
$cities_xy = [
    [
        'name' => '서울',
        'map_x' => 37.5635694,
        'map_y' => 126.9800083,
        'wth_x' => 60,
        'wth_y' => 127
    ]
    ,
    [
        'name' => '부산',
        'map_x' => 35.1770194,
        'map_y' => 129.0769527,
        'wth_x' => 98,
        'wth_y' => 76
    ],
    [
        'name' => '인천',
        'map_x' => 37.4532333,
        'map_y' => 126.7073527,
        'wth_x' => 55,
        'wth_y' => 124
    ]
    ,
    [
        'name' => '대구',
        'map_x' => 35.8685416,
        'map_y' => 128.6035527,
        'wth_x' => 89,
        'wth_y' => 90
    ]
    ,
    [
        'name' => '대전',
        'map_x' => 36.8798175,
        'map_y' => 126.9940486,
        'wth_x' => 67,
        'wth_y' => 100
    ],
    [
        'name' => '광주',
        'map_x' => 35.1569749,
        'map_y' => 126.8533638,
        'wth_x' => 58,
        'wth_y' => 74
    ],
    [
        'name' => '울산',
        'map_x' => 35.5354083,
        'map_y' => 129.3136888,
        'wth_x' => 102,
        'wth_y' => 84
    ],
    [
        'name' => '수원',
        'map_x' => 37.3010111,
        'map_y' => 127.0122222,
        'wth_x' => 60,
        'wth_y' => 121
    ],
    [
        'name' => '춘천',
        'map_x' => 37.8785416,
        'map_y' => 127.7323111,
        'wth_x' => 73,
        'wth_y' => 134
    ],
    [
        'name' => '강릉',
        'map_x' => 37.7491361,
        'map_y' => 128.8784972,
        'wth_x' => 92,
        'wth_y' => 131
    ],
    [
        'name' => '울릉/독도',
        'map_x' => 37.480575,
        'map_y' => 130.9037888,
        'wth_x' => 127,
        'wth_y' => 127
    ],
    [
        'name' => '청주',
        'map_x' => 36.5839972,
        'map_y' => 127.5117305,
        'wth_x' => 69,
        'wth_y' => 106
    ],
    [
        'name' => '안동',
        'map_x' => 36.5654638,
        'map_y' => 128.7316222,
        'wth_x' => 91,
        'wth_y' => 106
    ],
    [
        'name' => '전주',
        'map_x' => 35.8091888,
        'map_y' => 127.1219194,
        'wth_x' => 63,
        'wth_y' => 89
    ],
    [
        'name' => '포항',
        'map_x' => 36.0056861,
        'map_y' => 129.3616666,
        'wth_x' => 102,
        'wth_y' => 94
    ],
    [
        'name' => '목포',
        'map_x' => 34.8087888,
        'map_y' => 126.3944194,
        'wth_x' => 50,
        'wth_y' => 67
    ],
    [
        'name' => '여수',
        'map_x' => 34.7573111,
        'map_y' => 127.6643861,
        'wth_x' => 73,
        'wth_y' => 66
    ],
    [
        'name' => '제주',
        'map_x' => 33.4856944,
        'map_y' => 126.5003333,
        'wth_x' => 52,
        'wth_y' => 38
    ]
];

date_default_timezone_set('Asia/Seoul'); //시간 기준 한국/서울로 바꾸기@@js보다 php가 훨씬 간결해서 php로 구함,js로 구해도 상관없음

$today = date("Ymd"); //날짜 yyyymmdd

$oneHourAgo = date("H", strtotime("-1 hour")) . '00'; //24시간 기준 현재 시간 -1시간 hh

$now_time = date("H") . '00'; //24시간 기준 현재 시간 hh

//아래 foreach문 안에서 각 항목 별로 구분해서 담아두기 위한 배열들

$city_name = []; //도시명

$map_x = []; //지도 x값

$map_y = []; //지도 y값

$T1H_arr = []; //기온

$SKY_arr = []; //날씨

//순서대로 기상을 받아와서 날씨와 기온만 배열에 담기
foreach($cities_xy as $city){
    //기상청 api에 요청 보내기(기상청 php 예시 코드 참고)
    $ch = curl_init();
    $url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getUltraSrtFcst'; /*URL*/
    $queryParams = '?' . urlencode('serviceKey') . '=' . 'Your Service Key'; /*Service Key*/
    $queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*페이지 넘버*/
    $queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('1000'); /*1페이지 내 1000줄까지의 내용*/
    $queryParams .= '&' . urlencode('dataType') . '=' . urlencode('JSON'); /*받아올 결과값 타입(JSON,XML)*/
    $queryParams .= '&' . urlencode('base_date') . '=' . urlencode($today); /*yyyymmdd 형식의 날짜*/
    $queryParams .= '&' . urlencode('base_time') . '=' . urlencode($oneHourAgo); /*hhmm 형식의 시간*/
    $queryParams .= '&' . urlencode('nx') . '=' . urlencode($city['wth_x']); /*기상청 고유 위치좌표 x값,기상청 api 참고문서 내 도시별 값 존재*/
    $queryParams .= '&' . urlencode('ny') . '=' . urlencode($city['wth_y']); /*기상청 고유 위치좌표 y값,기상청 api 참고문서 내 도시별 값 존재*/

    curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $response = curl_exec($ch);
    curl_close($ch);

    // JSON 데이터를 배열로 변환
    $WeatherArray = json_decode($response, true);

    // 'item' 배열 추출
    $items = $WeatherArray['response']['body']['items']['item'];

    // SKY와 T1H, PTY의 fcstValue만 추출하여 출력
    foreach ($items as $item) {
            if ($item['category'] == 'SKY' || $item['category'] == 'T1H' || $item['category'] == 'PTY') {
                if($item['fcstTime'] == $now_time){
                    if($item['category'] == 'PTY'){
                        if($item['fcstValue'] == '0'){ //강수 형태 없을때
                            foreach ($items as $item) {
                                if($item['category'] == 'SKY'){
                                    if($item['fcstTime'] == $now_time){
                                        if($item['fcstValue'] == '1'){
                                            $SKY_arr[] = "맑음";
                                        }
                                        if($item['fcstValue'] == '3'){
                                            $SKY_arr[] = "구름 많음";
                                        }
                                        if($item['fcstValue'] == '4'){
                                            $SKY_arr[] = "흐림";
                                        }
                                    }
                                }
                            }
                        } //강수 형태 있을때
                        else if($item['fcstValue'] == '1'){
                            $SKY_arr[] = "비";
                        }
                        else if($item['fcstValue'] == '2'){
                            $SKY_arr[] = "비/눈";
                        }
                        else if($item['fcstValue'] == '3'){
                            $SKY_arr[] = "눈";
                        }
                        else if($item['fcstValue'] == '5'){
                            $SKY_arr[] = "빗방울";
                        }
                        else if($item['fcstValue'] == '6'){
                            $SKY_arr[] = "빗방울눈날림";
                        }
                        else if($item['fcstValue'] == '7'){
                            $SKY_arr[] = "눈날림";
                        }
                    }
                    //기온 및 나머지 값들
                    else if($item['category'] == 'T1H'){
                        $T1H_arr[] = $item['fcstValue'] . "℃";

                        $city_name[] = $city['name'];

                        $map_x[] = $city['map_x'];

                        $map_y[] = $city['map_y'];
                    }
                    
                }
            }

    }
}
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
<!-- kakao map api -->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=86f8c996f9887b63b12aa0ccb7f36158"></script>


<script>
//지도 생성 start//
const container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
let options = { //지도를 생성할 때 필요한 기본 옵션
	center: new kakao.maps.LatLng(36.347119, 127.386566), //지도의 중심좌표.
	level: 13 //지도의 레벨(처음 로드했을때의 확대, 축소 정도)
};
let map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
//지도 생성 end//

//지도 Overlay 생성 function 도시 수만큼 순서대로 반복실행
<?php
for($i = 0;$i<=count($city_name)-1;$i++){

    echo 'Overlayset("' . $city_name[$i] . '","' . $SKY_arr[$i] . '","' . $T1H_arr[$i] . '",' . $map_x[$i] . ',' . $map_y[$i] . ');';

}
?>

//지도 Overlay 생성 function
function Overlayset(city_name,sky,t1h,map_x,map_y){

const position = new kakao.maps.LatLng(map_x, map_y);  // 커스텀 오버레이가 표시될 위치입니다 

const content = document.createElement("div"); // 커스텀 오버레이로 쓸 div 생성

content.className = "overlay"; // 생성된 div 클래스 추가
content.innerHTML = city_name + "<br>" + sky + "<br>" + t1h; //생성된 div에 도시명,날씨,기온 입력

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
</script>
</html>