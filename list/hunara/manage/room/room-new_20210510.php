<? include("../inc/header.php"); ?>

<link rel="stylesheet" href="/manage/css/room.css">

<!--팝업 오픈-->
 <script language="javascript">
  	function roomPopup() { 
			window.open("company-room-pop.html", "a", "width=900, height=800, left=100, top=50"); 
		}
 </script>
<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents Room-new">
    <? 
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/room/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>신규 휴양소 등록</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="room-new_write_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
					<div class="pview-c">
						<table>
							<tr class="name">
								<th>
									<span>휴양소 명</span>
								</th>
								<td>
									<input type="text" id="member_id" name="comname"><button class="com-mo" type="button" onclick="ch_hu();">중복확인</button>
                                    <div id="check_id" style="paddig-top:10px;"></div>
								</td>
							</tr>
							<tr class="address">
								<th>
									<span>주소</span>
								</th>
								<td>
									<input type="text" name="post" id="sample6_postcode" placeholder="우편번호">
									<input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
									<div class="bar"></div>
									<input type="text" name="addr1" id="sample6_address" placeholder="주소">
									<input type="text" name="addr2" id="sample6_detailAddress" placeholder="상세주소">
                                    <input type="text" id="sample6_extraAddress" placeholder="읍·면·동">
								</td>
							</tr>
							<tr class="phone">
								<th>
									<span>연락처</span>
								</th>
								<td>
									<div class="cc-c">
										<input maxlength="4" name="tel1" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
										<span class="hypen">-</span>
										<input maxlength="4" name="tel2" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
										<span class="hypen">-</span>
										<input maxlength="4" name="tel3" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<span>홈페이지</span>
								</th>
								<td>
                                   <input type="text" name="homepage" placeholder="홈페이지">
								</td>
							</tr>
							<tr class="type">
								<th>
									<span>객실 타입</span>
								</th>
								<td>
									<div class="room-twrap">
										<div class="room-type room-type1">
											<button type="button" class="remove-type">삭제</button>
											<span class="rt-wrap">
												<span class="rt-t">평형&nbsp;:&nbsp;</span>
												<input type="text" name="rarea" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
												<span>평형</span><span class="colon">,</span>
												<span class="rt-t">타입&nbsp;:&nbsp;</span>
												<input type="text" name="rtype"><span class="colon">,</span>
												<span class="rt-t">객실 수&nbsp;:&nbsp;</span>
												<input type="text" name="rcnt" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">기준&nbsp;:&nbsp;</span>
												<input type="text" name="ravg" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">최대&nbsp;:&nbsp;</span>
												<input type="text" name="rmax" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">시설&nbsp;:&nbsp;</span>
												<input type="text" name="rinfra">
											</span>
										</div>
									</div>
									<button type="button" class="add-btn">추가<?=$_include_board_file_cnt?></button>
								</td>
							</tr>
                            
                            <?
                                    for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){
                                        $file_k = $file_i+1;
                            ?>
							<tr>
								<th>
									<span>썸네일 사진</span>
								</th>
								<td>
									<div class="file-input">
										<input type="file" maxlength="10" required="no" message="기타 첨부자료" name="file_<?=$file_k?>" id="file_<?=$file_k?>">
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>
								</td>
							</tr>
                            <?}?>
							<tr>
								<th>
									<span>소개</span>
									<span>(사진 10장 이내)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir" id="editor" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<div class="file-input">
										<input type="file" multiple="multiple" maxlength="10" required="no" message="기타 첨부자료" name="file_2[]" id="file_2">
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<span>부대시설</span>
									<span>(사진 10장 이내)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir2" id="editor2" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<div class="dropzone" id="fileDropzone" name="file_3[]" style="width:700px; height:600px;"></div>
								</td>
							</tr>
							<tr>
								<th>
									<span>찾아오는 길</span>
									<span>(사진 1장)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir3" id="editor3" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<div class="file-input">
										<input type="file" maxlength="10" required="no" message="기타 첨부자료" name="file_4" id="file_4">
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<span>주변 관광지</span>
									<span>(사진 1장)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir4" id="editor4" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<div class="file-input">
										<input type="file" maxlength="10" required="no" message="기타 첨부자료" name="file_5" id="file_5">
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>
								</td>
							</tr>
						</table>
						<div class="center-btn">
							<div class="btn-wrap">
								<button type="button" id="btn-upload-file" onclick="go_submit();">등록</button>
								<!--<button type="button">취소</button>-->
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<script src="/dropzone-5.7.0/dist/dropzone.js"></script>
    <link rel="stylesheet" href="/dropzone-5.7.0/dist/dropzone.css">
    <script> //fileDropzone dropzone 설정할 태그의 id로 지정 
    Dropzone.options.fileDropzone = { url: 'room-new_write_action.php', //업로드할 url (ex)컨트롤러) 
        init: function () { 
            /* 최초 dropzone 설정시 init을 통해 호출 */ 
            var submitButton = document.querySelector("#btn-upload-file"); 
            var myDropzone = this; //closure 
            submitButton.addEventListener("click", function () { 
                console.log("업로드"); //tell Dropzone to process all queued files 
                myDropzone.processQueue();
            }); 
        }, 
        autoProcessQueue: false, // 자동업로드 여부 (true일 경우, 바로 업로드 되어지며, false일 경우, 서버에는 올라가지 않은 상태임 processQueue() 호출시 올라간다.) 
        
        clickable: true, // 클릭가능여부 
        thumbnailHeight: 100, // Upload icon size 
        thumbnailWidth: 100, // Upload icon size 
        maxFiles: 10, // 업로드 파일수 
        maxFilesize: 20, // 최대업로드용량 : 10MB 
        parallelUploads: 10, // 동시파일업로드 수(이걸 지정한 수 만큼 여러파일을 한번에 컨트롤러에 넘긴다.) 
        addRemoveLinks: true, // 삭제버튼 표시 여부 
        dictRemoveFile: '삭제', // 삭제버튼 표시 텍스트 
        uploadMultiple: false, // 다중업로드 기능 
    }; 
    </script>

	
	<!--  셀렉트박스  -->
    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
	<script type="text/javascript">
    var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "editor",
		sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
				//alert("아싸!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
    var oEditors2 = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors2,
		elPlaceHolder: "editor2",
		sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
				//alert("아싸!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
    var oEditors3 = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors3,
		elPlaceHolder: "editor3",
		sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
				//alert("아싸!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
    var oEditors4 = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors4,
		elPlaceHolder: "editor4",
		sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
				//alert("아싸!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

		$(document).ready(function () {
				$('#sample6_extraAddress').hide();
				$('select').wSelect();
			});

    function ch_hu(){  
        var chkid = $("#member_id").val();
        var vurl = "/pro_inc/check_hu_duple.php";
        $.ajax({
            url		: vurl,
            type	: "GET",
            data	: { idx:"", user_id:$("#member_id").val() },
            async	: false,
            dataType	: "json",
            success		: function(v){
                if ( v.success == "true" ){
                    $("#id_ok").val("Y");
                    $("#check_id").html( v.msg );
                } else if ( v.success == "false" ){
                    $("#id_ok").val("N");
                    $("#check_id").html( v.msg );
                } else {
                    alert( "오류 발생!" );
                }
            }
        });
    }

    function go_submit() {
        var frm = document.frm;
		var check = chkFrm('frm');
		if(check) {
			oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors2.getById["editor2"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors3.getById["editor3"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors4.getById["editor4"].exec("UPDATE_CONTENTS_FIELD", []);
            frm.submit();
		} else {
			false;
		}
	}
	</script>
    
	
	


	<!-- 주소검색 -->

	<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script>
		function sample6_execDaumPostcode() {
			new daum.Postcode({
				oncomplete: function(data) {
					// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

					// 각 주소의 노출 규칙에 따라 주소를 조합한다.
					// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
					var addr = ''; // 주소 변수
					var extraAddr = ''; // 참고항목 변수

					//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
					if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
						addr = data.roadAddress;
					} else { // 사용자가 지번 주소를 선택했을 경우(J)
						addr = data.jibunAddress;
					}

					// 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
					if(data.userSelectedType === 'R'){
						// 법정동명이 있을 경우 추가한다. (법정리는 제외)
						// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
						if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
							extraAddr += data.bname;
						}
						// 건물명이 있고, 공동주택일 경우 추가한다.
						if(data.buildingName !== '' && data.apartment === 'Y'){
							extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
						}
						// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
						if(extraAddr !== ''){
							extraAddr = ' (' + extraAddr + ')';
						}
						// 조합된 참고항목을 해당 필드에 넣는다.
						document.getElementById("sample6_extraAddress").value = extraAddr;

					} else {
						document.getElementById("sample6_extraAddress").value = '';
					}

					// 우편번호와 주소 정보를 해당 필드에 넣는다.
					document.getElementById('sample6_postcode').value = data.zonecode;
					document.getElementById("sample6_address").value = addr;
					// 커서를 상세주소 필드로 이동한다.
					document.getElementById("sample6_detailAddress").focus();
				}
			}).open();
		}

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
<?php $show_iframe=TRUE ?>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</html>