<? include("../../inc/header.php"); ?>
<link rel="stylesheet" href="../../css/community_write.css">
<link rel="stylesheet" href="../../css/wSelect.css">
</head> 
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
        <div id="newContent">
            <form name="frm" action="review_write_back.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th><label for="text_name">성명</label></th>
                        <td><input type="text" class="content" id="text_name" name="name" HNAME="성명" value="<?=$_SESSION['EMP_NM']?>" REQUIRED MAXBYTE="50" readonly></td>
                    </tr>
                    <tr>
                        <th><label for="text_email">이메일</label></th>
                        <td><input type="email" class="content" id="text_email" name="email" HNAME="이메일" value="<?=$_SESSION['EMP_EMAIL']?>" REQUIRED MAXBYTE="50" readonly></td>
                    </tr>
                    <tr>
                        <th><label for="text_title">제목</label></th>
                        <td><input type="text" class="content" id="text_title" name="title" HNAME="제목" REQUIRED MAXBYTE="200"></td>
                    </tr>
                    <tr>
                        <th><p><label for="text_content">내용</label></p></th>
                        <td><textarea class="content" id="text_content" name="content"></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="text_pw">파일첨부</label></th>
                        <td>
                        	<div class="file-input">
								<input type="file" maxlength="10" message="기타 첨부자료" name="file" id="b_file1">
								<span class="button">파일선택</span>
								<span class="label" data-js-label="">선택된 파일 없음</span>
							</div>
                            <div>
                                <input type="checkbox" data-check-pattern="[name^='remove']" value="Y" name="remove" id="remove" style="width:10px; height:10px;">
								<label for="remove" style="width:10px; height:10px;">파일 제거후 등록</label>
                            </div>
                   		</td>
                    </tr>
                    <tr>
                        <th><label for="text_pw">비밀번호</label></th>
                        <td><input type="password" class="content" id="text_pw" name="pwd" HNAME="비밀번호" REQUIRED ></td>
                    </tr>
                    
                </table>
               	<div class="button-wrap">
					<button type="button" onclick="window.history.back()">취소</button>
					<button type="button" onClick="save();">확인</button>
               	</div>
            </form>
        </div>
    </div>
    <footer></footer>
    
	<!--   파일업로드   -->
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



        function save(){

            if (validate(document.frm)) {
                document.frm.submit();
            }         

        }

	</script>
</body>
</html>
