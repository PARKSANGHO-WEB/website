<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
</head>
<body>
    <header id="navbar">
        <div class="header-wrap">
            <div class="hamburger">
                <div class="hamburger-menu">
                    <input id="menu__toggle" type="checkbox" />
                    <label class="menu__btn" for="menu__toggle">
                    <span></span>
                    </label>

                        <div class="menu__box">
                            <div class="logo-mb">
                                <img src="../img/logo.png" alt="">
                            </div>
                            <div class="menu-bw">
                                <li class="big-mb">
                                    <span class="menu-top">About Us</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">About Company</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Our Business</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">About CI</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Myanmmar & Cambodia </a> 
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="big-mb">
                                    <span class="menu-top">Products for Doctor</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="./sub/dermatology.html">Dermatology</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Dental</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Ophthalmology </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="big-mb">
                                    <span class="menu-top">Products for Public</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">Cosmetic</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Homecare</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Point-Mall </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="big-mb">
                                    <span class="menu-top">Online Survey</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">Market Research Survey</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Online Survey</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Online Panel</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">K-DOD Point</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Go To Survey</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="big-mb">
                                    <span class="menu-top">K-DOD Playground</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">K-DOD MEME</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Playground </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="big-mb">                        
                                    <span class="menu-top">Board</span>
                                    <div class="mt-subl">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">FAQ</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Inquiry / Order / Suggestion</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="main-logo" onclick="location.href='../index.html'">
                <img src="../img/logo.png" alt="">
            </div>
            <div class="gnb-ul">
                <ul>
                    <li class="gnb-big">
                        <a href="javascript:;">Mypage</a> 
                    </li>
                    <li class="gnb-big">
                        <a href="./login.html">Logout</a>
                    </li>
                    <li class="gnb-big">
                        <a href="javascript:;">Search</a>
                    </li>
                    <li class="gnb-big">
                        <div class="select" data-role="selectBox">
                            <span date-value="optValue" class="selected-option">
                                
                            </span>
                            <!-- 옵션 영역 -->
                            <ul class="hide">
                                <li>
                                    <span class="eng">English</span>
                                </li>
                                <li>
                                    <span class="myan">မြန်မာဘာသာ</span>
                                </li>
                                <li>
                                    <span class="cam">ភាសាខ្មែរ</span>
                                </li>
                                <li>
                                    <span class="kr">한국어</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <script>

            const body = document.querySelector('body');
            const select = document.querySelector(`[data-role="selectBox"]`);
            const values = select.querySelector(`[date-value="optValue"]`);
            const option = select.querySelector('ul');
            const opts = option.querySelectorAll('li');

            /* 셀렉트영역 클릭 시 옵션 숨기기, 보이기 */
            function selects(e){
            e.stopPropagation();
            option.setAttribute('style',`top:${select.offsetHeight}px`)
            if(option.classList.contains('hide')){
            option.classList.remove('hide');
            option.classList.add('show');
            }else{
            option.classList.add('hide');
            option.classList.remove('show');
            }
            selectOpt();
            }

            /* 옵션선택 */
            function selectOpt(){
            opts.forEach(opt=>{
            const innerValue = opt.innerHTML;
            function changeValue(){
            values.innerHTML = innerValue;
            }
            opt.addEventListener('click',changeValue)
            });
            }

            /* 렌더링 시 옵션의 첫번째 항목 기본 선택 */
            function selectFirst(){
            const firstValue = opts[0].innerHTML;
            values.innerHTML = `${firstValue}`
            }

            /* 옵션밖의 영역(=바디) 클릭 시 옵션 숨김 */
            function hideSelect(){
            if(option.classList.contains('show')){
            option.classList.add('hide');
            option.classList.remove('show');
            }
            }

            selectFirst();
            select.addEventListener('click',selects);
            body.addEventListener('click',hideSelect);
        </script>
        
        <script>
            window.onscroll = function() {myFunction()};

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
              if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
              } else {
                navbar.classList.remove("sticky");
              }
            }
        </script>

        <div class="main_menu">
            <div class="mm-wrap">
                <div class="big-item">
                    <a c href="javascript:;">
                        About Us
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">About Company</a>
                            </li>
                            <li>
                                <a href="javascript:;">Our Business</a>
                            </li>
                            <li>
                                <a href="javascript:;">About CI</a>
                            </li>
                            <li>
                                <a href="javascript:;">Myanmmar & Cambodia </a> 
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="big-item">
                    <a href="javascript:;">
                        Products for Doctor
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">Dermatology</a>
                            </li>
                            <li>
                                <a href="javascript:;">Dental</a>
                            </li>
                            <li>
                                <a href="javascript:;">Ophthalmology </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="big-item">
                    <a href="javascript:;">
                        Products for Public
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">Cosmetic</a>
                            </li>
                            <li>
                                <a href="javascript:;">Homecare</a>
                            </li>
                            <li>
                                <a href="javascript:;">Point-Mall </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="big-item">
                    <a href="javascript:;">
                        Online Survey
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">Market Research Survey</a>
                            </li>
                            <li>
                                <a href="javascript:;">Online Survey</a>
                            </li>
                            <li>
                                <a href="javascript:;">Online Panel</a>
                            </li>
                            <li>
                                <a href="javascript:;">K-DOD Point</a>
                            </li>
                            <li>
                                <a href="javascript:;">Go To Survey</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="big-item">
                    <a href="javascript:;">
                        K-DOD Playground
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">K-DOD MEME</a>
                            </li>
                            <li>
                                <a href="javascript:;">Playground </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="big-item">
                    <a href="javascript:;">
                        Board
                    </a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="javascript:;">FAQ</a>
                            </li>
                            <li>
                                <a href="javascript:;">Inquiry / Order / Suggestion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    
    <section class="survey">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.html">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">Products for Doctor</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">Dermatology</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Doctor</span>
                    <span class="ban-text">Dermatology, Dental, Ophthalmology Products</span>
                </div>
            </div>
        </div>
        <div class="survey-cont">
            <div class="survey-flat">
                <ul>
                    <li>
                        <a href="javascript:;">Market Research Survey</a>
                    </li>
                    <li>
                        <a href="javascript:;">Online Survey</a>
                    </li>
                    <li>
                        <a href="javascript:;">Online Panel</a>
                    </li>
                    <li>
                        <a href="javascript:;">K-DOD Point</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;">Go To Survey</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="survey-list">
            <div class="dl-top">
                <p>GO TO SURVEY</p>
                <span class="s-title">
                    You can find the list of on-going surveys and terminated surveys here. Please find our on-going surveys,<br />participate in and get all benefits.
                </span>
                <span class="s-text">
                    1) Panel members are required to log-in for survey participation
                </span>
                <span class="s-text">
                    2) Non-panel members are required to register as a member
                </span>
            </div>
            <div class="search-line">
                <div class="numbering">
                    <span class="nb-title">Total </span><span>:</span>
                    <span class="nb-count">6</span>
                </div>
                <div class="search-t">
                    <input type="search" value="search">
                    <button type="button"><img src="../img/sub/search.svg" alt=""></button>
                </div>
            </div>
            <div class="survey-list">
                <ul>
                    <li class="item-box">
                        <div class="sur-thumb">
                            <img src="../img/sub/survey-1.png" alt="">
                        </div>
                        <div class="sur-info">
                            <div class="sur-title">
                                <p>PANEL PROFILE SURVEY</p>
                                <span>[Mandatory for all new Panel]</span>
                            </div>
                            <div class="sur-point">
                                <span>K-DOD Point : 200 P</span>
                            </div>
                            <div class="sur-award"><span>Award : NO</span></div>
                            <div class="sur-summar">
                                <div class="summary-l summary-1">
                                    <span class="subject">-Target :</span>
                                    <span class="target">ALL NEW Members</span>
                                </div>
                                <div class="summary-l summary-2">
                                    <span class="subject">-Questions :</span>
                                    <span class="target">10 Questions</span>
                                </div>
                                <div class="summary-l summary-3">
                                    <span class="subject">-Time :</span>
                                    <span class="target">5 minutes</span>
                                </div>
                                <div class="summary-l summary-4">
                                    <span class="subject">-GOAL :</span>
                                    <span class="target">3,000 People</span>
                                </div>
                                <div class="summary-l summary-5">
                                    <span class="subject">-Period :</span>
                                    <span class="target">Feb.1.2021 ~ continue</span>
                                </div>
                                <div class="summary-l summary-6">
                                    <span class="subject">-Type:</span>
                                    <span class="target">K-DOD own survey</span>
                                </div>
                                <div class="sum-uniq">
                                    <span>*This survey is to build up KDOD panel’s Profile data</span>
                                </div>
                                <div class="survey-btn">
                                    <button type="button">Start Survey</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="paging">
                <span class="paging-wrap">
                    <a href="javascript:;">
                        <img class="two" src="../img/b-all.png" alt="">
                    </a>
                    <a href="javascript:;">
                        <img class="one" src="../img/b-al.png" alt="">
                    </a>
                    <a href="javascript:;">
                        1
                    </a>
                    <a href="javascript:;">
                        <img class="one" src="../img/b-ar.png" alt="">
                    </a>
                    <a href="javascript:;">
                        <img class="two" src="../img/b-arr.png" alt="">
                    </a>
                </span>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="foot-wrap">
            <ul>
                <li class="foot-item">
                    <div class="foot-logo">
                        <img src="../img/foot-logo.png" alt="">
                    </div>
                    <ul class="info">
                        <li>
                            <span>Terms of Service</span>
                        </li>
                        <li>
                            <span>Privacy Policy</span>
                        </li>
                    </ul>
                </li>
                <li class="foot-item">
                    <div class="foot-title">
                        <span>TEL</span>
                    </div>
                    <div class="foot-cont">
                        <span>
                            + 82. 2. 2633. 1644
                        </span>
                    </div>
                </li>
                <li class="foot-item">
                    <div class="foot-title">
                        <span>E-MAIL</span>
                    </div>
                    <div class="foot-cont">
                        <span>
                            Customers@k-dod.com
                        </span>
                    </div>
                </li>
                <li class="foot-item">
                    <div class="foot-title">
                        <span>ADDRESS</span>
                    </div>
                    <div class="foot-cont">
                        <span>
                            (Zip 06132)#704, 609<br />
                            Nonhyeon-ro,Gangnam-gu, Seoul,<br />
                            Republic of Korea
                        </span>
                    </div>
                </li>
                <li class="foot-item">
                    <div class="foot-title">
                        <span>CONTACT</span>
                    </div>
                    <div class="foot-cont">
                        <span>
                            K-DOD Korea Corp.
                        </span>
                        <span>
                            K-DOD Myanmar Co.,LTD
                        </span>
                        <span>
                            K-DOD (Cambodia) Co.,LTD
                        </span>
                    </div>
                </li>
                <li class="foot-item">
                    <div class="foot-title">
                        <span>FOLLOW US</span>
                    </div>
                    <div class="foot-cont"> 
                        <ul>
                            <li>
                                <img src="./img/instagram.svg" alt="">
                            </li>
                            <li>
                                <img src="./img/facebook.svg" alt="">
                            </li>
                            <li>
                                <img src="./img/youtube.svg" alt="">
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="copyright">
            <span>COPYRIGHT © 2021. K-DOD. ALL RIGHTS RESERVED.</span>
        </div>
    </footer>
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
        
        
        
    </script>
</body>
</html>