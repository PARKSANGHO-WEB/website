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
                    <img src="../../img/common/foot_logo.png" alt="">
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
                        #102, 38, Magokjungang 8-ro 1-gil, Gangseo-gu, Seoul, Republic of Korea
                    </p>
                    <p>
                        Company Reg. No. 448-81-01914 <span>ㅣ</span>CEO: Mi Won SOHN
                    </p>
                    <p>
                        COPYRIGHT 2020 MTHERA PHARMA. ALL RIGHTS RESERVED.
                    </p>
                </li>
            </ul>
        </div>
    </footer>