<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>

    <div class="gnb">
        <div class="gnb-wrap">
        <?
        if(empty($_SESSION['EMP_NO'])){
        ?>
            <a href="/mypage/reserv.php">예약확인</a>
            <a href="javascript:login();">로그인</a>
        <?
        }else{
        ?>
            <a href="/mypage/reserv.php">예약확인</a>
            <a href="javascript:logout();">로그아웃</a>
        <?
        }
        ?>
        </div>
    </div>
    <div class="header">
        <div class="header-wrap">
            <div class="logo" onclick="location.href='/'">
                <img src="<?=$_SITE_LOGO?>" alt="<?= $_SITE_COMPANY ?> 로고">
            </div>
            <div class="top-menu">
                <a href="/resort/resort_list.php">휴양소</a>
                <a href="/community/qna/qna.php">커뮤니티</a>
                <a href="/mypage/mypage.php">마이페이지</a>
            </div>
        </div>
    </div>
    <div class="bar">
        <div class="bar1-1"></div>
        <div class="bar2-1">
            <div class="c-bar1"></div>
            <div class="c-bar2"></div>
        </div>
        <div class="bar3-1"></div>
    </div>
    <div class="mobile-menu">
        <ul>
            <li>
                <a class="lm-big" class="on" href="/resort/resort_list.php">휴양소</a>
            </li>
            <li>
                <a class="lm-big" href="/community/qna/qna.php">커뮤니티</a>
            </li>
            <li>
                <a class="lm-big" href="/mypage/mypage.php">마이페이지</a>
            </li>
        </ul>
    </div>

