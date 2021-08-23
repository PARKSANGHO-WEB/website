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
            <div class="hamburge r">
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
    
    
    <section class="k-meme">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.html">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">K-DOD Playground</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">K-DOD MEME</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">K-DOD Playground</span>
                    <span class="ban-text">K-DOD MEME</span>
                </div>
            </div>
        </div>
    </section>
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
<? include "../include/footer_sub.php"?>
</body>
</html>