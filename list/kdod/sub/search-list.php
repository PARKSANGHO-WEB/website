<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/slick-pg.css">
    <link rel="stylesheet" href="../css/modal-b.css">
    <meta charset="UTF-8">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/slick-pg.js"></script>
	<script src="../js/common.js"></script>
</head>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
     <? include "../include/gnb_sub1.php"?> 
    <section class="seal">
<?
$bbs_code = 'data_list3';
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$bbs_sect2 = sqlfilter($_REQUEST['bbs_sect2']);
$total_param = 'bbs_code='.$bbs_code;
$search = sqlfilter($_REQUEST['search']);

if(!$pageNo){
	$pageNo = 1;
}

if ($v_sect){
	$where .= "and a.bbs_sect = '".$v_sect."'";
}

if($bbs_sect2){
	$where .= "and a.bbs_sect2='".$bbs_sect2."'";
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

$search = sqlfilter($_REQUEST['search']);
if($search){
	$where .= "and (subject like '%".$search."%' or content like '%".$search."%' or bbs_sect2 like '%".$search."%' )";
}

$pageScale = 20; // 페이지당 20 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY a.write_time desc";


$query = "select * from board_content a where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;
$query_cnt = "select idx from board_content a where 1=1 ".$where;


$result = mysqli_query($gconnet,$query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);

//echo $num;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;

if($s_cate_code) {
	$sql_sub1 = "select cate_name1 from board_cate where cate_code1='".$s_cate_code."' and cate_level='1' ";
	$query_sub1 = mysqli_query($gconnet,$sql_sub1);
	$row_sub1 = mysqli_fetch_array($query_sub1);
	$bbs_cate_name = $row_sub1['cate_name1'];
}

if($bbs_code){
	$bbs_str = $_include_board_board_title;
} elseif($s_cate_code) {
	$bbs_str = $bbs_cate_name." 카테고리에 해당하는 ";
}

?>
<script>

function go_view(no,bcode){
		location.href = "playground-c.php?idx="+no+"&bbs_code="+bcode+"&pageNo=<?=$pageNo?>&field=<?=$field?>&search=<?=search?>";
}
</script> 		
		<div class="searl-title">
			<p>"<span><?=$search?></span>"에 대한 검색결과입니다.</p>
		</div>
        <div class="result-list">
            <ul class="all-content">
                
			<?
			for ($i=0; $i<mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_array($result);

			$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
			$sql_file = "select file_org,file_chg from board_file where 1=1 and board_tbname='board_content' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' order by idx asc limit 0,1";
			$query_file = mysqli_query($gconnet,$sql_file);
			$row_file = mysqli_fetch_array($query_file);
			?>	
				
				<li onclick="javascript:go_view('<?=$row[idx]?>','<?=$row['bbs_code']?>');">
                    <div class="all-img"><img src="<?=$_P_DIR_WEB_FILE?><?=$bbs_code?>/img_thumb/<?=$row_file['file_chg']?>"></div>
                 <div class="all-txt"><?=nl2br($row[subject])?></div>
                 <div class="all-writer">작성자 : <?=$row[user_id]?></div>
                 <div class="all-date">
                     <p class="date"><?=$row[bbs_sect2]?></p>
                     <p><?=substr($row[write_time],0,10)?></p>
                    </div>
                </li>
			<?}?>
				
				
				<!-- <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date">
                     <p class="date">진행중인 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date">
                     <p class="date">진행중인 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date">
                     <p class="date">진행중인 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date">
                     <p class="date">진행중인 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date en">
                     <p class="date">종료된 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date en">
                     <p class="date">종료된 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date en">
                     <p class="date">종료된 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li>
                <li>
                    <div class="all-img"><img src="../img/sub/li03.png" alt=""></div>
                 <div class="all-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
                 <div class="all-writer">작성자 : dflsfsdf123</div>
                 <div class="all-date en">
                     <p class="date">종료된 놀이터</p>
                     <p>2021-02-02</p>
                    </div>
                </li> -->
            </ul>
            <div class="paging">
            <span class="paging-wrap">
				<?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front2.php";?>
            </span>
        </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){           
            
            
            $('.visual-slider').bxSlider({
              auto: true,
              pager: true,
              mode: 'fade',
              hideControlOnEnd:true
            });
            
            $('.cont1-slider').bxSlider({
              auto: true,
              pager: true,
              hideControlOnEnd:true
            });
        });
        
        
        $(document).ready(function(){    
        var tabBtn = $("#tab-btn > ul > li");     //각각의 버튼을 변수에 저장
        var tabCont = $("#tab-cont > div");       //각각의 콘텐츠를 변수에 저장

        //컨텐츠 내용을 숨겨주세요!
        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
          var target = $(this);         //버튼의 타겟(순서)을 변수에 저장
          var index = target.index();   //버튼의 순서를 변수에 저장
          //alert(index);
          tabBtn.removeClass("active");    //버튼의 클래스를 삭제
          target.addClass("active");    //타겟의 클래스를 추가
          tabCont.css("display","none");
          tabCont.eq(index).css("display", "block");
        });
        
        
        });
    </script>
	
<? include "../include/footer_sub.php"?>
</body>
</html>