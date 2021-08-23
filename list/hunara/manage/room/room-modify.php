<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/room.css">
<link rel="stylesheet" type="text/css" href="/dropzone-5.7.0/dist/dropzone.css" />
<link rel="stylesheet" type="text/css" href="/dropzone-5.7.0/dist/basic.css" />
<script src="/dropzone-5.7.0/dist/dropzone_ie.js" ></script>
<?
    $idx     = trim(sqlfilter($_REQUEST['idx']));

	$sql = " SELECT ";
	$sql .= " 	idx, comname, pwd, post, addr1, addr2, tel, homepage,  con1, con2, con3, con4, con5, thum_img, contact_file  ";
	$sql .= " FROM tb_hu    ";
	$sql .= " WHERE idx = '{$idx}'   ";

	$rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs);


?>

<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents room-modi">
    <? 
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/room/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>휴양소 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>상세</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="room-new_modify_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">    
					<div class="pview-c">
						<table>
							<tr class="name">
								<th>
									<span>휴양소명</span>
								</th>
								<td>
                                    <input type="hidden" name="idx" value="<?=$idx?>" >
									<input type="text" disabled placeholder="<?=$row['comname']?>">
								</td>
							</tr>
							<tr class="name">
								<th>
									<span>비밀번호</span>
								</th>
								<td>
									<input type="password" name="pwd"  value="<?=$row['pwd']?>" required="yes" message="비밀번호">
								</td>
							</tr>                            
							<tr class="address">
								<th>
									<span>주소</span>
								</th>
								<td>
									<input type="text" name="post" id="sample6_postcode" placeholder="우편번호" value="<?=$row['post']?>" >
									<input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
									<div class="bar"></div>
									<input type="text" name="addr1" id="sample6_address" placeholder="주소" value="<?=$row['addr1']?>" >
									<input type="text" name="addr2" id="sample6_detailAddress" placeholder="상세주소" value="<?=$row['addr2']?>" >
                                    <input type="text" id="sample6_extraAddress" placeholder="읍·면·동">
								</td>
							</tr>
							<tr class="phone">
								<th>
									<span>연락처</span>
								</th>
								<td>
                                <div class="cc-c">
                                        <?
                                            $tel = explode("-", $row['tel']);
                                        ?>
										<input maxlength="4" name="tel1" type="text" value="<?=$tel[0]?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
										<span class="hypen">-</span>
										<input maxlength="4" name="tel2" type="text" value="<?=$tel[1]?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
										<span class="hypen">-</span>
										<input maxlength="4" name="tel3" type="text" value="<?=$tel[2]?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
								</td>
							</tr>
							<tr class="name">
								<th>
									<span>홈페이지</span>
								</th>
								<td>
                                    <input type="text" name="homepage" placeholder="홈페이지" value="<?=$row['homepage']?>">
								</td>
							</tr>
							<tr class="type">
								<th>
									<span>객실 타입</span>
								</th>
								<td>
                                    <div class="room-twrap">
                                        <?
                                            $sql2 = " SELECT ";
                                            $sql2 .= " 	seq, rArea, rType, rCnt, rAvg, rMax, rInfra  ";
                                            $sql2 .= " FROM tb_huType    ";
                                            $sql2 .= " WHERE idx = '{$idx}'   ";

                                            $rs2 = mysqli_query($gconnet, $sql2);
                                            
                                            for ($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                $row2 = mysqli_fetch_array($rs2);
                                        ?>
										<div class="room-type room-type1">
											<button type="button" class="remove-type">삭제</button>
											<span class="rt-wrap">
                                                <input type="hidden" name="rSeq[]" value="<?=$row2['seq']?>" >
												<span class="rt-t">평형&nbsp;:&nbsp;</span>
												<input type="text" name="rarea[]" value="<?=$row2['rArea']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
												<span>평형</span><span class="colon">,</span>
												<span class="rt-t">타입&nbsp;:&nbsp;</span>
												<input type="text" name="rtype[]" value="<?=$row2['rType']?>" ><span class="colon">,</span>
												<span class="rt-t">객실 수&nbsp;:&nbsp;</span>
												<input type="text" name="rcnt[]" value="<?=$row2['rCnt']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">기준&nbsp;:&nbsp;</span>
												<input type="text" name="ravg[]" value="<?=$row2['rAvg']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">최대&nbsp;:&nbsp;</span>
												<input type="text" name="rmax[]" value="<?=$row2['rMax']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><span class="colon">,</span>
												<span class="rt-t">시설&nbsp;:&nbsp;</span>
												<input type="text" name="rinfra[]" value="<?=$row2['rInfra']?>">
											</span>
										</div>
                                        <?
                                            } //end of for i
                                        ?>
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
                                    <?
                                        if(!empty($row['thum_img'])){
                                            echo "<br><br><img src='".$row['thum_img']."' width='120px' > <br>";
                                        }
                                    ?>
                                    <input type="hidden" name="thum_img_old" id="thum_img_old" value="<?=$row['thum_img']?>" >                                      
								</td>
							</tr>
							<tr>
                                <th>
									<span>소개</span>
									<span>(사진 10장 이내)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea name="ir" id="editor" style="height: 124px;"><?=$row['con1']?></textarea>
									</div>
									<div class="file-input">
										<span class="button" onClick="$('#intro').trigger('click');">파일선택</span>
									</div>
                                    <div id="intro" class="dropzone" style="margin-top:10px;"></div>
                                    <div id="intro_files" style="display:none;">
                                        <?
                                            $sql2 = " SELECT file ";
                                            $sql2 .= " FROM tb_huFile    ";
                                            $sql2 .= " WHERE idx = '{$idx}' AND flag = 'intro'  ";
                                            $sql2 .= " ORDER BY seq ";

                                            $rs2 = mysqli_query($gconnet, $sql2);
                                            
                                            for ($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                $row2 = mysqli_fetch_array($rs2);
                                                $fileDir = explode("/", $row2['file']);
                                                $fileName = end($fileDir);

                                                echo "<img id='".$fileName."' src='".$row2['file']."' width='120px' class='intro' >";
                                            }
                                        ?>
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
										<textarea name="ir2" id="editor2" style="height: 124px;"><?=$row['con2']?></textarea>
									</div>
									<div class="file-input">
										<span class="button" onClick="$('#unit').trigger('click');">파일선택</span>
									</div>
                                    <div id="unit" class="dropzone" style="margin-top:10px;"></div> 
                                    <div id="unit_files" style="display:none;">
                                        <?
                                            $sql2 = " SELECT file ";
                                            $sql2 .= " FROM tb_huFile    ";
                                            $sql2 .= " WHERE idx = '{$idx}' AND flag = 'unit'  ";
                                            $sql2 .= " ORDER BY seq ";

                                            $rs2 = mysqli_query($gconnet, $sql2);
                                            
                                            for ($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                $row2 = mysqli_fetch_array($rs2);
                                                $fileDir = explode("/", $row2['file']);
                                                $fileName = end($fileDir);

                                                echo "<img id='".$fileName."' src='".$row2['file']."' width='120px' class='unit' >";
                                            }
                                        ?>
                                    </div>                                    
                                </td>
							</tr>
							<tr>
								<th>
									<span>찾아오는 길</span>
									<!--<span>(사진 1장)</span>-->
								</th>
								<td>
                                <div class="intro-room">
										<textarea name="ir3" id="editor3" style="height: 124px;"><?=$row['con3']?></textarea>
									</div>
                                    <!--<div class="intro-room">
                                        <p>
                                            <input type="text" name="member_address" id="member_address" value="<?=$row[addr1]?>" style="width:50%;" required="yes"  message="기본주소"> <a href="javascript:execDaumPostcode('zip_code1', 'member_address', 'member_address2');" class="btn_green">주소검색</a>
                                            <span class="info">기본주소</span>
                                        </p>-->
                                        <!-- 우편번호 레이어 시작 -->
                                        <!--<div id="post_wrap_zip_code1" style="display:none;border:1px solid;width:100%;height:300px;margin:5px 0;position:relative">
                                            <div><img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1;width:30px;" onclick="foldDaumPostcode('zip_code1')" alt="접기 버튼"></div>
                                        </div>-->
                                        <!-- 우편번호 레이어 종료 -->
                                        <!--<p>
                                            <input type="text" name="member_address2" id="member_address2" value="<?=$row[addr2]?>" style="width:50%;" required="yes"  message="상세주소">
                                            <span class="info">상세주소</span>
                                        </p>
									</div>-->
									<!--<div class="file-input">
										<input type="file" name="contact_file" id="contact_file" accept=".jpg,.jpeg,.png,.gif,.bmp" >
										<span class="button">파일선택</span>
										<span class="label" data-js-label="">선택된 파일 없음</span>
									</div>		
                                    <?
                                        if(!empty($row['contact_file'])){
                                            //echo "<br><br><img src='".$row['contact_file']."' width='120px' style='margin-left:20px;'><br>";
                                        }
                                    ?>
                                    <input type="hidden" name="contact_file_old" id="contact_file_old" value="<?=$row['contact_file']?>" > -->                                     								
								</td>
							</tr>
							<tr>
								<th>
									<span>주변 관광지</span>
									<span>(사진 10장 이내)</span>
								</th>
								<td>
									<div class="intro-room">
										<textarea name="ir4" id="editor4" style="height: 124px;"><?=$row['con4']?></textarea>
									</div>
									<div class="file-input">
										<span class="button" onClick="$('#tour').trigger('click');">파일선택</span>
									</div>
                                    <div id="tour" class="dropzone" style="margin-top:10px;"></div>	
                                    <div id="tour_files" style="display:none;">
                                        <?
                                            $sql2 = " SELECT file ";
                                            $sql2 .= " FROM tb_huFile    ";
                                            $sql2 .= " WHERE idx = '{$idx}' AND flag = 'tour'  ";
                                            $sql2 .= " ORDER BY seq ";

                                            $rs2 = mysqli_query($gconnet, $sql2);
                                            
                                            for ($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                $row2 = mysqli_fetch_array($rs2);
                                                $fileDir = explode("/", $row2['file']);
                                                $fileName = end($fileDir);

                                                echo "<img id='".$fileName."' src='".$row2['file']."' width='120px' class='tour' >";
                                            }
                                        ?>    
                                    </div>                                								
								</td>
							</tr>
						</table>
						<div class="center-btn">
							<div class="btn-wrap">
                            <?
                                if( $_SESSION['MEM_LEVEL'] == "00" ){
                            ?>                                  
								<button type="button" id="btn-upload-file" onclick="go_submit();" >수정</button>
                            <? } ?>
								<button type="button" onClick="go_list();">취소</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--  셀렉트박스	-->
	<script type="text/javascript">
		$(document).ready(function () {
                $('#sample6_extraAddress').hide();
				$('select').wSelect();
			});
	</script>

    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
	<script type="text/javascript">

function execDaumPostcode(zip,ad1,ad2) {
		 var element_wrap = document.getElementById('post_wrap_'+zip+'');
		// 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

				//document.getElementById(''+zip+'').value = data.zonecode;
				//document.getElementById('zip_code2').value = data.postcode2;
				document.getElementById(''+ad1+'').value = fullAddr;
				 document.getElementById(''+ad2+'').focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }

    
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
			//oEditors.getById["ir"].exec("PASTE_HTML", ['로딩이 완료된 후에 본문에 삽입되는 text입니다.']);
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

    function go_list(){
        document.location.href = "/manage/room/room-manage.php";
    }

    </script>


	<!--  주소검색	-->
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
                },
                init: function(file, response) {
                    var myDropzone = this;
                    var mockFiles = [];
                    $("img[class=intro]").each(function(){
                        var mockFile = {
                                id: $(this).attr("id"),
                                name: $(this).attr("id"),
                                kind: 'image',
                                dataUrl: $(this).attr("src"),
                                accepted: true
                        };
                        mockFiles.push(mockFile);
                                    
                    });		        
                    
                    for (i = 0; i < mockFiles.length; i++) {
                        this.emit("addedfile",mockFiles[i]);
                        this.emit('thumbnail', mockFiles[i], mockFiles[i].dataUrl);
                        this.emit("complete", mockFiles[i]);
                        
                        this.files.push(mockFiles[i]);

                        var previewElement = $(this.previewsContainer).children('div:eq('+(i+1)+')');
                        $(previewElement).append("<input type='hidden' name='intro_file[]' value='"+mockFiles[i].dataUrl+"' >");

                    }
                    


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
                },
                init: function() {
                    var myDropzone = this;
                    var mockFiles = [];
                    $("img[class=unit]").each(function(){
                        var mockFile = {
                                id: $(this).attr("id"),
                                name: $(this).attr("id"),
                                kind: 'image',
                                dataUrl: $(this).attr("src"),
                                accepted: true
                        };
                        mockFiles.push(mockFile);


                    });		        
                    
                    for (i = 0; i < mockFiles.length; i++) {
                        this.emit("addedfile",mockFiles[i]);
                        this.emit('thumbnail', mockFiles[i], mockFiles[i].dataUrl);
                        this.emit("complete", mockFiles[i]);
                        
                        this.files.push(mockFiles[i]);

                        var previewElement = $(this.previewsContainer).children('div:eq('+(i+1)+')');
                        $(previewElement).append("<input type='hidden' name='unit_file[]' value='"+mockFiles[i].dataUrl+"' >");

                        
                    }

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
                },
                init: function() {
                    var myDropzone = this;
                    var mockFiles = [];
                    $("img[class=tour]").each(function(){
                        var mockFile = {
                                id: $(this).attr("id"),
                                name: $(this).attr("id"),
                                kind: 'image',
                                dataUrl: $(this).attr("src"),
                                accepted: true
                        };
                        mockFiles.push(mockFile);
                                    
                    });		        
                    
                    for (i = 0; i < mockFiles.length; i++) {
                        this.emit("addedfile",mockFiles[i]);
                        this.emit('thumbnail', mockFiles[i], mockFiles[i].dataUrl);
                        this.emit("complete", mockFiles[i]);
                        
                        this.files.push(mockFiles[i]);

                        var previewElement = $(this.previewsContainer).children('div:eq('+(i+1)+')');
                        $(previewElement).append("<input type='hidden' name='tour_file[]' value='"+mockFiles[i].dataUrl+"' >");
                        
                    }
                }                    
            });


    }); 	        
            
    </script>	    

</body>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</html>