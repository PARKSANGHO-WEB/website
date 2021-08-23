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


$sql = "SELECT *,(select comname from tb_company where idx = cdx) as comname, (select count(ridx) from tb_reInfo where a.cdx = cidx and a.sano = sano) as apply, (select count(regflag) from tb_reInfo where a.cdx = cidx and a.sano = sano and regflag in (5,6)) as winning, (select count(regflag) from tb_reInfo where a.cdx = cidx and a.sano = sano and regflag in (7,8)) as cancel FROM tb_employee a where 1=1 and a.seq = '".$idx."' ";

$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 게시물이 없습니다.');
	location.href =  "company-people.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

?>

<body class="pv-w">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>

	<div class="contents people-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
		<div class="center-con">
			<div class="cc-title">
				<div>기업 사원 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div><?=$row[name]?></div>
			</div>
			<div class="cc-con">
               <form name="frm" action="company-people_modify_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
               <input type="hidden" name="total_param" value="<?=$total_param?>"/>
				<input type="hidden" name="seq" value="<?=$idx?>"/>
					<div class="pview-c">
						<table>
							<tr>
								<th>기업명</th>
								<td><?=$row[comname]?></td>
							</tr>
							<tr>
								<th>등록일</th>
								<td><?=substr($row[wdate],0,11)?></td>
							</tr>
							<tr>
								<th>소속</th>
								<td><input type="text" name="team" value="<?=$row[team]?>"></td>
							</tr>
							<tr>
								<th>직급</th>
								<td><input type="text" name="class" value="<?=$row['class']?>"></td>
							</tr>
							<tr>
								<th>사원명</th>
								<td><input type="text" name="name" value="<?=$row[name]?>"></td>
							</tr>
							<tr>
								<th>사원번호</th>
								<td><input type="text" name="sano" value="<?=$row[sano]?>"  class="only-num"></td>
							</tr>
							<tr>
								<th>가중치</th>
								<td><input type="text" name="weight" value="<?=$row[weight]?>"
								 class="only-num"></td>
							</tr>
							<tr>
								<th>신청횟수</th>
								<td><?=$row[apply]?>회</td>
							</tr>
							<tr>
								<th>당첨횟수</th>
								<td><?=$row[winning]?>회</td>
							</tr>
							<tr>
								<th>취소횟수</th>
								<td><?=$row[cancel]?>회</td>
							</tr>
							<tr>
								<th>비밀번호</th>
								<td><input type="password" name="pwd" value="<?=$row[pwd]?>"></td>
							</tr>
                            <tr  class="reserve-check">
                                <th>
                                    예약제외처리
                                </th>
                                <td>
                                    <label for="yes-num">
                                        <input type="radio" id="exclude" name="exclude" value="Y" <?if($row[exclude] == 'Y'){ ?>checked <? } ?> required="yes" message="예약제외처리">
                                        <span>예</span>
                                    </label>
                                    <label for="no-num">
                                        <input type="radio" id="exclude" name="exclude" value="N" <?if($row[exclude] == 'N'){ ?>checked <? } ?> required="yes" message="예약제외처리">
                                        <span>아니오</span>
                                    </label>
                                </td>
                            </tr>
						</table>
							<div class="center-btn">
								<div class="btn-wrap">
									<button type="button" onclick="go_submit();">수정</button>
									<button type="button" onclick="location.href='./company-people.php'">취소</button>
									<button type="button" onclick="location.href='./company-people_del_action.php?idx=<?=$row[seq]?>'">삭제 </button>
								</div>
							</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	</script>
	<script>
		$('#date-on').Zebra_DatePicker();

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
    <iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</body>
</html>