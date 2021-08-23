	<header>
        <div class="header-wrap">
            <div class="logo">
                <a href="/eng/index.php"><img src="../../img/common/logo_c.png" alt=""></a>
            </div>
            <div class="menu">
                <div class="menu_wrap">
                    <ul>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/hello.php">About Us</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/hello.php">Letter from CEO</a></li>
                                    <li><a href="/eng/engsub/summary.php">Business Overview</a></li>
                                    <li><a href="/eng/engsub/years.php">Business History</a></li>
                                    <li><a href="/eng/engsub/people.php">Core Network</a></li>
									<li><a href="/eng/engsub/c_i.php">C.I Introduction</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/rnd.php">R&D Highlights</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/rnd.php">R&D</a></li>
                                    <li><a href="/eng/engsub/pipe.php">Pipeline</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/notice.php?bbs_code=notice">News Room</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/notice.php?bbs_code=notice">News Room</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/map.php">Contact Us</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/map.php">Contact Us</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lang-ek">
                <a href="/index.php">Korean</a>
            </div>
        </div>
    </header>
    <div class="header_mo">
            <div class="logo">
                <a href="/eng/index.php"><img src="../../img/common/logo_c.png" alt=""></a>
            </div>
            <div class="lang-ek">
                <a href="/index.php">Korean</a>
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
                            <a class="big_menu big_menu2" href="javascript:;">About Us</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/hello.php">Letter from CEO</a></li>
                                    <li><a href="/eng/engsub/summary.php">Business Overview</a></li>
                                    <li><a href="/eng/engsub/years.php">Business History</a></li>
                                    <li><a href="/eng/engsub/people.php">Core Network</a></li>
									<li><a href="/eng/engsub/c_i.php">C.I Introduction</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu big_menu2" href="javascript:;">R&D Highlight</a>
                            <div class="two_depth">
                                <ul>
                                    <li><a href="/eng/engsub/rnd.php">R&D</a></li>
                                    <li><a href="/eng/engsub/pipe.php">Pipeline</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/notice.php?bbs_code=notice">News Room</a>
                        </li>
                        <li class="menu_list">
                            <a class="big_menu" href="/eng/engsub/map.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        