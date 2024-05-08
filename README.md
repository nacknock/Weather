# 기상청 api를 통해 지도에 날씨 띄우기
기상청 단기예보 중 초단기 실황 조회를 통해 kakao map, google map에 overlay로 날씨 띄우기 

# 사용 기술 스택 및 API

### 기술 스택

* PHP 7.4.10

* Apache-tomcat-9.0.80

* HTML5

* CSS

* JavaScript


### API

* Maps JavaScript API(Google)

* Kakao 지도 Javscript API

* 기상청_단기예보 ((구)_동네예보) 조회서비스 오픈API

# 파일목록 및 간단설명

### 공통사항

* 기상청 API에서 가져오는 값의 타입은 XML,JSON 중 JSON으로 가져오고 있음

### map_google.php(미완)

* 기상청 단기예보 중 초단기예보 사용

* php로 기상청 API 이용

* 지도에 띄울 Overlay 수정중

* 사이트를 불러올 때 로딩 시간이 김

### map_php_kakao.php

* 기상청 단기예보 중 초단기예보 사용

* php로 기상청 API 이용

* 사이트를 불러올 때 로딩 시간이 김

### map_js_kakao.php

* 기상청 단기예보 중 초단기실황 사용

* js로 기상청 API 이용

* 사이트를 불러올 때 로딩시간 정상적

* 기상청 api 비동기 관련 코드는 기상청 예시 코드대로 xhr 사용중

# Screenshot

![map-kakao](https://github.com/nacknock/Weather/assets/151377332/cebb36a7-076f-44cb-863a-50e7ec94ab94)

# 참조 사이트

* https://www.data.go.kr/data/15084084/openapi.do#/tab_layer_detail_function

* https://apis.map.kakao.com/web/guide/

* https://apis.map.kakao.com/web/sample/multipleMarkerImage/

* https://apis.map.kakao.com/web/sample/customOverlay2/

* https://developers.google.com/maps/documentation/javascript/overview?hl=ko
