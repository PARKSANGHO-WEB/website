 <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom.php";?>
 <div class="ttop_wrap">
<a id="button"><img src="../../img/common/totop.png" alt=""></a>
</div>
<script>
    var btn = $('#button');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });


</script>

 <footer>
       
        <script>jQuery(document).ready(function(){
var btn = $('.totop img');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


});
        </script>
        <div class="foot_wrap">
            <ul>
                <li class="logo">
                    <img src="/img/common/foot_logo.png" alt="">
                </li>
                <li>
                    <span class="f-title">Contacts</span>
                    <p>
                        <span>T.</span>+82-2-6238-1234
                    </p>
                    <p>
                        <span>F.</span>+82-2-6238-1238
                    </p>
                </li>
                <li>
                    <span class="f-title">Address</span>
                    <p>
                        서울특별시 강서구 마곡중앙8로 1길 38, 102호 (마곡동 787-2)
                    </p>
                    <p>
                        사업자 번호  448-81-01914 <span>ㅣ</span>대표자명 손미원
                    </p>
                    <p>
                        COPYRIGHT 2020 MTHERA PHARMA. ALL RIGHTS RESERVED.
                    </p>
                </li>
            </ul>
        </div>
    </footer>