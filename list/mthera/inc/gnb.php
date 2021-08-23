	<header>
        <div class="header-wrap">
            <div class="logo">
                <a href="/index.php"><img src="/img/common/logo_c.png" alt=""></a>
            </div>
            <div class="menu">
                <div class="menu_wrap">
                    <ul>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/hello.php">회사소개</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/hello.php">대표이사 인사말</a></li>
                                    <li><a href="/sub/summary.php">사업개요</a></li>
                                    <li><a href="/sub/years.php">회사연혁</a></li>
                                    <li><a href="/sub/people.php">핵심네트워크</a></li>
									<li><a href="/sub/c_i.php">C.I 소개</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/rnd.php">R&D현황</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/rnd.php">핵심기술</a></li>
                                    <li><a href="/sub/pipe.php">파이프라인</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/notice.php?bbs_code=notice">공지&뉴스</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/notice.php?bbs_code=notice">공지&뉴스</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/map.php">오시는길</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/map.php">오시는길</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lang-ek">
                <a href="/eng/index.php">English</a>
            </div>
        </div>
    </header>
    <div class="header_mo">
            <div class="logo">
                <a href="/index.php"><img src="/img/common/logo_c.png" alt=""></a>
            </div>
            <div class="lang-ek">
                <a href="/eng/index.php">English</a>
            </div>
            <div class="bar">
                <div class="bar_1"></div>
                <div class="bar_2">
                    <div class="bar2-1"></div>
                    <div class="bar2-2"></div>
                </div>
                <div class="bar_3"></div>
            </div>
            <script>
                $(document).ready(function(){
                    $(".bar").on("click",function(){
                        $(".mo_menu").toggleClass("done");
                        $(this).toggleClass("on");
                    });
                    
                    $(".big_menu2").on("click",function(){
                        $(this).siblings(".two_depth").toggleClass("go");
                        $(this).toggleClass("go");
                    });
                });
        
            </script>
            <div class="mo_menu">
                <div class="menu_wrap">
                    <ul>
                        <li class="menu_list">
                            <a class="big_menu big_menu2" href="javascript:;">회사소개</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/hello.php">대표이사 인사말</a></li>
                                    <li><a href="/sub/summary.php">사업개요</a></li>
                                    <li><a href="/sub/years.php">회사연혁</a></li>
                                    <li><a href="/sub/people.php">핵심네트워크</a></li>
									<li><a href="/sub/c_i.php">C.I 소개</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu big_menu2" href="javascript:;">R&D현황</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/sub/rnd.php">핵심기술</a></li>
                                    <li><a href="/sub/pipe.php">파이프라인</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/notice.php?bbs_code=notice">공지&뉴스</a>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/sub/map.php">오시는길</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>