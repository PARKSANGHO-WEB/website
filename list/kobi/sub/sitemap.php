<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <title>코비인사이트(주)</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
</head>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
    <header class="sub">
        <div class="header-t">
            <div class="h_wrap">
                <div class="gnb">
                    <div class="gnb_wrap">
                        <ul>
                              <?
							if($_SESSION['member_coinc_id'] !=""){
						?>
							<li>
                                <a href="./mypage.php">마이페이지</a>
                            </li>
							<li>
                                <a href="./logout.php">로그아웃</a>
                            </li>
						<?
							}else{
						?>
							<li>
                                <a href="./join_sns.php">회원가입</a>
                            </li>
                            <li>
                                <a href="./login.php">로그인</a>
                            </li>

						<?
						}
						?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="nav">
                <div class="logo" onclick='location.href="../main.php"'>
                    <img src="../img/logo_w.png" alt="">
                </div>
                <div class="menu_b">
                    
                    <ul>
                        <li class="off-item">
                            <a class="big_m"  href="./about.php">About Us</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./about.php#about_1">회사소개</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_2">미션&비전</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_3">CI스토리</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_4">조직도</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_5">오시는 길</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./business.php">Business Area</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./business.php#busi_1">비즈니스 특징</a>
                                    </li>
                                    <li>
                                        <a href="./business.php#busi_2">차별화</a>
                                    </li>
                                    <li>
                                        <a href="./business.php#busi_3">비즈니스 영역</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./factory_1.php">Business Factory</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./factory_1.php">진행현황</a>
                                    </li>
                                    <li>
                                        <a href="./factory_2.php">컨설팅 사례</a>
                                    </li>
                                    <li>
                                        <a href="./factory_3.php">상담실(Q&A)</a>
                                    </li>
                                    <li>
                                        <a href="./factory_4.php">FACTORY(자료실)</a>
                                    </li>
                                    <li>
                                        <a href="./factory_5.php">공작소(자료제작)</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./info_1.php">Information</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./info_1.php">이용안내</a>
                                    </li>
                                    <li>
                                        <a href="./info_2.php">공지사항</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-b"></div>
    </header>

    <section>
        <div class="side_wrap">
            <div class="side_bar">
                <ul>
                    <li>
                        <p>KOBIINSIGHT</p>
                    </li>
                     <?
                    if($_SESSION['member_coinc_id'] !=""){
                 ?>
                    <li>
                        <a href="./consult_login.php">컨설팅<br />의뢰</a>
                    </li>
                    <?}else if($_SESSION['member_coinc_id'] ==""){?>
                    <li>
                        <a href="./consult_notlogin.php">컨설팅<br />의뢰</a>
                    </li>
                    <?}?>
                    <li>
                        <a href="./factory_3.php">문의하기<br />(Q&A)</a>
                    </li>
                    <li>
                        <a href="http://cafe.naver.com/kobiinsight"  target="_blank">카페<br />바로가기</a>
                    </li>
                    <li>
                        <a class="goTop" href="javascript:;">
                            <img src="../img/sub/goTop.png" alt="">
                        </a>
                    </li>
                </ul>    
            </div>
        </div>
        <div class="sitemap">
            <div class="site_title">
                <p>Sitemap</p>
            </div>
            <ul>
                <li>
                    <a href="./about.php#about_1" class="site-big">
                        About us
                    </a>
                    <a href="./about.php#about_1" >회사소개</a>
                    <a href="./about.php#about_2">미션 & 비전</a>
                    <a href="./about.php#about_3">CI스토리</a>
                    <a href="./about.php#about_4">조직도</a>
                    <a href="./about.php#about_5">오시는 길</a>
                </li>
                <li>
                    <a href="./business.php#busi_1" class="site-big">
                        Business Area
                    </a>
                    <a href="./business.php#busi_1">비지니스 특징</a>
                    <a href="./business.php#busi_2">차별화</a>
                    <a href="./business.php#busi_3">비즈니스 영역</a>
                </li>
                <li>
                    <a href="./factory_1.php" class="site-big">
                        Business Factory
                    </a>
                    <a href="./factory_1.php">진행 사례</a>
                    <a href="./factory_2.php">컨설팅 사례</a>
                    <a href="./factory_3.php">상담실(Q&A)</a>
                    <a href="./factory_4.php">FACTORY(자료실)</a>
                    <a href="./factory_5.php">공작소(자료제작)</a>
                </li>
                <li>
                    <a  href="./info_1.php" class="site-big">
                        Information
                    </a>
                    <a href="./info_1.php">이용안내</a>
                    <a href="./info_2.php">공지사항</a>
                </li>
            </ul>
        </div>
    </section>
    <footer>
        <div class="foot-wrap">
            <ul>
                <li>
                    <span>
                        코비인사이트 주식회사
                    </span>
                </li>
                <li>
                    <span>
                        서울특별시 강남구 테헤란로 82길 14, 4층 ( 대치동 청풍빌딩 )
                    </span>
                </li>
                <li>
                    <span>
                        사업자 등록번호 : 301-88-00046
                    </span>
                    <span>
                        대표전화 : 02-2088-8102
                    </span>
                    <span>
                        팩스번호 : 02-2088-8105
                    </span>
                    <span>
                        이메일 : contact@kobiinsight.co.kr
                    </span>
                </li>
                <li>
                    <span>
                        Copyright ⓒ 2020 KOBI INSIGHT All Right Reserved.
                    </span>
                </li>
            </ul>
        </div>
    </footer> 
</body>
</html>