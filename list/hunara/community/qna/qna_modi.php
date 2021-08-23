<? include("../../inc/header.php"); ?>
<?php 
	if(!$gconnet) {
		die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
	}
	if(isset($_POST['submit'])) {
		$pwd = $_POST['pwd'];
		$idx = $_POST['idx'];
		$funct = $_POST['funct'];
		$tableName = $_POST['tableName'];

		$pwdsql = "select pwd from ".$tableName." where idx='".$idx."'";
		
		$getPwd = mysqli_query($gconnet,$pwdsql);
		$actualPwd = mysqli_fetch_array($getPwd);

		if($pwd == $actualPwd['pwd']) {
			if($funct == "1") {
				$checkUpload = mysqli_query($gconnet, "SELECT b_file1 FROM " .$tableName. " WHERE idx = '" .$idx. "'");
				$result = mysqli_fetch_array($checkUpload);
				if($result['b_file1'] === null) {
					$sql = 'DELETE FROM ' .$tableName. ' WHERE idx ="' .$idx. '"';
					$removeIt = mysqli_query($gconnet, $sql);
					echo "<script>alert('게시글이 삭제되었습니다.'); window.location.href ='qna.php'; </script>";
					exit();
				} else {
					$fileDestination = "../../upload_file/qa/" . $result['b_file1'];
					unlink($fileDestination);
					$sql = 'DELETE FROM ' .$tableName. ' WHERE idx ="' .$idx. '"';
					$removeIt = mysqli_query($gconnet, $sql);
					echo "<script>alert('이미지 게시글이 삭제되었습니다.'); window.location.href ='qna.php'; </script>";
					exit();
				}
			} else {
				$sql = 'SELECT idx, title, name, content, b_file1, ori_name, email FROM '.$tableName.' WHERE idx = "'.$idx.'"';
				$result = mysqli_query($gconnet, $sql);
				$contents = mysqli_fetch_array($result);
				?>
<link rel="stylesheet" href="../../css/community_write.css">
<body>
    <header></header>
    <div id="mainImage">
        <h2>Q&A</h2>
    </div>
    <div id="container">
		<div class="sort-wrap">
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
		</div>
        <div id="newContent">
            <form action="qna_modi_back.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th><label for="text_name">성명</label></th>
                        <td><input type="text" class="content" id="text_name" name="name" value="<?=$contents['name']?>" HNAME="성명" REQUIRED MAXBYTE="50" ></td>
                    </tr>
                    <tr>
                        <th><label for="text_email">이메일</label></th>
                        <td><input type="email" class="content" id="text_email" name="email" value="<?=$contents['email']?>" HNAME="이메일" REQUIRED MAXBYTE="50" ></td>
                    </tr>
                    <tr>
                        <th><label for="text_title">제목</label></th>
                        <td><input type="text" class="content" id="text_title" name="title" value="<?=$contents['title']?>" HNAME="제목" REQUIRED MAXBYTE="200"></td>
                    </tr>
                    <tr>
                        <th><p><label for="text_content">내용</label></p></th>
                        <td><textarea class="content" id="text_content" name="content"><?php echo nl2br($contents['content']);?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="text_pw">파일첨부</label></th>
                        <td>
                        	<div class="file-input">
								<input type="file" maxlength="10" message="기타 첨부자료" name="file" id="file">
								<span class="button">파일선택</span>
								<span class="label" data-js-label="">미선택 시 기존 파일 유지</span>
							</div>
                            <div>
                                <input type="checkbox" data-check-pattern="[name^='remove']" value="Y" name="remove" id="remove" style="width:10px; height:10px;" checked>
								<label for="remove" style="width:10px; height:10px;">파일 변경없이 등록</label>
                            </div>
                   		</td>
                    </tr>
                    
                </table>
               	<div class="button-wrap">
					<button type="button" onclick="window.history.back()">취소</button>
					<input type="text" hidden name="idx" value="<?=$idx?>">
					<input type="text" hidden name="tableName" value="<?=$tableName?>">
					<button type="submit" name="submit">확인</button>
               	</div>
            </form>
        </div>
    </div>
    <footer></footer>
    
    
	<!--  파일업로드  -->
    <script>
		
		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.html

			var inputs = document.querySelectorAll('.file-input')

			for (var i = 0, len = inputs.length; i < len; i++) {
			customInput(inputs[i])
			}

			function customInput (el) {
				const fileInput = el.querySelector('[type="file"]')
				const label = el.querySelector('[data-js-label]')

				fileInput.onchange =
				fileInput.onmouseout = function () {
					if (!fileInput.value) return

					var value = fileInput.value.replace(/^.*[\\\/]/, '')
					el.className += ' -chosen'
					label.innerText = value
				}
			}
		});
	</script>
</body>
</html>
				<?php
			}
		} else {
			echo "<script>alert('비밀번호가 틀립니다.'); window.history.back(); </script>";
			exit();
		}
		
	} else {
		echo "<script>alert('비정상적인 접근!'); window.history.back(); </script>";
		exit();
	}
?>
