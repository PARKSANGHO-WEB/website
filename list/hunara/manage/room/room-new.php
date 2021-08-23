<? include("../inc/header.php"); ?>

<link rel="stylesheet" href="/manage/css/room.css">
<link rel="stylesheet" type="text/css" href="/dropzone-5.7.0/dist/dropzone.css" />
<link rel="stylesheet" type="text/css" href="/dropzone-5.7.0/dist/basic.css" />

<script src="/dropzone-5.7.0/dist/dropzone_ie.js" ></script>

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
                <input type="hidden" id="id_ok">
				<input type="hidden" id="test">
				<input type="hidden" id="test2">
					<div class="pview-c">
						<table>
							<tr class="name">
								<th>
									<span>휴양소 명</span>
								</th>
								<td>
									<input type="text" id="member_id" name="comname" required="yes" message="휴양소명" ><button class="com-mo" type="button" onclick="ch_hu();" >중복확인</button>
                                    <div id="check_id" style="paddig-top:10px;"></div>
								</td>
							</tr>
							<tr class="name">
								<th>
									<span>비밀번호</span>
								</th>
								<td>
									<input type="text" id="pwd" name="pwd" >
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
							<tr class="name">
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
												<input type="text" name="rarea[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
												<span>평형</span><span class="colon">,</span>
												<span class="rt-t">타입&nbsp;:&nbsp;</span>
												<input type="text" name="rtype[]"><span class="colon">,</span>
												<span class="rt-t">객실 수&nbsp;:&nbsp;</span>
												<input type="text" name="rcnt[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">기준&nbsp;:&nbsp;</span>
												<input type="text" name="ravg[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">최대&nbsp;:&nbsp;</span>
												<input type="text" name="rmax[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">시설&nbsp;:&nbsp;</span>
												<input type="text" name="rinfra[]">
											</span>
										</div>
									</div>
									<button type="button" class="add-btn">추가<?=$_include_board_file_cnt?></button>
								</td>
							</tr>

							<tr>
								<th>
									<span>썸네일 사진</span>
								</th>
								<td>
									<div class="file-input">
										<input type="file" name="thum_img" id="thum_img" accept=".jpg,.jpeg,.png,.gif,.bmp" >
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>									
								</td>
							</tr>
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
										<span class="button" onClick="$('#intro').trigger('click');">파일선택</span>
                                        <span class="label" data-js-label="">(사진 10장 이내)</span>
									</div>
                                    <div id="intro" class="dropzone" style="margin-top:10px;"></div>
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
									<div class="file-input">
										<span class="button" onClick="$('#unit').trigger('click');">파일선택</span>
                                        <span class="label" data-js-label="">(사진 10장 이내)</span>
									</div>
                                    <div id="unit" class="dropzone" style="margin-top:10px;"></div> 
                                </td>
							</tr>
							<tr>
								<th>
									<span>찾아오는 길</span>
									<!--<span>(사진 1장)</span>-->
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir3" id="editor3" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<!--<div class="file-input">
										<input type="file" name="contact_file" id="contact_file" accept=".jpg,.jpeg,.png,.gif,.bmp" >
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>-->										
								</td>
							</tr>
							<tr>
								<th>
									<span>주변 관광지</span>
									<span>(사진 10장 이내)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea class="autosize" name="ir4" id="editor4" placeholder="2인 조식 제공, 실내 수영장 무료피트니스 무료" style="height: 124px;"></textarea>
									</div>
									<div class="file-input">
										<span class="button" onClick="$('#tour').trigger('click');">파일선택</span>
                                        <span class="label" data-js-label="">(사진 10장 이내)</span>
									</div>
                                    <div id="tour" class="dropzone" style="margin-top:10px;"></div>									
								</td>
							</tr>
						</table>
						<div class="center-btn">
							<div class="btn-wrap">
								<button type="button" id="btn-upload-file" onclick="go_submit();">등록</button>
								<button type="button" onClick="document.location.reload();" >취소</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
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

    var result = false;
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
                    result = true;
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

        var flag = $("#id_ok").val();

        if(flag == 'N'){
            alert('휴양소명 중복확인 하시기 바랍니다.');
            return;
        }

        var frm = document.frm;
		var check = chkFrm('frm');

		if(check && confirm('등록 하시겠습니까')) {
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

				try{

					fileInput.onchange = function () {
						if (!fileInput.value) return

						var value = fileInput.value.replace(/^.*[\\\/]/, '')
						el.className += ' -chosen'
						label.innerText = value
					}

				}catch(error){
				}
			}

		});
	</script>

    <!-- 이미지 업로드 -->
    <script type="text/javascript">
        
        Dropzone.autoDiscover = false;

        var mockFiles = new Array(); 
        var sum_upload_size = 0;
        var max_upload_size = 10485760; //10MB

        $(document).ready(function() {
            
        //파일 업로드
            var myDropzone = new Dropzone("#intro", {
                url: "/manage/room/file-upload.php?flag=intro",
                autoProcessQueue: true,
                uploadMultiple: false, // uplaod files in a single request
                parallelUploads: 1, // use it with uploadMultiple
                maxFilesize: 10, // MB
                maxFiles: 10,
                acceptedFiles: " .png, .jpg, .gif, .jpeg, .bmp",
                dictFileTooBig: "파일 용량이 너무 큽니다. ({{filesize}}mb). 최대 파일 용량은  {{maxFilesize}}mb 입니다.",
                dictInvalidFileType: "Invalid File Type",
                dictCancelUpload: "Cancel",
                dictRemoveFile: "Remove",
                dictMaxFilesExceeded: "최대 {{maxFiles}}개 사진만 가능합니다.",
                dictDefaultMessage: "마우스 클릭 또는 드래그 하여 사진을 업로드 하세요.<br>(사진 10장 이내)",
                addRemoveLinks: true, 
                dictRemoveFile : "삭제", 
                dictRemoveFileConfirmation: "파일을 삭제하시겠습니까?",
                success: function(file, response){
					$(file.previewElement).append("<input type='hidden' name='intro_file[]' value='"+response+"' >");
                },
                error:function(file, response){
                    alert(response);
                },
                maxfilesexceeded:function(file, response){
                    //file.previewElement.classList.add("dz-maxsize-error");
                    //$(".dz-maxsize-error").empty();
					$(file.previewElement).remove();
                },
                removedfile:function(file, response){
					$(file.previewElement).remove();

                }  
            });
  

            //파일 업로드
            var myDropzone2 = new Dropzone("#unit", {
                url: "/manage/room/file-upload.php?flag=unit",
                autoProcessQueue: true,
                uploadMultiple: false, // uplaod files in a single request
                parallelUploads: 1, // use it with uploadMultiple
                maxFilesize: 10, // MB
                maxFiles: 10,
                acceptedFiles: " .png, .jpg, .gif, .jpeg, .bmp",
                dictFileTooBig: "파일 용량이 너무 큽니다. ({{filesize}}mb). 최대 파일 용량은  {{maxFilesize}}mb 입니다.",
                dictInvalidFileType: "Invalid File Type",
                dictCancelUpload: "Cancel",
                dictRemoveFile: "Remove",
                dictMaxFilesExceeded: "최대 {{maxFiles}}개 사진만 가능합니다.",
                dictDefaultMessage: "마우스 클릭 또는 드래그 하여 사진을 업로드 하세요.<br>(사진 10장 이내)",
                
                addRemoveLinks: true, 
                dictRemoveFile : "삭제", 
                dictRemoveFileConfirmation: "파일을 삭제하시겠습니까?",  
                success: function(file, response){
					$(file.previewElement).append("<input type='hidden' name='unit_file[]' value='"+response+"' >");
                },
                error:function(file, response){
                    alert(response);
                    
                },
                maxfilesexceeded:function(file, response){
                    $(file.previewElement).remove();
                },
                removedfile:function(file, response){
                    $(file.previewElement).remove();
                }                  
            });

            var myDropzone3 = new Dropzone("#tour", {
                url: "/manage/room/file-upload.php?flag=tour",
                autoProcessQueue: true,
                uploadMultiple: false, // uplaod files in a single request
                parallelUploads: 1, // use it with uploadMultiple
                maxFilesize: 10, // MB
                maxFiles: 10,
                acceptedFiles: " .png, .jpg, .gif, .jpeg, .bmp",
                dictFileTooBig: "파일 용량이 너무 큽니다. ({{filesize}}mb). 최대 파일 용량은  {{maxFilesize}}mb 입니다.",
                dictInvalidFileType: "Invalid File Type",
                dictCancelUpload: "Cancel",
                dictRemoveFile: "Remove",
                dictMaxFilesExceeded: "최대 {{maxFiles}}개 사진만 가능합니다.",
                dictDefaultMessage: "마우스 클릭 또는 드래그 하여 사진을 업로드 하세요.<br>(사진 10장 이내)",
                addRemoveLinks: true, 
                dictRemoveFile : "삭제", 
                dictRemoveFileConfirmation: "파일을 삭제하시겠습니까?",
                success: function(file, response){
					$(file.previewElement).append("<input type='hidden' name='tour_file[]' value='"+response+"' >");
                },
                error:function(file, response){
                    alert(response);
                    
                },
                maxfilesexceeded:function(file, response){
                    $(file.previewElement).remove();
                },
                removedfile:function(file, response){
                    $(file.previewElement).remove();
                }  
            });
 
    }); 	        
            
    </script>	
</body>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</html>