<? include("../../inc/header.php"); ?>
<link rel="stylesheet" href="../../css/community.css">
<link rel="stylesheet" href="../../css/wSelect.css">
<?
    $types = $_GET['types'];
    $search = $_GET['search'];
    $page = $_GET['page'];
?>
<body>
    <header></header>
    <div id="mainImage">
        <h2>이용후기</h2>
    </div>
    <div id="container">
        
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li>
						<span onclick="location. href='../qna/qna.php'">Q&A</span>
					</li>
					<li>
						<span onclick="location. href='../notice/notice.php'">공지사항</span>
					</li>
					<li class="active">
						<span onclick="location. href='./review.php'">이용후기</span>
					</li>
				</ul>
			</div>
		</div>
        <div id="search">
            <div>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                    <select name="types" id="types">
                        <option value="title" <?=($types == "title")?"selected":""?>>제목</option>
                        <option value="name" <?=($types == "name")?"selected":""?>>작성자</option>
                        <option value="content" <?=($types == "content")?"selected":""?>>내용</option>
                    </select>
                    <input type="text" name="search" placeholder="검색어를 입력해주세요." value="<?=$search?>">
                    <div>
						<button class="search-btn" type="submit">검색</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="table">
            <table>
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

                    $resultPerPage = 10;
                    $tableName = 'tb_rv';

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } 

                    $pageFirstResult = ($page - 1) * $resultPerPage;

                    $sql = 'SELECT idx, title, name, date_format(nows, "%Y/%m/%d") as nows FROM '.$tableName.' WHERE bkind = '.$_COMPANY_ID;

                    if (!$types == '') {
                        $sql .= ' AND '.$types. ' LIKE "%' .$search. '%" ';
                    }

                    $result = mysqli_query($gconnet, $sql);
                    $numberOfResults = mysqli_num_rows($result);
                    $numberOfPage = ceil($numberOfResults/$resultPerPage);

                    
                    $sql .= ' ORDER BY idx DESC LIMIT ' . $pageFirstResult . ',' . $resultPerPage;
                    $result = mysqli_query($gconnet, $sql);
                    

                    if ($numberOfResults == 0) {
                        echo 
                        "
                            <tr>
                                <td colspan='4'>등록된 글이 없습니다.</td>
                            </tr>    
                        ";
                    } else {

                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $numberOfResults - $pageFirstResult - $i;
                            $i++;

                ?>
                            <tr>
                                <td><?=$id?></td>
                                <td><a href="review_view.php?idx=<?=$row["idx"]?>&page=<?=$page?>"><?=$row["title"]?></a></td>
                                <td><?=$row["name"]?></td>
                                <td><?=$row["nows"]?></td>
                            </tr>
                <?php
                        }      
                    }
                ?>                      

            </table>
        <?php 
            $writeUrl =  "review_write.php";
            include $_SERVER["DOCUMENT_ROOT"]."/inc/paging.php";	 
        ?>
        </div>
    </div>
    <footer></footer>
</body>
</html>