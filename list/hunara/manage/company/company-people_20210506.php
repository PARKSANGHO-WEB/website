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
	$where .= "and a.cdx = '".$id."'";
}

$pageScale = 10; // 페이지당 20 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY a.wdate desc ";


$query = "select * from tb_employee a where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;
$query_cnt = "select seq from tb_employee a where 1=1 ".$where;

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
                frm.action = "hostpeo_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }
    }
	
//-->
</SCRIPT>

<body class="cp-m">
	<?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents company-peo">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
	
	
		
		<div class="center-con">
			<div class="cc-title">
				<div>기업 사원 관리</div>
			</div>
            <form name="s_mem" id="s_mem" method="post" action="<?php $_SERVER[PHP_SELP] ?>">
			<div class="com-search">
				<div class="com-tab">
                    <select name="id" id="id">
                        <option value="">기업명을 선택하세요.</option>
                        <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                    </select>
					<button type="button" onclick="s_mem.submit();">검색</button>
				</div>
			</div>
            </form>
			<div class="cc-con">
					
						<div class="view-c">
							<div class="btn-wrap">
								<div class="btn-float">
									<button class="add-people" type="button">사원등록</button>
									<button type="button">선택 삭제</button>
									<button type="button" onclick="window.print();">프린트</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<input type="checkbox"id="hostPall" data-check-pattern="[name^='hostpeo']"  name="hostPall" id="hostPall">
									<label for="hostPall">전체선택</label>
								</div>
								<table id="sort-employee">
									<thead>
										<tr>
											<th>선택</th>
											<th class="th-btn"><span>번호</span></th>
											<th class="th-btn"><span>등록일</span></th>
											<th class="th-btn"><span>소속</span></th>
											<th class="th-btn"><span>직급</span></th>
											<th class="th-btn"><span>사원명</span></th>
											<th class="th-btn"><span>사원번호</span></th>
											<th class="th-btn"><span>가중치</span></th>
											<th class="th-btn"><span>신청횟수</span></th>
											<th class="th-btn"><span>당첨횟수</span></th>
											<th class="th-btn"><span>취소횟수</span></th>
											<th><span>비밀번호</span></th>
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
                                            <tr onclick="location.href='./company-people-view?idx=<?=$row[idx]?>'">
                                                <td onclick="event.cancelBubble=true"><input type="checkbox"  id="hostpeo[]" name="hostpeo[]" required="yes"  message="체크" value="<?=$row[idx]?>"></td>
                                                <td><?=$listnum?></td>
                                                <td><?=substr($row[wdate],0,11)?></td>
                                                <td><?=$row[team]?></td>
                                                <td><?=$row['class']?></td>
                                                <td><?=$row[name]?></td>
                                                <td><?=$row[sano]?></td>
                                                <td>가중치</td>
                                                <td>신청횟수</td>
                                                <td>당첨횟수</td>
                                                <td>최고횟수</td>
                                                <td>비밀번호</td>
                                            </tr>
                                        <?}?>
                                        
                                        <input type="hidden" name="pageNo" value="<?=$pageNo?>" />
                                        <input type="hidden" name="total_param" value="<?=$total_param?>"/>
										
									</tbody>
								</table>
								<div class="paging">
                                    <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging.php";?>
                                </div>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
	<div class="add-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>사원등록</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<div class="tab-btn">
					<ul> 
						<li class="active"><a href="javascript:;">개별등록</a></li>
						<li><a href="javascript:;">일괄등록</a></li>
					</ul>
				</div>
				<form name="frm" action="people_one_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
					<div class="tab-wrap">
					<div class="mo-con">
						<div class="indi-wrap">
							<ul>
                                        <select name="id" id="id">
                                            <option value="">기업명을 선택하세요.</option>
                                             <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                                         </select>
								<!--<li>
									<div class="indi-t">등록일</div>
									<div class="indi-c"><input type="text" id="p-date" name="wdate"></div>
								</li>-->
								<li>
									<div class="indi-t">소속</div>
									<div class="indi-c"><input type="text" name="team"></div>
								</li>
								<li>
									<div class="indi-t">직급</div>
									<div class="indi-c"><input type="text" name="class"></div>
								</li>
								<li>
									<div class="indi-t">사원명</div>
									<div class="indi-c"><input type="text" name="name"></div>
								</li>
								<li>
									<div class="indi-t">사원번호</div>
									<div class="indi-c"><input type="text" class="only-num" name="sano"></div>
								</li>
							</ul>
						</div>
                        </form>
                        
						<div class="btn-apply">
							<button type="button" onclick="go_submit();">등록</button>
						</div>
					</div>
					<div class="mo-con">
						<div class="list-wrap">
                        <form enctype="multipart/form-data" name="excel" id="excel" action="excel.php" target="_fra_admin" method="post">
                                <div class="btn-up">
									<!--<label for="">파일올리기</label>-->
									<input type="file" id="excelFile" name="excelFile"/>
								</div>
                                <div class="btn-down">
									<a href="javasctip:;" download>양식 다운로드</a>
								</div>
                        </form>
                        <script>
                            $("#excelFile").change(function(){
                                $("#excel").submit();
                            });

                        </script>
                            <div class="counter-list">
                                <span>총 25건</span>
                            </div>
							<div class="list-table">
								<table id="sortMe">
									<thead>
										<tr>
											<th class="th-btn"><span>번호</span></th>
											<th class="th-btn"><span>등록일</span></th>
											<th class="th-btn"><span>소속</span></th>
											<th class="th-btn"><span>직급</span></th>
											<th class="th-btn"><span>사원명</span></th>
											<th class="th-btn"><span>주민번호 뒤 7자리<br />(이용권번호)</span></th>
											<th class="th-btn"><span>사원번호</span></th>
										</tr>
									</thead>
									<tbody id="test">
										<tr>
											<td>1</td>
											<td>2021.02.03</td>
											<td>퍼블리싱</td>
											<td>주임</td>
											<td>상호우</td>
											<td>1234567</td>
											<td>20200416</td>
										</tr>
										<tr>
											<td>1</td>
											<td>2021.02.03</td>
											<td>퍼블리싱</td>
											<td>주임</td>
											<td>상호우</td>
											<td>1234567</td>
											<td>20200416</td>
										</tr>
										<tr>
											<td>1</td>
											<td>2021.02.03</td>
											<td>퍼블리싱</td>
											<td>주임</td>
											<td>상호우</td>
											<td>1234567</td>
											<td>20200416</td>
										</tr>
										<tr>
											<td>1</td>
											<td>2021.02.03</td>
											<td>퍼블리싱</td>
											<td>주임</td>
											<td>상호우</td>
											<td>1234567</td>
											<td>20200416</td>
										</tr>
										<tr>
											<td>1</td>
											<td>2021.02.03</td>
											<td>퍼블리싱</td>
											<td>주임</td>
											<td>상호우</td>
											<td>1234567</td>
											<td>20200416</td>
										</tr>
									</tbody>
								</table>
								<div class="paging">
										<a class="first"></a>
										<a class="prev"></a>
										<a class="active">1</a>
										<a>2</a>
										<a>3</a>
										<a>4</a>
										<a>5</a>
										<a class="next"></a>
										<a class="last"></a>
								</div>	
								<div class="btn-apply">
									<button type="button">등록</button>
								</div>						
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			
			$('#p-date').Zebra_DatePicker({ });

			$('select').wSelect();
		});

        function go_submit() {
            var check = chkFrm('frm');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                frm.submit();
            } else {
                false;
            }
        }
	</script>
	
</body>
<?php $show_iframe = true; ?>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</php>