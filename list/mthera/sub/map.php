<? include "../inc/header.php"; ?>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=5hezsut7su"></script>
<body>
    <? include "../inc/gnb.php"; ?>
    <section class="map">
        <div class="map_ban">
            <h1>오시는길</h1>
        </div>
        <div class="map_ct">
            <div class="map_top">
                <div class="map_tw">
                    <div class="map_tl">
                        <span class="tl_img"><img src="/img/main/mp_circle.png" alt=""></span>
                        <span class="tl_t">오시는 길</span>
                    </div>
                    <div class="map_tr">
                        <span>HOME</span>&nbsp;<span>></span>&nbsp;
                        <span>오시는 길</span>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="map_c">
            <div id="map" style="width:100%;height:600px;"></div>

            <script>
               var CustomOverlay = function(options) {
                        this._element = $('<div style="position:absolute;left:0px;top:10px;width:174px;height:80px;background-color:#fff;text-align:center;transform:translateX(-50%); -webkit-transform:translateX(-50%); margin-top:-130px;">' +
                                            '<img src="../img/common/logo_c.png" style="border:3px solid #cacaca; width:150px; padding:10px;">' +
                                           
                                            '</div>')

                        this.setPosition(options.position);
                        this.setMap(options.map || null);
                    };

                    CustomOverlay.prototype = new naver.maps.OverlayView();
                    CustomOverlay.prototype.constructor = CustomOverlay;

                    CustomOverlay.prototype.setPosition = function(position) {
                        this._position = position;
                        this.draw();
                    };

                    CustomOverlay.prototype.getPosition = function() {
                        return this._position;
                    };

                    CustomOverlay.prototype.onAdd = function() {
                        var overlayLayer = this.getPanes().overlayLayer;

                        this._element.appendTo(overlayLayer);
                    };

                    CustomOverlay.prototype.draw = function() {
                        if (!this.getMap()) {
                            return;
                        }

                        var projection = this.getProjection(),
                            position = this.getPosition(),
                            pixelPosition = projection.fromCoordToOffset(position);

                        this._element.css('left', pixelPosition.x);
                        this._element.css('top', pixelPosition.y);
                    };

                    CustomOverlay.prototype.onRemove = function() {
                        var overlayLayer = this.getPanes().overlayLayer;

                        this._element.remove();
                        this._element.off();
                    };

                    var position = new naver.maps.LatLng(37.56453250389024,  126.8364956301113);
                    var map = new naver.maps.Map("map", {
                        center: position,
                        zoom: 15
                    });
                    var overlay = new CustomOverlay({
                        map: map,
                        position: position
                    });

                        overlay.setMap(map);


                var marker = new naver.maps.Marker({
                    position: new naver.maps.LatLng(37.56453250389024,  126.8364956301113),
                    map: map
                });
                
                

                var contentString = [
                    '<div class="iw_inner">',
                    '   <p style="padding:5px;">엠테라파마',
                    '   </p>',
                    '</div>'
                ].join('');

                var infowindow = new naver.maps.InfoWindow({
                    content: contentString
                });

                naver.maps.Event.addListener(marker, "click", function(e) {
                    if (infowindow.getMap()) {
                        infowindow.open();
                    } else {
                        infowindow.open(map, marker);
                    }
                });
                
//                infowindow.open(map, marker);
                var map = new naver.maps.Map('map', mapOptions);
            </script>
        
            <div class="map_info">
                <ul>
                    <li><span class="green">·연구소</span>서울특별시 강서구 마곡중앙 8로 1길 38, 1층 102호 (마곡동 787-2)</li>
                    <li><span class="green">·연락처</span>+82-2-6238-1234</li>
                </ul>
            </div>
            <div class="map_tw map_tw2">
                <div class="map_tl">
                    <span class="tl_img"><img src="/img/main/mp_circle.png" alt=""></span>
                    <span class="tl_t">찾아오는 방법</span>
                </div>
            </div>
            <div class="map_way">
                <table>
                    <tr>
                        <td rospan="3">대중교통<br />이용시</td>
                        <td>
                            <p>9호선 양천향교역<br /><span>(총 도보 12분 소요)</span></p>
                        </td>
                        <td>
                         <p>8번출구로 나와 150m 직진 후 좌회전 → 630m 직진<br />→ 엠테라파마 (서울 강서구 마곡중앙8로1길 38, 102호) 도착</p>
                        </td>
                    </tr>
                    <tr>
                       <td></td>
                        <td>
                            <p>5호선 발산역<br /><span>(총 도보 11분 소요)</span></p>
                        </td>
                        <td>
                            <p>9번출구로 나와 131m 직진 후 우회전 → 574 m 직진<br />→ 엠테라파마 (서울 강서구 마곡중앙8로1길 38, 102호) 도착
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p>공항철도/<br />9호선 양천향교역<br /><span>(총 도보 14분 소요)</span></p>
                        </td>
                        <td>
                            <p>
                                4번출구로 나와 56 m 직진 후 좌회전 → 746 m 직진(한보이엔씨 R&D 센터앞) 후 좌회전 <br />→ 79 m 직진 → 엠테라파마 (서울 강서구 마곡중앙8로1길 38, 102호) 도착
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
   <? include "../inc/footer.php"; ?>
</body>
</html>