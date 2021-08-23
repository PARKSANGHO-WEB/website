<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
/*if(!$_AUTH_VIEW){
	error_back("본문보기 권한이 없습니다.");
	exit;
}*/

$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$bbs_code = sqlfilter($_REQUEST['bbs_code']);
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별 검색
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&s_gender='.$s_gender.'&pageNo='.$pageNo;


	$sql = "SELECT * FROM tb_company a where 1=1 and a.idx = '".$idx."' ";

$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 게시물이 없습니다.');
	location.href =  "company.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

$tel = explode('-',$row[tel]);
$tel1 = $tel[0];
$tel2 = $tel[1];
$tel3 = $tel[2];


$hp = explode('-',$row[hp]);
$hp1 = $hp[0];
$hp2 = $hp[1];
$hp3 = $hp[2];

$email = explode('@',$row[email]);
$email1 = $email[0];
$email2 = $email[1];

$query_cnt = "select seq from tb_employee a where 1=1 and a.cdx = '".$idx."' ";

$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);


$query_cnt2 = "select a.midx from tb_comhuMtype a, tb_comhuM b where 1=1 and a.midx = b.midx and b.cidx = '".$idx."' and b.del_yn = 'N' ";

$result_cnt2 = mysqli_query($gconnet,$query_cnt2);
$num2 = mysqli_num_rows($result_cnt2);

?>
<!-- content -->
<script type="text/javascript">

function go_view(no){
		location.href = "notice-view.php?idx="+no+"&<?=$total_param?>";
}
function go_list(no){
		location.href = "company.php";
}

function go_modify(no){
		location.href = "board_modify.php?idx="+no+"&<?=$total_param?>";
}

function go_reply(no){
		location.href = "board_reply.php?idx="+no+"&<?=$total_param?>";
}

function go_delete(no){

	if(confirm('삭제하신 데이터는 영구 삭제 됩니다. 삭제 하시겠습니까?')){	
		_fra_admin.location.href = "company_delete_action.php?idx=<?=$idx?>";
	}

}

</script>

<script>
 
$(document).ready(function () {

    getList();
	getList2();

});

function getList(){

    $("#list").jqGrid({
		url: "company-people-data.php?cdx=<?=$row[idx]?>",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "기업명", "직급", "사원명", "주민번호 뒤 7자리<br>(이용권번호)", "사원번호","가중치","신청횟수","당첨횟수","취소횟수","비밀번호"],
		colModel: [ 
			{ name: "idx",label:"id", sortable:true, align:"center", formatter:checkBox, width:30},
			{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'integer', width:75},
            { name: "comname",label:"기업명", sortable:true, align:"center"},
            { name: "class",label:"직급", sortable:true, align:"center", width: 90},
            { name: "name",label:"사원명", sortable:true, align:"center", width: 90},
			{ name: "digit7",label:"주민번호 뒤 7자리(이용권번호)", sortable:true, align:"center", width: 130},
			{ name: "sano",label:"사원번호", sortable:true, align:"center", width: 75},
            { name: "weight",label:"가중치", sortable:true, align:"center", width: 75},
            { name: "apply",label:"신청횟수", sortable:true, align:"center", width: 75},
			{ name: "winning",label:"당첨횟수", sortable:true, align:"center", width: 75},
            { name: "cancel",label:"취소횟수", sortable:true, align:"center", width: 75},
            { name: "pwd",label:"비밀번호", sortable:true, align:"center", width: 75}
			],
		pager: "#pager",
		rowNum: 10,
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

	   		if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn')
   			{
                view(rowId);
   			}

	   	},
        loadComplete:function(data){   
        },	
		caption: ""

	});     


}
function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='hostpeo[]' name='hostpeo[]' required='yes'  message='체크' value='"+idx+"'";
        
        return str;
}

function view(idx){
    
    document.location.href = "company-people-view.php?idx="+idx;
}

function go_tot_del() {

        let result = '';
        $('input[name="hostpeo[]"]:checked').each(function(){
            result += $(this).val() + ',';
        });        
        
        // 출력
        if(result){
            location.href='./company-people_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }
    }




function getList2(){

    $("#list2").jqGrid({
        
        url: "company-hu-data.php?cdx=<?=$row[idx]?>",
        datatype: "json",
        mtype: "post",
        colNames: [ "선택", "번호", "등록일", "휴양소명", "구분", "배정방식", "예약", "기간", "연락처", "기업부담금", "개인부담금"],
        colModel: [
            { name: "idx",label:"id", sortable:true, align:"center", formatter:checkBox2, width:30},
            { name: "no",label:"번호", sortable:true, align:"center", sorttype:'number', width:75},
            { name: "wdate",label:"등록일", sortable:true, align:"center", sorttype:'date', width: 75},
            { name: "comname",label:"휴양소명", sortable:true, align:"center", width: 180},
            { name: "flag",label:"구분", sortable:true, align:"center", width: 75},
            { name: "type",label:"배정방식", sortable:true, align:"center", width: 75},
            { name: "rev_yn",label:"예약", sortable:true, align:"center", width: 75},
            { name: "udate",label:"기간", sortable:true, align:"center", width: 150},
            { name: "tel",label:"연락처", sortable:true, align:"center", width: 150},
            { name: "com_amount",label:"기업부담금", sortable:true, align:"right", width: 80},
            { name: "per_amount",label:"개인부담금", sortable:true, align:"right", width: 80}
            ],
        pager: "#pager2",
        rowNum: 10,
        sortname: "comname",
        sortorder: "asc",
        height: 'auto',
        viewrecords: true,
        gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
            var cellNm = $(this).jqGrid('getGridParam', 'colModel');

            if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn')
            {
                view2(rowId);
            }

        },
        loadComplete:function(data){   
        },	
        caption: ""

    });     

}

function checkBox2(cellvalue, options, rowObject){
	var idx = cellvalue;
	var str = "<input type='checkbox' id='hu[]' name='hu[]' required='yes'  message='체크' value='"+idx+"'";
	
	return str;
}


function view2(idx){

document.location.href = "company-room-view.php?midx="+idx;
}

function go_tot_del() {


    let result = '';
    $('input[name="hu[]"]:checked').each(function(){
        result += $(this).val() + ',';
    });    
	
	// 출력
	if(result){
		location.href='./company-hu_list_del_action.php?idx='+result.slice(0,-1)+'';
		console.log(result.slice(0,-1));
	}
}

</script>

<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents company-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>기업관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div><?=$row[comname]?></div>
			</div>
			<div class="cc-con">
				<form name="frm" action="company_modify_action.php" method="post" targer="_fra_admin" enctype="multipart/form-data">
				<input type="hidden" name="idx" value="<?=$idx?>">
					<div class="view view-1 on">
						<div class="view-t active">기업정보</div>
						<div class="view-c">
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button" onclick="go_submit()">수정</button>
									<!--<button type="button" onclick="window.print();">프린트</button>-->
								</div>
							</div>
							<div class="view-mody">
								<table>
									<tr class="domain">
										<th>
											도메인
										</th>
										<td>
											<span>http://</span><input type="text" value="<?=$row[cdomain]?>" name="domain" required="yes" message="도메인"><span>.hunara.com</span>
										</td>
									</tr>
                                    <?
                                    for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){
                                        $file_k = $file_i+1;
                                    ?>
									<tr>
										<th>
											기업로고
										</th>
										<td>
											<div class="file-input">
												<input type="file" maxlength="10" required="no" message="기타 첨부자료" name="file_<?=$file_i?>" id="file_<?=$file_i?>">
												<span class="button">파일선택</span>
												<span class="label" data-js-label=""><?=$row[comimg]?></span>
											</div>
										</td>
									</tr>
                                    <?php } ?>
									<tr class="company">
										<th>
											기업명
										</th>
										<td>
											<input type="text" name="company" required="yes" message="기업명" value="<?=$row[comname]?>">
										</td>
									</tr>
									<tr  class="pass">
										<th>
											패스워드
										</th>
										<td>
											<input type="password" name="password" required="yes" message="비밀번호" value="<?=$row[co_password]?>">
										</td>
									</tr>
									<tr class="peo-name">
										<th>
											담당자명
										</th>
										<td>
											<input type="text" name="name" required="yes" message="담당자명" value="<?=$row[dname]?>">
										</td>
									</tr>
									<tr class="number">
										<th>
											연락처
										</th>
										<td>
											<input class="only-num" type="text" value="<?=$tel1?>" name="tel1" required="yes" message="연락처1">
											<span class="hypen">-</span>
											<input class="only-num" type="text" value="<?=$tel2?>"  class="only-num" name="tel2" required="yes" message="연락처2">
											<span class="hypen">-</span>
											<input type="text" class="only-num" value="<?=$tel3?>" name="tel3" required="yes" message="연락처3">
										</td>
									</tr>
									<tr class="phone">
										<th>
											핸드폰
										</th>
										<td>
											<input maxlength="4" type="text" value="<?=$hp1?>" class="only-num"  name="phone1" required="yes" message="핸드폰1">
											<span class="hypen">-</span>
											<input maxlength="4" type="text" value="<?=$hp2?>"  class="only-num"  name="phone2" required="yes" message="핸드폰2">
											<span class="hypen">-</span>
											<input maxlength="4" type="text" value="<?=$hp3?>"  class="only-num"  name="phone3" required="yes" message="핸드폰3">
										</td>
									</tr>
									<tr class="mail">
										<th>
											이메일
										</th>
										<td>
											<input type="text" value="<?=$email1?>" name="email1" required="yes" message="이메일1">
											<span class="gol">@</span>
											<input type="text" value="<?=$email2?>" name="email2" required="yes" message="이메일2">
										</td>
									</tr>
									<tr class="limit">
										<th>
											개인별 당첨 가능 횟수
										</th>
										<td>
											<input type="text" class="only-num" value="<?=$row[able_dangchum_cnt]?>" name="winning" required="yes" message="당첨 가능 횟수">
										</td>
									</tr>
									<tr  class="reserve-check">
										<th>
											예약 시 주민번호 체크
										</th>
										<td>
											<label for="yes-num">
												<input type="radio" id="yes-num" name="membernum" <?php echo $row[chk_jumin] == 1 ? 'checked' : '' ?> required="yes" message="주민번호" value="1">
												<span>예</span>
											</label>
											<label for="no-num">
												<input type="radio" id="no-num" name="membernum" <?php echo $row[chk_jumin] == 0 ? 'checked' : '' ?> required="yes" message="주민번호" value="0">
												<span>아니오</span>
											</label>
										</td>
									</tr>
                                    <tr  class="reserve-check">
										<th>
											기업내 모든휴양소 예약가능여부
										</th>
										<td>
											<label for="yes-num">
												<input type="radio" id="reservation" name="reservation" <?php echo $row[reservation] == 'Y' ? 'checked' : '' ?> required="yes" message="예약가능여부" value="Y">
												<span>예약가능</span>
											</label>
											<label for="no-num">
												<input type="radio" id="reservation" name="reservation" <?php echo $row[reservation] == 'N' ? 'checked' : '' ?> required="yes" message="예약가능여부" value="N">
												<span>예약불가</span>
											</label>
										</td>
									</tr>
                                    <tr  class="reserve-check">
										<th>
											자동취소/승인취소 여부
										</th>
										<td>
											<label for="yes-num">
												<input type="radio" id="cancel" name="cancel" <?php echo $row[cancel] == 'Y' ? 'checked' : '' ?> required="yes" message="취소여부" value="Y">
												<span>자동취소</span>
											</label>
											<label for="no-num">
												<input type="radio" id="cancel" name="cancel" <?php echo $row[cancel] == 'N' ? 'checked' : '' ?> required="yes" message="취소여부" value="N">
												<span>승인취소</span>
											</label>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
                    </form>
					<div class="view view-2">
						<div class="view-t">등록 휴양소 <span class="view-n">(<?=$num2?>)</span></div>
						<div class="view-c">
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button">선택 삭제</button>
									<button type="button" onclick="exportExcel('list2');">프린트</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
								<input type="checkbox"id="hu" data-check-pattern="[name^='hu']"  name="hu">
									<label for="hu">전체선택</label>
								</div>
                                <table id="list2"></table>
								<div id="pager2"></div>                                
							</div>
						</div>
					</div>
					<div class="view view-3">
						<div class="view-t">등록 사원 <span class="view-n">(<?=$num?>)</span></div>
						
						<div class="view-c">
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button">선택 삭제</button>
									<button type="button" onclick="exportExcel('list');">프린트</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<input type="checkbox"id="hostPall" data-check-pattern="[name^='hostpeo']"  name="hostPall" id="hostPall">
									<label for="hostPall">전체선택</label>
								</div>
                                <table id="list"></table>
								<div id="pager"></div>                                
							</div>
						</div>
					</div>
					<div class="view-btn">
						<button type="button" onclick="go_submit();">저장</button>
						<button type="button" onclick="go_list();">취소</button>
						<button type="button" onclick="go_delete();">삭제</button>
					</div>
				
			</div>
		</div>
	</div>
	<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>

	
	<script type="text/javascript">
		function go_submit() {
			var check = chkFrm('frm');
			if(check) {
				//oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
				frm.submit();
			} else {
				false;
			}
		}
		$(document).ready(function(){

			/*$('.lm-big').click(function(){
  
			  $(this).toggleClass('active');
			  $('.lm-big').not(this).removeClass('active');

			});*/

            $('select').wSelect();
		});
		
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