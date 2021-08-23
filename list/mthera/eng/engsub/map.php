<? include "../inc/header.php"; ?>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=5hezsut7su"></script>
<body>
    <? include "../inc/gnb.php"; ?>
    <section class="map">
        <div class="map_ban">
            <h1>Contact Us</h1>
        </div>
        <div class="map_ct">
            <div class="map_top">
                <div class="map_tw">
                    <div class="map_tl">
                        <span class="tl_img"><img src="/img/main/mp_circle.png" alt=""></span>
                        <span class="tl_t">Contact Us</span>
                    </div>
                    <div class="map_tr">
                        <span>HOME</span>&nbsp;<span>></span>&nbsp;
                        <span>Contact Us</span>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="map_c">
            <div id="map" style="width:100%;height:600px;"></div>

            <script>
               var CustomOverlay = function(options) {
                        this._element = $('<div style="position:absolute;left:0px;top:10px;width:174px;height:80px;background-color:#fff;text-align:center;transform:translateX(-50%); -webkit-transform:translateX(-50%); margin-top:-130px;">' +
                                            '<img src="../../img/sub/ci1.jpg" style="border:3px solid #cacaca; width:150px; padding:10px;">' +
                                           
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
                    <li><span class="green">·Address</span>#102, 38, Magokjungang 8-ro 1-gil, Gangseo-gu, Seoul 07793, Rep.of Korea</li>
                    <li><span class="green">·Contacts</span>+82-2-6238-1234</li>
                </ul>
            </div>
            <div class="map_tw map_tw2">
                <div class="map_tl">
                    <span class="tl_img"><img src="/img/main/mp_circle.png" alt=""></span>
                    <span class="tl_t">Get Directions</span>
                </div>
            </div>
            <div class="map_way">
                <table>
                    <tr>
                        <td rospan="3">Subway</td>
                        <td>
                            <p>Seoul Metro Line 9, Yangcheon Hyanggyo Station.<br /><span>(Exit 8.)</span></p>
                        </td>
                        <td>
                         <p>Go straight 131m and turn Right<br />Go straight 574m</p>
                        </td>
                    </tr>
                    <tr>
                       <td></td>
                        <td>
                            <p>Seoul Metro Line 5, Balsan Station.<br /><span>(Exit 9.)</span></p>
                        </td>
                        <td>
                            <p>Go straight 150m and turn Left<br />Go straight 630m</p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p>Airport Railroad / <br />Seoul Metro Line 9, Magongnaru Station.<br /><span>(Exit 4.)</span></p>
                        </td>
                        <td>
                            <p>
                            	Go straight 56m and turn Left <br />Go straight 746m and turn Left<br />Go straight 79m
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