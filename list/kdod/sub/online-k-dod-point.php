<? include "../include/header_sub.php"?>

 <link rel="stylesheet" href="../css/online-k-dod-point.css">
<!--    상단 탭메뉴 사이즈 변형-->
    <style>
        
/*        상단 배너 배경이미지 변경*/
        section.about-busy .sub-banner {
            background: url('../img/sub/survey-ban.png');
        }
        
    </style>
<body>
       <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 

    <section class="about-busy on-survey">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="online-survey.php">Online Survey</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="online-k-dod-point.php">K-DOD Point</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
					<span class="ban-title">BE OUR ONLINE PANEL and PARTICIPATE IN SURVEY</span>
                    <span class="ban-text">We listen to <strong>your voices</strong> on medical, social and industrial issues</span>
                </div>
            </div>
        </div>
        <div class="about-cont">
            <div class="about-flat af-market">
                <ul>
                    <li>
                        <a href="online-market-research-survey.php">MARKET RESEARCH SURVEY</a>
                    </li>
                    <li>
                        <a href="online-survey.php">ONLINE SURVEY</a>
                    </li>
                    <li>
                        <a href="online-panel.php">ONLINE PANEL</a>
                    </li>
                    <li class="active">
                        <a href="online-k-dod-point.php"> K-DOD Point </a>
                    </li>
                    <li>
                        <a href="online-go-to-survey.php">GO TO SURVEY </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div id="k_dod_point">
        <h1>케이닷 포인트란?</h1>
        <section class="k_dod_point cf">
            <article class="k_dod_point_fl">
                <div class="text">
                    <div class="img">
                        <img src="../img/sub/point1.png" alt="배경이미지">
                    </div>
                    <p>
                        케이닷에서는 케이닷 서비스와 제품들을 보다 효율적으로 이용하실 수 있도록 <br>
                        케이닷 포인트를 제공합니다. 포인트란 가상의 수치로서 여러분들의 케이닷 활동을<br>
                        기반으로 계산하여 제공됩니다. (현금으로 변환되지 않습니다). 
                    </p>
                </div>
            </article>
            <article class="k_dod_point_fr">
                <div class="text">
                    <div class="img">
                        <img src="../img/sub/point2.png" alt="배경이미지">
                    </div>
                    <p>
                        케이닷 포인트 외에도, 대부분 한국 프리미엄 제품으로 구성된 다양한 경품들을 <br>
                        제공하고 있습니다.
                    </p>
                </div>
            </article>
        </section>
        <section class="gift">
            <div class="gift_text">
                <h2>포인트와 경품은 어떻게 받을 수 있나요?</h2>
                <p>
                    케이닷 포인트와 경품은<br>
                    (1) 회원 가입과 (2) 케이닷 서베이, 이벤트에 참여하심으로써 받을 수 있습니다.
                </p>
                <div class="icon">
                   	<ul>
                   		<li>
                   			<div>
                   				<span class="git">Welcome</span>
                   				<span class="gic">800 P</span>
                   			</div>
                   		</li>
                   		<li>
							<img src="../img/sub/Icon%20open-plus.png" alt="+">
                   		</li>
                   		<li>
                   			<div>
                   				<span class="git">PANEL PROFILE<br />Points</span>
                   				<span class="gic">200 P</span>
                   			</div>
                   		</li>
                   		<li>
							<img src="../img/sub/Icon%20open-plus.png" alt="+">
                   		</li>
                   		<li>
                   			<div>
                   				<span class="git">Survey/Event<br />Points</span>
                   				<span class="gic">(200~2,000 P<br />by Survey/Event)</span>
                   			</div>
                   		</li>
                   		<li>
							<img src="../img/sub/Icon%20open-plus.png" alt="+">
                   		</li>
                   		<li>
                   			<div>
                   				<span class="git">Survey/Event<br />Giveaways</span>
                   				<span class="gic">(Winners Drawing)</span>
                   			</div>
                   		</li>
					</ul>
                </div>
                <p>
                   회원으로 가입하시면, 그 즉시 1,000 포인트를 받으실 수 있습니다 (회원 가입 800 point + 패널 정보 입력 200 point) 
                </p>
            </div>
        </section>
        
        <section class="point_where">
                <div class="where_text">
                    <h2>포인트는 어디에서 사용할 수 있나요?</h2>
                    <p>
                        케이닷 포인트로 케이닷 일반 제품 (특히 포인트몰 제품들)을 구매하실 수 있습니다. <br>
                        합리적 가격의 프리미엄 한국 제품들이 포인트몰에 꾸준히 업데이트 될 예정입니다. <br>
                        여러분들이 포인트를 사용하실 때마다, 사용하신 금액만큼 순차적으로 차감됩니다.
                    </p>
                    
                    <div class="busy-2l">
                        <ul class="cf">
                            <li>
                                <img src="../img/sub/shopping-bag.png" alt="아이콘">
                                <span class="b2l-t">Option 1</span>
                                <span class="b2l-c">Purchase K-DOD products <br>
                                (excluding Medical Products)</span>
                            </li>
                            <li>
                                <img src="../img/sub/coins.png" alt="아이콘">
                                <span class="b2l-t">Option 2</span>
                                <span class="b2l-c">or <br>
                                Get Discount for K-DOD products </span>
                            </li>
                            <li>
                                <img src="../img/sub/server.png" alt="아이콘">
                                <span class="b2l-t">Option 3</span>
                                <span class="b2l-c">or <br>
                                Use other service in conjunction with
                                purchasing (ex- Free delivery, etc.) </span>
                            </li>
                        </ul>
                    </div>
                    <!--<div class="where_img">
                        <img src="../img/sub/point7.png" alt="설명이미지">
                        <img src="../img/sub/point8.png" alt="설명이미지">
                        <img src="../img/sub/point9.png" alt="설명이미지">
                    </div>-->
                    <p>
                        <span>* 케이닷 포인트는 미얀마와 캄보디아에서만 사용할 수 있고, 1 포인트는 [1 미얀마 짯] 혹은 [3 캄보디아 리엘]의 가치로 계산됩니다.</span> <br>
                        1,000 point = 1,000 MMK <br>
                        1,000 point = 3,000 KHR
                    </p>
                </div>
        </section>
        
        <section class="point_key">
            <div class="point_key_bg">
                <h2>케이닷 포인트에 대해 중요하게 알아야 할 것들!</h2>
                <div class="po_l">
                    <ul>
                        <li>
                            &#8226; 환급받을 수 있나요?
								<div class="bg">
									<span>NO.</span> <br>
									케이닷 포인트는 현금으로 전환되거나 환급받을 수 없습니다.
								</div>
                        </li>
                        <li>
                            &#8226; 합산할 수 있나요?
                            <ul>
								<div class="bg">
										<span>NO.</span> <br>
										케이닷 포인트는 다른 사람의 포인트와 합산될 수 없습니다.
								</div>
                            </ul>
                        </li>
                        <li>
                            &#8226; 양도할 수 있나요?
                            <ul>
								<div class="bg">
										<span>NO.</span> <br>
										케이닷 포인트는 다른 사람에게 양도할 수 없습니다.
								</div>
                            </ul>
                        </li>
                        <li>
                            &#8226; 금액이 변동될 수 있나요?
                            <ul>
								<div class="bg">
										<span>YES.</span> <br>
										심각한 환율 변동이나 인플레이션이 있을 경우, 케이닷 포인트는 조정될 수 있습니다.
								</div>
                            </ul>
                        </li>
                        <li>
                            &#8226; 사라질 수 있나요?
                            <ul>
								<div class="bg">
										<span>YES.</span> <br>
										모든 케이닷 포인트는 24개월간 유효합니다. 24개월간 사용하지 않은 포인트는 사라지게 됩니다.
								</div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
           <div class="busy4-btn">
                <button type="button" onclick="regist_pannel();">
                    <span class="b4b-info">패널이 되고 싶으세요?</span>
                    <span class="b4b-t">회원 가입하기</span>
                </button>
                <button type="button" onclick="location.href='./online-go-to-survey.php'">
                    <span class="b4b-info">참여하고 싶으세요?</span>
                    <span class="b4b-t">서베이 참여하기</span>
                </button>
            </div>
        </section>
    </div>

 
    <script>
        $(document).ready(function() {


            $('.visual-slider').bxSlider({
                auto: true,
                pager: true,
                mode: 'fade',
                hideControlOnEnd: true
            });

            $('.cont1-slider').bxSlider({
                auto: true,
                pager: true,
                hideControlOnEnd: true
            });
        });


        $(document).ready(function() {
            var tabBtn = $("#tab-btn > ul > li"); //각각의 버튼을 변수에 저장
            var tabCont = $("#tab-cont > div"); //각각의 콘텐츠를 변수에 저장

            //컨텐츠 내용을 숨겨주세요!
            tabCont.hide().eq(0).show();

            tabBtn.click(function() {
                var target = $(this); //버튼의 타겟(순서)을 변수에 저장
                var index = target.index(); //버튼의 순서를 변수에 저장
                //alert(index);
                tabBtn.removeClass("active"); //버튼의 클래스를 삭제
                target.addClass("active"); //타겟의 클래스를 추가
                tabCont.css("display", "none");
                tabCont.eq(index).css("display", "block");
            });


        });

		function regist_pannel(){
		<?if($_SESSION['member_coinc_idx']){?>
			window.open("panel.php","survey_mem", "top=100,left=400,scrollbars=yes,resizable=no,width=800,height=600");
		<?}else{?>
			alert("please login first.");
		<?}?>
		}

    </script>
<? include "../include/footer_sub.php"?>