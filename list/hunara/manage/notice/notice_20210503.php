<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
/*if(!$_AUTH_LIST){
	error_back("게시판 접근권한이 없습니다.");
	exit;
}*/

$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$bbs_code = trim(sqlfilter($_REQUEST['bbs_code'])); // 게시판 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$id = sqlfilter($_REQUEST['id']);

$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1'])); // 지역 시,도
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2'])); // 지역 구,군
$s_level = sqlfilter($_REQUEST['s_level']); // 회원 계급별 검색
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별 검색

################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_gender='.$s_gender.'&s_level='.$s_level;

if(!$pageNo){
	$pageNo = 1;
}

if ($id){
	$where .= "and a.bkind = '".$id."'";
}

if ($v_sect){
	$where .= "and a.bbs_sect = '".$v_sect."'";
}

if($bbs_code){
	$where .= " and a.bbs_code = '".$bbs_code."' "; // 선택한 게시판에 해당하는 내용만 추출한다
} elseif($s_cate_code) {
	
	$sc_board_sql = "select board_code from board_config where 1=1 and cate1 = '".$s_cate_code."' ";
	$sc_board_query = mysqli_query($gconnet,$sc_board_sql);
	$sc_board_cnt = mysqli_num_rows($sc_board_query);

	for ($sc_board_j=0; $sc_board_j<$sc_board_cnt; $sc_board_j++){
		$sc_board_row = mysqli_fetch_array($sc_board_query);

			if($sc_board_j == $sc_board_cnt-1){
				$sc_board_where .= "'".$sc_board_row['board_code']."'";
			} else {
				$sc_board_where .= "'".$sc_board_row['board_code']."',";
			}

	}

	if($sc_board_cnt > 0){
		$where .= " and a.bbs_code in (".$sc_board_where.") "; // 해당 카테고리로 만들어진 게시판이 있을 경우 카테고리에 해당하는 게시판 코드를 추출하여 in query 로 내용을 추출한다.
	} else {
		$where .= " and a.idx = '0' "; // 해당 카테고리로 만들어진 게시판이 없을 경우 글 리스트를 추출하지 않는다.
	}

}

if($s_sect1){
	$where .= " and a.sido = '".$s_sect1."' ";
}

if($s_sect2){
	$where .= " and a.gugun = '".$s_sect2."' ";
}

if($s_gender){
	$where .= " and a.lang = '".$s_gender."' ";
}

if($s_level){
	$where .= " and b.user_level = '".$s_level."' ";
}

if ($field && $keyword){
	if($field == "all"){
		$where .= "and (a.title like '%".$keyword."%' or a.content like '%".$keyword."%' or a.name like '%".$keyword."%')";
	} else {
		$where .= "and ".$field." like '%".$keyword."%'";
	}
}

$pageScale = 20; // 페이지당 20 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY a.nows desc ";

if($bbs_code == "reviews"){
	$query = "select a.*,b.user_id,b.user_name,b.file_chg from tb_pds a inner join member_info b on a.product_idx=b.idx where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;
	$query_cnt = "select a.idx from tb_pds a inner join member_info b on a.product_idx=b.idx where 1=1 ".$where;
} else {
	$query = "select * from tb_pds a where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;
	$query_cnt = "select idx from tb_pds a where 1=1 ".$where;
}

$result = mysqli_query($gconnet,$query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);

//echo $query;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;

?>


<SCRIPT LANGUAGE="JavaScript">
<!--
	function go_view(no,bcode){
		location.href = "board_view.php?idx="+no+"&bbs_code="+bcode+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&keyword=<?=$keyword?>&s_cate_code=<?=$s_cate_code?>&v_sect=<?=$v_sect?>&s_sect1=<?=$s_sect1?>&s_sect2=<?=$s_sect2?>&s_gender=<?=$s_gender?>&s_level=<?=$s_level?>";
	}
	
	function go_list(){
		location.href = "board_list.php?<?=$total_param?>";
	}

	function go_regist(){
		location.href = "board_write.php?<?=$total_param?>";
	}
	
	function go_search() {
		if(!frm_page.field.value || !frm_page.keyword.value) {
			alert("검색조건 또는 검색어를 입력해 주세요!!") ;
			exit;
		}
		frm_page.submit();
	}

	function cate_sel_1(z){
		var tmp = z.options[z.selectedIndex].value; 
		//alert(tmp);
		_fra_admin.location.href="../partner/cate_select_1.php?cate_code1="+tmp+"&fm=s_mem&fname=s_sect2";
	}

    function go_tot_del() {
        var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }
    }
	
//-->
</SCRIPT>

<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents-notice contents">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/notice/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>공지사항</div>
			</div>
			<div class="cc-con">
            <form name="s_mem" id="s_mem" method="post" action="<?php $_SERVER[PHP_SELP] ?>">
					
					<div class="com-tab">
						<div class="big-wsel">
                            <select name="id" id="id">
                                <option value="">기업명을 선택하세요.</option>
                                <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                            </select>
						</div>
						<div class="small-wsel">
							<select name="field" id="com-small">
								<option value="all" <?=$field=="all"?"selected":""?>>전체</option>
								<option value="a.title" <?=$field=="a.title"?"selected":""?>>제목</option>
								<option value="a.name" <?=$field=="a.name"?"selected":""?>>작성자</option>
								<option value="a.content" <?=$field=="a.content"?"selected":""?>>내용</option>
							</select>
						<input type="text" name="keyword" id="keyword" value="<?=$keyword?>">
						<button type="button" onclick="s_mem.submit();">검색</button>
						</div>
					</div>
            </form>
					<div class="all-c">
						<input type="checkbox" id="hostPall" data-check-pattern="[name^='notice[]']" name="hostPall">
						<label for="hostPall">전체선택</label>
						<button type="button" onclick="go_tot_del();" class="l-btn">선택삭제</button>
						<div class="btn-float">
							<button type="button" onclick="location.href='./notice-write.php'">게시글 작성</button>
						</div>
					</div>
					<table id="notice">
						<thead>
							<tr>
								<th>선택</th>
								<th class="th-btn"><span>번호</span></th>
								<th class="th-btn"><span>제목</span></th>
								<th class="th-btn"><span>작성자</span></th>
								<th class="th-btn"><span>작성일</span></th>
								<th class="th-btn"><span>조회수</span></th>
								<th><span>수정</span></th>
							</tr>
						</thead>
						<tbody>
                        <form method="post" name="frm" id="frm">
                        <?
                        for ($i=0; $i<mysqli_num_rows($result); $i++){
                            $row = mysqli_fetch_array($result);

                            $listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
                            //echo $iTotalSubCnt;
                        ?>
							<tr onclick="location.href='./notice-view.php?idx=<?=$row[idx]?>'">
								<td onclick="event.cancelBubble=true"><input type="checkbox"  id="notice[]" name="notice[]" required="yes"  message="체크" value="<?=$row[idx]?>"></td>
								<td><?=$listnum?></td>
								<td><?=$row[title]?></td>
								<td><?=$row[name]?></td>
								<td><?=substr($row[nows],0,11)?></td>
								<td><?=$row[hit]?></td>
								<td onclick="event.cancelBubble=true"><button type="button" onclick="location.href='./notice-modi.php?idx=<?=$row[idx]?>'">수정</button></td>
							</tr>
						<?}?>
                        <input type="hidden" name="pageNo" value="<?=$pageNo?>" />
                        <input type="hidden" name="total_param" value="<?=$total_param?>"/>
                        </form>
						</tbody>
					</table>

                    <div class="paging">
                        <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging.php";?>
                    </div>
			</div>
		</div>
	</div>
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.php

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
	
	
	
	<!-- 테이블 sort 선언	-->
	
	
	<script>
		$(document).ready(function(){
			
			$('.view-t').on('click',function(){
					if( $(this).parents('.view').hasClass('on') ){
						$(this).parents('.view').removeClass('on');
					}else{
						$('.view').removeClass('on');
						$(this).parents('.view').addClass('on');
					}
				});
		});
	
	</script>
	
</body>
</html>