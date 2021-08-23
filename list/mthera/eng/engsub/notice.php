<? include "../inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<?
$bbs_code=trim(sqlfilter($_REQUEST['bbs_code']));
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

################## 파라미터 조합 #####################
$total_param = 'field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code;

$member_idx = $_SESSION['member_char_idx'];

if(!$pageNo){
	$pageNo = 1;
}

$where = " and lang='eng'";

if ($v_sect){
	$where .= "and bbs_sect = '".$v_sect."'";
}

$where .= "and p_no = 0 ";

if($bbs_code){
	$where .= " and bbs_code = '".$bbs_code."' "; // 선택한 게시판에 해당하는 내용만 추출한다
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
		$where .= " and bbs_code in (".$sc_board_where.") "; // 해당 카테고리로 만들어진 게시판이 있을 경우 카테고리에 해당하는 게시판 코드를 추출하여 in query 로 내용을 추출한다.
	} else {
		$where .= " and idx = '0' "; // 해당 카테고리로 만들어진 게시판이 없을 경우 글 리스트를 추출하지 않는다.
	}

}

if ($field && $keyword){
	if($field == "subtent"){
		$where .= "and (subject like '%".$keyword."%' or content like '%".$keyword."%')";
	} else {
		$where .= "and ".$field." like '%".$keyword."%'";
	}
}

$pageScale = 10; // 페이지당 10 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY ref desc, step asc, depth asc ";

$query = "select * from board_content where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;

//echo "<br><br>쿼리 = ".$query."<br><Br>";

$result = mysqli_query($gconnet,$query);

$query_cnt = "select idx from board_content where 1=1 ".$where;
$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);

//echo $num;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;
?>
<body>
    <? include "../inc/gnb.php"; ?>
    <section class="notice">
        <div class="notice_ban">
            <h1>Notice</h1>
        </div>
        <div class="notice_ct">
            <div class="notice_top">
                <div class="notice_tw">
                    <div class="notice_tl">
                        <span class="tl_img"><img src="../..//img/main/mb_circle.png" alt=""></span>
                        <span class="tl_t">Notice</span>
                    </div>
                    <div class="notice_tr">
                        <span>HOME</span>&nbsp;<span>></span>&nbsp;
                        <span>Notice</span>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="notice_c">
           <form action="#">
                <table>
                    <tr>
                        <th style="width: 80px;">No.</th>
                        <th>Title</th>
                        <th style="width: 150px;">Write</th>
                        <th style="width: 150px;">Date</th>
                    </tr>
			<?
		for ($i=0; $i<mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_array($result);

			$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
			$reg_time3 = to_time(substr($row[write_time],0,10));
				
			$current_cnt_query = "select sum(cnt) as current_cnt from board_view_cnt where 1=1 and board_tbname='board_content' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' ";
			$current_cnt_result = mysqli_query($gconnet,$current_cnt_query);
			$current_cnt_row = mysqli_fetch_array($current_cnt_result);
			if ($current_cnt_row['current_cnt']){
				$current_cnt = $current_cnt_row['current_cnt'];
			} else{
				$current_cnt = 1;
			}

			$sql_file = "select file_org,file_chg from board_file where 1=1 and board_tbname='board_content' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' order by idx asc limit 0,1";
			//echo $sql_file;
			$query_file = mysqli_query($gconnet,$sql_file);
			$row_file = mysqli_fetch_array($query_file);
	?>
                    <tr class="title">
                        <td style="border-left:none;"><p><?=$listnum?></p></td>
                        <td style="text-align:left; padding-left:40px;" onclick="javascript:go_view('<?=$row[idx]?>');"><a><?=string_cut2(stripslashes($row[subject]),150)?> <?=now_date($reg_time3)?></a></td>
                        <td><?=$row[writer]?></td>
                        <td style="border-right:none;"><?=substr($row[write_time],0,10)?></td>
                    </tr>
			<?}?>
               </table>
                <div class="page_wrap">
                  <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front.php";?>
                </div>
            </form>
        </div>
    </section>
   
<script type="text/javascript">
function go_view(no){
	location.href = "notice_sub.php?idx="+no+"&<?=$total_param?>&pageNo=<?=$pageNo?>";
}
</script>

   <? include "../inc/footer.php"; ?>
</body>
</html>