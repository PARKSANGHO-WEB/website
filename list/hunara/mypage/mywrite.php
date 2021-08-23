<? include("../inc/header.php");  ?>

<script defer>
    $(document).ready(function(){
        $('.top-menu a').eq("3").addClass('active');
			
		$(".box-left").on('click',function(){
			$(this).parents('.box').removeClass('on-2');
			$(this).parents('.box').addClass('on-1');
		});
			
		$(".box-right").on('click',function(){
			$(this).parents('.box').removeClass('on-1');
			$(this).parents('.box').addClass('on-2');
		});
			
	});
    
	</script>
</head>
<body>
    <header></header>
    <div id="container">
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li >
						<span onclick="location.href='/mypage/mypage.php'">회원정보</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/reserv.php'">예약내역</span>
					</li>
					<li class="active">
						<span onclick="location.href='/mypage/mywrite.php'">내 게시글 관리</span>
					</li>
				</ul>
			</div>
		</div>
        <div id="table">
            <div id="subMenu2">
				<button type="button" onclick="location.href='mywrite.php?kind=tb_qa'">Q&A</button>
				<button type="button" onclick="location.href='mywrite.php?kind=tb_rv'">이용후기</button>
            </div>
            <table id="mr-table">
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                </tr>
                <?php 
                    if(!$gconnet) {
                        die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
                    }

                    $eseq = $_SESSION['EMP_SEQ'];
                    $resultPerPage = 10;

                    if (!isset($_GET['kind'])) {
                        $tableName = "tb_qa";
                        $link = "../community/qna/qna";
                        
                    } else {
                        $tableName = $_GET['kind'];
                        if ($_GET['kind'] == "tb_qa") {
                            $link = "../community/qna/qna";
                        } elseif ($_GET['kind'] == "tb_rv") {
                            $link = "../community/review/review";
                        }
                    };

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }                    

                    $sql = "SELECT * FROM ".$tableName." WHERE eseq = '".$eseq."' OR ( name = '".$_SESSION['EMP_NM']."' AND email = '".$_SESSION['EMP_EMAIL']."') ";
                    $result = mysqli_query($gconnet, $sql);
                    
                    $numberOfResults = mysqli_num_rows($result);

                    $numberOfPage = ceil($numberOfResults/$resultPerPage);

                    $pageFirstResult = ($page - 1) * $resultPerPage;


                    if ($numberOfResults == 0) {
                        echo 
                        "
                            <tr>
                            </tr>    
                        ";
                    } else {
                        $sql = "SELECT idx, title, name, date_format(nows, '%Y/%m/%d') as nows FROM ".$tableName;
                        if($tableName == 'tb_qa'){
                            $sql .= " WHERE eseq = '" .$eseq. "' and ref = idx OR ( name = '".$_SESSION['EMP_NM']."' AND email = '".$_SESSION['EMP_EMAIL']."') ";
                        }else{
                            $sql .= " WHERE eseq = '" .$eseq. "' OR ( name = '".$_SESSION['EMP_NM']."' AND email = '".$_SESSION['EMP_EMAIL']."') ";
                        }
                        $sql .= " ORDER BY idx DESC LIMIT " . $pageFirstResult . "," . $resultPerPage;
                            $result = mysqli_query($gconnet, $sql);

                            $i=0;
                            while ($row = mysqli_fetch_array($result)) {
                                $id = $numberOfResults - $pageFirstResult - $i;
                                $i++;
                                ?>
                                <tr>
                                    <td><?=$id?></td>
                                    <td><a href="<?=$link?>_view.php?idx=<?=$row["idx"]?>&page=<?=$page?>"><?=$row["title"]?></a></td>
                                    <td><?=$row["name"]?></td>
                                    <td><?=$row["nows"]?></td>
                                </tr>
                                <?php
                            }
                        }  
                ?>
            </table> 
            <?php include("../inc/paging.php") ?>
    	</div>
    </div>
    <footer></footer>
    <script>
        let active;
        const actives = document.querySelectorAll('#subMenu2 > button');
        
        let search = window.location.search;
        if (search.includes("tb_qa") || search == "") {
            active = 0;
        } else {
            active = 1;
        }
        function picked() {
            actives[active].classList.add('active');
        }
        picked();
    </script>
</body>
</html>