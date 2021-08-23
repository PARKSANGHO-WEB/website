<? include("../../inc/header.php"); ?>
<link rel="stylesheet" href="../../css/community_view.css">
<body>
    <header></header>
    <div id="mainImage">
        <h2>공지사항</h2>
    </div>
    <?php 
        if(!$gconnet) {
            die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
        }
        $idx = $_GET['idx'];
        $page = $_GET['page'];
        $tableName = "tb_pds";
        $getHit = mysqli_query($gconnet, 'SELECT hit FROM '.$tableName.' WHERE idx = "'.$idx.'"');
        $hitCount = mysqli_fetch_array($getHit);
        $hitCount = $hitCount['hit'] + 1;
        $updateHit = mysqli_query($gconnet, 'UPDATE '.$tableName.' SET hit = "'.$hitCount.'" WHERE idx = "'.$idx.'"');
        $sql = 'SELECT idx title, name, content, b_file1, ori_name, date_format(nows, "%Y/%m/%d") as nows FROM '.$tableName.' WHERE idx = "'.$idx.'"';
        $result = mysqli_query($gconnet, $sql);
        $contents = mysqli_fetch_array($result);
    ?>
    <div id="container">
		<div class="sort-menu" id="sangse-sort">
			<ul>
				<li>
					<span onclick="location. href='../qna/qna.php'">Q&A</span>
				</li>
				<li class="active">
					<span onclick="location. href='./notice.php'">공지사항</span>
				</li>
				<li>
					<span onclick="location. href='../review/review.php'">이용후기</span>
				</li>
			</ul>
		</div>
        <div id="textView">
           	<table>
           		<tr>
           			<td><span class="nt-t">제목</span></td>
           			<td><span class="nt-c"><?=$contents['title']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">작성자</span></td>
           			<td><span class="nt-c"><?=$contents['name']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">작성일</span></td>
           			<td><span class="nt-c"><?=$contents['nows']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">내용</span></td>
           			<td>
						<div id="contents">
							<p><?php echo nl2br($contents['content'])?></p>
							
						</div>
           			</td>
           		</tr>
           		<tr>
           			<td>첨부파일</td>
           			<td>
                       <?php
                            if(!$contents['b_file1'] == null) {
                                $fileName = $contents['b_file1'];
                                $fileExt = explode(".", $fileName);
                                $fileActualExt = strtolower(end($fileExt));
                                $images = array("jpg","jpeg","png");
                                if(in_array($fileActualExt, $images)) {
                                    echo
                                    "
                                    <br><a href='../../upload_file/pds/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>    
                                    <img src='../../upload_file/pds/".$contents['b_file1']."' alter='설명이미지' style='width:100%'>
                                    ";
                                } else {
                                    echo
                                    "
                                    <br><a href='../../upload_file/pds/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>
                                    ";
                                }

                            }
                        ?>   
                    </td>
           		</tr>
           	</table>
<!--
            <div id="title">
            	<span class="nt-t">제목</span>
            	<span class="nt-c"><?=$contents['title']?></span>
            </div>
            <div id="writer">
            	<span class="nt-t">작성자</span>
            	<span class="nt-c"><?=$contents['name']?></span>
            </div>
            <div id="date">
            	<span class="nt-t">작성일</span>
            	<span class="nt-c"><?=$contents['nows']?></span>
            </div>
            <div id="mainText">
               	<span class="nt-t"></span>
                <div id="contents">
                    <p><?php echo nl2br($contents['content'])?></p>
                    <?php
                        if(!$contents['b_file1'] == null) {
                            $fileName = $contents['b_file1'];
                            $fileExt = explode(".", $fileName);
                            $fileActualExt = strtolower(end($fileExt));
                            $images = array("jpg","jpeg","png");
                            if(in_array($fileActualExt, $images)) {
                                echo
                                "
                                <br><a href='../../upload_file/pds/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>    
                                <img src='../../upload_file/pds/".$contents['b_file1']."' alter='설명이미지' style='width:100%'>
                                ";
                            } else {
                                echo
                                "
                                <br><a href='../../upload_file/pds/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>
                                ";
                            }
                            
                        }
                    ?>
                </div>
            </div>
-->
        </div>
        <div id="buttons" class="buttons-3">
        	<span class="btn-1">
                <button type="button" onclick="window.history.back()">목록으로</button>
            </span>
		</div>
    </div>
    <footer></footer>
    <div class="modi-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="close-modal">
					<img src="../../img/common/close-b.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<form action="notice_modi.php" method="POST">
					<div class="mo-con">
						<p>글 작성시 입력한<br />
						비밀번호를 입력해주세요.</p>
                        <input type="text" name="funct" hidden id="funct">
                        <input type="text" name="idx" hidden value="<?=$idx?>">
                        <input type="text" name="tableName" hidden value="<?=$tableName?>">
						<input type="password" name="pwd">
						<div class="s1-button">
							<button type="submit" name="submit">확인</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    <script>
        const buttons = document.querySelectorAll('.input-pw');
        const funct = document.querySelector('#funct');
        for(let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', () => {
                funct.value = i;
                console.log(i);
            })
        }
            
    </script>
</body>
</html>