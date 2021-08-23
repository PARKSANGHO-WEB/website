<? include "../include/header_sub.php"?>
 <link rel="stylesheet" href="../css/board_FAQ2.css">
    <!--    상단 탭메뉴 사이즈 변형-->
    <style>
        section .about-cont .about-flat {
            width: 512px;
        }

        section .about-cont .about-flat ul li {
            width: 256px;
        }

        /*        상단 배너 배경이미지 변경*/
        section.about-busy .sub-banner {
            background: url('../img/sub/faq-ban.jpg');
            height: 200px;
        }
    </style>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
<body>
   <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 

    <section class="about-busy">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="#">Board</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="board_FAQ2.php">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                     <span class="ban-title">FAQ</span>
                    <span class="ban-text">We highly appreciate your time to share your <strong> questions and suggestions</strong></span>
                </div>
            </div>
        </div>
        <div class="about-cont">
            <div class="about-flat">
                <ul>
                    <li class="active">
                        <a href="board_FAQ2.php">FAQ</a>
                    </li>
                    <li>
                        <a href="board_FAQ_input.php">Inquiry / Order / Suggestion</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div id="board_faq">
        <!--           검색창 시작-->
<!--
        <section class="search_box">
            <form action="#">
                <fieldset class="cf">
                    <legend>검색창</legend>
                    <input type="search" placeholder="search" required="required" autofocus="autofocus" class="search">
                    <div class="search_btn">
                        <a href="#"><img src="../img/sub/gotosurvey_icon1.png" alt="search"></a>
                    </div>
                </fieldset>
            </form>
        </section>
-->
        <!--           검색창 끝-->

    <!--           탭메뉴 시작-->
        <div class="fac3-1">
           <div class="filter-btn">
               <ul id="filterOptions">
                        <li class="active"><a class="all" href="javascript:;">ALL</a></li>
                        <li><a class="member" href="javascript:;" >Membership</a></li>
                        <li><a class="point" href="javascript:;" >K-DOD Point</a></li>
                        <li><a class="survey" href="javascript:;" >Online Survey</a></li>
                        <li><a class="medical" href="javascript:;" >Medical Product</a></li>
                        <li><a class="public" href="javascript:;" >Public Product</a></li>
                        <li><a class="p-mall" href="javascript:;" >Point Mall</a></li>
                        <li><a class="playground" href="javascript:;" >K-DOD Playground</a></li>
                        <li><a class="any" href="javascript:;" >Others</a></li>
                 </ul>
            </div>
            <div id="ourHolder" class="all">
                <!--		2-1.MENU1 콘텐츠 시작-->
                <div class="box member">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Shall I need a membership to use K-DOD services or products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                 You can use most of K-DOD services or products without registration. However, to participate in an online survey, receive K-DOD points and to use some membership only boards such as a playground, you will be required to log in with your K-DOD ID.
                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-1.MENU1 콘텐츠 끝-->
                <!--		2-2.MENU2 콘텐츠 시작-->
                <div class="box member item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How can I get a membership?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                You can register using your Facebook ID or register by filling the registration form.
                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-2.MENU2 콘텐츠 끝-->
                <!--		2-3.MENU3 콘텐츠 시작-->
                <div class="box member item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2> Shall I need a membership to use K-DOD services or products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                            You can use most of K-DOD services or products without registration. However, to participate in an online
                            survey, receive K-DOD points and to use some membership only boards such as a playground, you will be
                            required to log in with your K-DOD ID.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box member item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How can I get a membership?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                              You can register using your Facebook ID or register by filling the registration form.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box member item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How can I find my password, if I forget?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                K-DOD does not have your password information. You have to set-up a new password. 
                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-6.MENU5 콘텐츠 시작-->
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How much value is ONE K-DOD point?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                ONE Point is equivalent to [1 Myanmar Kyat] or [3 Cambodia Riel]<br />1,000 point = 1,000 MMK<br />1,000 point = 3,000 KHR


                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-6.MENU5 콘텐츠 시작-->
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Where can I use the points?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                You can use K-DOD points only in Myanmar or Cambodia and use the points for buying K-DOD public products, including K-DOD point mall items

                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-7.MENU5 콘텐츠 시작-->
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How can I get K-DOD points?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                You can get K-DOD points by (1) membership registration and (2) participating in ONLINE SURVEY or (3) EVENTs.
                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-7.MENU5 콘텐츠 끝-->
                <!--		2-8.MENU5 콘텐츠 시작-->
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Is it Refundable?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                NO. K-DOD points cannot be refunded or converted into Cash.
                            </p>
                        </div>
                    </div>
                </div>
                <!--		2-8.MENU5 콘텐츠 끝-->
                <!--		2-9.MENU5 콘텐츠 시작-->
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Is it Transferable to others?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                NO. K-DOD points cannot be transferred to other people.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Is it Combinable?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                NO. K-DOD points cannot be combined with other people’s points.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Is it Adjustable?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                YES. If there is a significant exchange rate change or inflation, K-DOD points can be adjusted.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box point item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Will it disappear, if I do not use it? </h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                YES. All K-DOD points are valid for 24 months. Your old points which are not used for 24 months will  disappear.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Who can be an ONLINE PANEL?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Anybody in Myanmar and Cambodia can be a K-DOD ONLINE PANEL.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How much does the online survey cost, if we request a project?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Online survey cost is less expensive than any other research methodology as we do not require human interviewers. The cost differs by survey target group, target number, length of questionnaire, final outcome (data table only or including report), etc. Please contact us through the1:1 inquiry page.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How long does it take to conduct an online survey?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                It differs by survey. However, generally it requires shorter time than any other research methodology without compromising quality.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can we limit our survey to specific targets?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Yes. As we have panel data, we can target only specific groups.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can we conduct surveys only in Myanmar? (or only in Cambodia?)</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Yes. We can limit the country or region.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box survey item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can we conduct surveys in other countries?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Currently, we are developing online panels in Myanmar and Cambodia only.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box medical item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can anybody purchase medical products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                               NO. Only registered doctors or clinics/hospitals can purchase medical products.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box medical item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>How can I purchase or order medical products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
								You can contact Myanmar or Cambodia offices. <br />   K-DOD Myanmar Co.,LTD : T. +95-1546091     E. <span class="underline">Myanmar@K-dod.com</span><br />
								K-DOD (Cambodia) Co.,LTD : T. +855-15-922-009     E. <span class="underline">Cambodia@K-dod.com</span>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="box medical item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can you provide after service for purchased medical products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                YES. If you purchase the product from K-DOD, we will provide after services. K-DOD deals premium medical products which are all from Korea and K-DOD has exclusive sales rights for the products in Myanmar and Cambodia.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="box medical item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can I have a partnership to distribute K-DOD medical products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                YES. If you have customers who are interested in our medical products in Myanmar or Cambodia, you can make a partnership with us. Please contact us via 1:1 inquiry page.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box public item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Shall I need a membership to purchase K-DOD products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                NO. You don’t need a K-DOD membership to purchase our product. However, if you have a membership, you will receive K-DOD points which you can utilize for product purchase or discount. 

                            </p>
                        </div>
                    </div>
                </div>
                <div class="box public item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Where can I purchase or order K-DOD products?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Apart from medical products, you can order any public products from our website or K-DOD facebook page. <br>or you can contact K-DOD Myanmar or Cambodia office. <br />
								   K-DOD Myanmar Co.,LTD : T. +95-1546091     E. <span class="underline">Myanmar@K-dod.com</span>
								    <br />K-DOD (Cambodia) Co.,LTD : T. +855-15-922-009     E.  <span class="underline">Cambodia@K-dod.com</span>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="box p-mall item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>There are not many items that I am interested in the point mall. Should I use my K-DOD points only in the point mall?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                We try to bring more various products into point mall. However, it takes time to import the products as
                                all products are made in and delivered from Korea. If you have any items to suggest to bring in, please
                                suggest us. Also you can use your points for other public products, such as homecare or cosmetics. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box p-mall item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>I am not a K-DOD member and/or I do not have K-DOD points, can I purchase point mall items?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                               Yes. You can order any public products from our website or K-DOD facebook page. Or you can contact KDOD Myanmar or Cambodia office.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box playground item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Is it confidential if I post any image, photo, video or writing on K-DOD playground?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                No. The playground is for sharing our thoughts, images or behaviors with others. There is no intention to keep confidential for your uploads.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box playground item">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Do you provide any points or giveaway, if I post anything on K-DOD playground?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Basically we do not provide any point for this. However, if there are any specific events, occasionally we can provide some giveaway for this.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box playground">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>Can I post anything on the playground?</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                Basically, we do not limit any posting on this playground. However, if the contents contain any significant harm to others, we can prohibit. For more details, please visit the page – <a href="./play-list.php">Playground.</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box any">
                    <div class="qna">
                       <h1 class="q">Q.</h1>
                        <a href="javascript:;" class="qna_title">
                            <h2>K-DOD is a Korean Company</h2>
                            <img src="../img/icon-red.png" alt="아래화살표">
                        </a>
                        <div class="qna_txt">
                            <h1 class="a">A.</h1>
                            <p>
                                We have set up three corporates in each country – Myanmar, Cambodia and Republic of Korea.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--           탭메뉴 끝-->
        
		<div style="height:20px;"></div>

        <!-- <div class="paging">
            <span class="paging-wrap">
                <a href="javascript:;">
                    <img class="two" src="../img/b-all.png" alt="">
                </a>
                <a href="javascript:;">
                    <img class="one" src="../img/b-al.png" alt="">
                </a>
                <a href="javascript:;" class="active">
                    1
                </a>
                <a href="javascript:;">
                    2
                </a>
                <a href="javascript:;">
                    <img class="one" src="../img/b-ar.png" alt="">
                </a>
                <a href="javascript:;">
                    <img class="two" src="../img/b-arr.png" alt="">
                </a>
            </span>
        </div> -->
    </div>

    <script>
        $(document).ready(function(){           
            
            
            $('.visual-slider').bxSlider({
              auto: true,
              pager: true,
              mode: 'fade',
              hideControlOnEnd:true
            });
            
            $('.cont1-slider').bxSlider({
              auto: true,
              pager: true,
              hideControlOnEnd:true
            });
        });
        
        
        $(document).ready(function(){    
        var tabBtn = $("#tab-btn > ul > li");     //각각의 버튼을 변수에 저장
        var tabCont = $("#tab-cont > div");       //각각의 콘텐츠를 변수에 저장

        //컨텐츠 내용을 숨겨주세요!
        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
          var target = $(this);         //버튼의 타겟(순서)을 변수에 저장
          var index = target.index();   //버튼의 순서를 변수에 저장
          //alert(index);
          tabBtn.removeClass("active");    //버튼의 클래스를 삭제
          target.addClass("active");    //타겟의 클래스를 추가
          tabCont.css("display","none");
          tabCont.eq(index).css("display", "block");
        });
        
        
        });
    </script>
<!--    텍스트 토글효과 js-->
    <script src="../js/board_FAQ.js"></script>
    
            <script>
                $(document).ready(function() {
                  $('#filterOptions li a').click(function() {
                    // fetch the class of the clicked item
                    var ourClass = $(this).attr('class');

                    // reset the active class on all the buttons
                    $('#filterOptions li').removeClass('active');
                    // update the active state on our clicked button
                    $(this).parent().addClass('active');

                    if(ourClass == 'all') {
                      // show all our items
                      $('#ourHolder').find('.box.item').show();
                    }
                    else {
                      // hide all elements that don't share ourClass
                      $('#ourHolder').find('.box:not(.' + ourClass + ')').hide();
                      // show all elements that do share ourClass
                      $('#ourHolder').find('.box.' + ourClass).show();
                    }
                    return false;
                  });
                });
            </script>

<? include "../include/footer_sub.php"?>
