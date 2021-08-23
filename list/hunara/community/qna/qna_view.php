<? include("../../inc/header.php"); ?>
<link rel="stylesheet" href="../../css/community_view.css">
<body>
    <header></header>
    <div id="mainImage">
        <h2>Q&A</h2>
    </div>
    <?php 
        if(!$gconnet) {
            die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
        }
        $idx = $_GET['idx'];
        $page = $_GET['page'];
        $tableName = "tb_qa";
        $getHit = mysqli_query($gconnet, 'SELECT hit FROM '.$tableName.' WHERE idx = "'.$idx.'"');
        $hitCount = mysqli_fetch_array($getHit);
        $hitCount = $hitCount['hit'] + 1;
        $updateHit = mysqli_query($gconnet, 'UPDATE '.$tableName.' SET hit = "'.$hitCount.'" WHERE idx = "'.$idx.'"');
        $sql = 'SELECT idx, title, name, content, b_file1, ori_name, date_format(nows, "%Y/%m/%d") as nows FROM '.$tableName.' WHERE idx = "'.$idx.'"';
        $result = mysqli_query($gconnet, $sql);
        $contents = mysqli_fetch_array($result);


        $sql2 = "SELECT idx, title, name, content, b_file1, ori_name, date_format(nows, '%Y/%m/%d') as nows from tb_qa where idx != '".$idx."' and ref = '".$idx."' order by idx desc limit 0,1";
        $query2 = mysqli_query($gconnet,$sql2);
        $row2 = mysqli_fetch_array($query2);
    ?>
    <div id="container">
		<div class="sort-menu" id="sangse-sort">
			<ul>
				<li class="active">
					<span onclick="location. href='./qna.php'">Q&A</span>
				</li>
				<li>
					<span onclick="location. href='../notice/notice.php'">공지사항</span>
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
							<p><?php echo nl2br($contents['content']);?></p>
							
						</div>
           			</td>
           		</tr>
           		<tr>
           			<td>첨부파일</td>
           			<td>
                       <?php
                            if(!$contents['b_file1'] == null) {
                                echo
                                "
                                <br><a href='../../upload_file/qa/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>    
                                <img src='../../upload_file/qa/".$contents['b_file1']."' alter='설명이미지' style='width:100%'>
                                ";
                            }
                        ?>   
                    </td>
           		</tr>
           	</table>
           
           
           
<!--
           
            <div id="title"><p><?=$contents['title']?></p></div>
            <div id="info">
                <div id="writer"><?=$contents['name']?></div>
                <div id="date"><?=$contents['nows']?></div>
            </div>
            <div id="mainText">
                <div id="contents">
                    <p><?php echo nl2br($contents['content']);?></p>
                    <?php
                        if(!$contents['b_file1'] == null) {
                            echo
                            "
                            <br><a href='../../upload_file/qa/".$contents['b_file1']."'target='_blank'><p>".$contents['ori_name']."</p></a>    
                            <img src='../../upload_file/qa/".$contents['b_file1']."' alter='설명이미지' style='width:100%'>
                            ";
                        }
                    ?>
                </div>
            </div>
-->
        </div>
        
        
        
        <div id="textView">
        <?php 
        if($row2){

        ?>
        
		   <span class="manageAns">관리자 답변</span>
           	<table>
           		<tr>
           			<td><span class="nt-t">제목</span></td>
           			<td><span class="nt-c"><?=$row2['title']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">작성자</span></td>
           			<td><span class="nt-c"><?=$row2['name']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">작성일</span></td>
           			<td><span class="nt-c"><?=$row2['nows']?></span></td>
           		</tr>
           		<tr>
           			<td><span class="nt-t">내용</span></td>
           			<td>
						<div id="contents">
							 <p><?php echo nl2br($row2['content']);?></p>
								
						</div>
           			</td>
           		</tr>
           		<tr>
           			<td>첨부파일</td>
           			<td>
                       <?php
                            if(!$row2['b_file1'] == null) {
                                echo
                                "
                                <br><a href='../../upload_file/qa/".$row2['b_file1']."'target='_blank'><p>".$row2['ori_name']."</p></a>    
                                <img src='../../upload_file/qa/".$row2['b_file1']."' alter='설명이미지' style='width:100%'>
                                ";
                            }
                        ?>   
                    </td>
           		</tr>
           	</table>

            <?php } ?>
        
        
<!--
        
        관리자 답변
            <div id="title"><p><?=$row2['title']?></p></div>
            <div id="info">
                <div id="writer"><?=$row2['name']?></div>
                <div id="date"><?=$row2['nows']?></div>
            </div>
            <div id="mainText">
                <div id="contents">
                    <p><?php echo nl2br($row2['content']);?></p>
                    <?php
                        if(!$row2['b_file1'] == null) {
                            echo
                            "
                            <br><a href='../../upload_file/qa/".$row2['b_file1']."'target='_blank'><p>".$row2['ori_name']."</p></a>    
                            <img src='../../upload_file/qa/".$row2['b_file1']."' alter='설명이미지' style='width:100%'>
                            ";
                        }
                    ?>
                </div>
            </div>
-->
        </div>

        <div id="buttons" class="buttons-3">
            <span class="btn-1">
                <button type="button" onclick="window.history.back()">목록으로</button>
                <button type="button" class="input-pw" id="0">수정하기</button>
        		<button type="button" class="input-pw" id="1">삭제하기</button>
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
				<form action="qna_modi.php" method="POST">
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
       $('.input-pw').click(function(){
            $('#funct').val($(this).attr('id'));
       });
            
    </script>
</body>
</html>