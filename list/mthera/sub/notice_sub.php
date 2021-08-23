<? include "../inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<?
$bbs_code=trim(sqlfilter($_REQUEST['bbs_code']));
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
################## 파라미터 조합 #####################
$total_param = 'field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&pageNo='.$pageNo;

$member_idx = $_SESSION['member_char_idx'];

$check_pass = trim(sqlfilter($_REQUEST['check_pass']));

$sql = "SELECT * FROM board_content where 1=1 and idx = '".$idx."' and bbs_code='".$bbs_code."'";
$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
	error_go("해당하는 글 내용이 없습니다.","notice.php?".$total_param."");
}

$row = mysqli_fetch_array($query);

/*if($row['member_idx'] && $row['member_idx'] == $_SESSION['member_bisut_idx']){ // 본인이 쓴 글일때 
} else { // 본인이 쓴 글이 아닐때 
	$passwd = $row['passwd'];
	$passwd = trim($passwd);

	if($check_pass == $passwd){
	} else {
		error_go("비밀번호가 맞지 않습니다","myask_list.php?".$total_param."");
	}
} // 본인이 쓴 글이 아닐때 종료 */

################## 조회수 관리 시작 ############################

if($_SESSION['member_bisut_idx'] == $row['member_idx']){ 
} else {  // 작성자 본인이 열람하는것이 아닐때 시작
		
	$sql_prev = "select idx from board_view_cnt where 1=1 and board_tbname='board_content' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' and member_idx = '".$_SESSION['member_bisut_idx']."' ";
	$query_prev = mysqli_query($gconnet,$sql_prev);
	$cnt_prev = mysqli_num_rows($query_prev);

	//if($cnt_prev == 0){ // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 시작 
			
			$query_view_cnt = " insert into board_view_cnt set "; 
			$query_view_cnt .= " board_tbname = 'board_content', ";
			$query_view_cnt .= " board_code = '".$row['bbs_code']."', ";
			$query_view_cnt .= " board_idx = '".$row['idx']."', ";
			$query_view_cnt .= " member_idx = '".$_SESSION['member_bisut_idx']."', ";
			$query_view_cnt .= " cnt = '1', ";
			$query_view_cnt .= " wdate = now() ";
			$result_view_cnt = mysqli_query($gconnet,$query_view_cnt);

			$sql_cnt = "update board_content set cnt=cnt+1 where 1=1 and idx = '".$row['idx']."'";
			$query_cnt = mysqli_query($gconnet,$sql_cnt);
	
	//} // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 종료 

}  // 작성자 본인이 열람하는것이 아닐때 종료

$current_cnt_query = "select sum(cnt) as current_cnt from board_view_cnt where 1=1 and board_tbname='board_content' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' ";
$current_cnt_result = mysqli_query($gconnet,$current_cnt_query);
$current_cnt_row = mysqli_fetch_array($current_cnt_result);
if ($current_cnt_row['current_cnt']){
	$current_cnt = $current_cnt_row['current_cnt'];
} else{
	$current_cnt = 1;
} 

################## 조회수 관리 종료 ############################


if($s_cate_code) {
	$sql_sub1 = "select cate_name1 from board_cate where cate_code1='".$s_cate_code."' and cate_level='1' ";
	$query_sub1 = mysqli_query($gconnet,$sql_sub1);
	$row_sub1 = mysqli_fetch_array($query_sub1);
	$bbs_cate_name = $row_sub1['cate_name1'];
}

$content = stripslashes($row[content]);
$content = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$content);
$content = preg_replace("/ style=([^\"\']+) /"," ",$content); 
$content = str_replace("<img","<img style='max-width:90%;'",$content);
?>
<body>
    <? include "../inc/gnb.php"; ?>
    <section class="nub">
        <div class="nub_ban">
            <h1>공지사항</h1>
        </div>
        <div class="nub_ct">
            <div class="nub_top">
                <div class="nub_tw">
                    <div class="nub_tl">
                        <span class="tl_img"><img src="/img/main/mb_circle.png" alt=""></span>
                        <span class="tl_t">공지사항</span>
                    </div>
                    <div class="nub_tr">
                        <span>HOME</span>&nbsp;<span>></span>&nbsp;
                        <span>공지사항</span>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="nub_c">
           <form action="#">
                <div class="nub_title">
                    <div class="nt_wrap">
                        <h1><?=stripslashes($row[subject])?></h1>
                    </div>
                    <div class="nub_npw">
                        <div class="nub_people">
                            <span>작성자</span>
                            <span class="nub_peo"><?=$row[writer]?></span>
                        </div>
                        <div class="nub_date">
                            <span>날짜</span>
                            <span class="nub_day"><?=$row[write_time]?></span>
                        </div>
                    </div>
                </div>
                <div name="notice_t" id="notice_t">
                    <?=$content?>
                </div>
            </form>
            <div class="back">
                <a href="javascript:go_list();">목록보기</a>
            </div>
        </div>
    </section>
 
	<script>
		function go_list(){
			location.href = "notice.php?<?=$total_param?>&pageNo=<?=$pageNo?>";
		}
    </script>

   <? include "../inc/footer.php"; ?>
</body>
</html>