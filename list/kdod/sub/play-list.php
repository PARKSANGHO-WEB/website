<? include "../include/header_sub.php"?>
	<link rel="stylesheet" href="../css/slick-pg.css">
	<link rel="stylesheet" href="../css/sub.css">
	<script src="../js/slick-pg.js"></script>
<body>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
     <? include "../include/gnb_sub1.php"?> 

    
    <section class="play-list">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">&gt;</li>
                        <li>
                            <a href="k-dod-play-meme.php">K-DOD Playground</a>
                        </li>
                        <li class="arrow">&gt;</li>
                        <li>
                            <a href="play-list.php">PLAYGROUND</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                   <span class="ban-title">CULTURAL PLAYGROUND</span>
                   <span class="ban-text">This is your <strong>playground</strong> for sharing, learning and having fun with others</span>
                </div>
            </div>
        </div>



        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li >
                        <a href="k-dod-play-meme.php">K-DOD MEME</a>
                    </li>
                    <li class="active">
                        <a href="play-list.php">PLAYGROUND</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ing-list">
			<div class="ing-title">
			 <p>진행중인 놀이터</p>
			 <h2>현재 진행중인 놀이터를 확인하시고, 여러분들의 생각, 심볼, 스타일, 이미지나 동영상 등을 통해 참여해 보세요!<br>
				이 곳 홈페이지나 케이닷 페이스북 페이지를 통해서도 참여하실 수 있습니다.</h2>
			</div>
			<div class="ing-slider">
				<div class="autoplay">
					<?
					$query2 = "select * from board_content  where bbs_code='data_list3' and bbs_sect2='진행중인 놀이터' order by write_time desc";
					$result2 = mysqli_query($gconnet,$query2);
					for ($i=0; $i<mysqli_num_rows($result2); $i++){
					$row2 = mysqli_fetch_array($result2);
					$sql_file2 = "select file_org,file_chg from board_file where 1=1 and board_tbname='board_content' and board_code = '".$row2['bbs_code']."' and board_idx='".$row2['idx']."' order by idx asc limit 0,1";
					$query_file2 = mysqli_query($gconnet,$sql_file2);
					$row_file2 = mysqli_fetch_array($query_file2);
					?>
					<div class="slider-box" onclick="javascript:go_view('<?=$row2[idx]?>','<?=$row2['bbs_code']?>');">
						<div class="ing-img"><img src="<?=$_P_DIR_WEB_FILE?>data_list3/img_thumb/<?=$row_file2['file_chg']?>"></div>
						<div class="ing-txt"><?=nl2br($row2[subject])?></div>
						<div class="ing-date">
							<p class="date"><?=$row2[bbs_sect2]?></p>
							<p><?=substr($row2[write_time],0,10)?></p>
						</div>
					</div>
					<?
					}
					?>
					<!-- <div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li01.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li02.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li01.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li02.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li01.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li02.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li01.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li02.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li01.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div>
					<div class="slider-box">
						<div class="ing-img"><img src="../img/sub/li02.png" alt=""></div>
						<div class="ing-txt">제목제 타이틀입니다. 제목입니다. 타이틀 입니다.</div>
						<div class="ing-writer">작성자 : dflsfsdf123</div>
						<div class="ing-date">
							<p class="date">진행중인 놀이터</p>
							<p>2021-02-02</p>
						</div>
					</div> -->
				</div>
			</div>
			<script>
			$(document).ready(function(){
				$('.autoplay').slick({
					slidesToShow: 4,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 4000,
					responsive: [ 
					{ 
						breakpoint: 1300, //화면 사이즈 768px
						settings: {	
							//위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
							slidesToShow:3 
						} 
					},
					{ 
						breakpoint: 900, //화면 사이즈 768px
						settings: {	
							//위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
							slidesToShow: 2 
						} 
					},
					{ 
						breakpoint: 640, //화면 사이즈 768px
						settings: {	
							//위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
							slidesToShow: 1 
						} 
					}
				]

				});
			});

			</script>
         
        </div>
<?
$bbs_code = 'data_list3';
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$bbs_sect2 = sqlfilter($_REQUEST['bbs_sect2']);
$total_param = 'bbs_code='.$bbs_code;

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
		location.href = "playground-c.php?idx="+no+"&bbs_code="+bcode+"&pageNo=<?=$pageNo?>&field=<?=$field?>&keyword=<?=$keyword?>";
}

function go_list(){
		location.href = "play-list.php?<?=$total_param?>";
}
function go_list2(bbs_sect2){
		location.href = "play-list.php?<?=$total_param?>&bbs_sect2="+bbs_sect2;
}
</script>
        <div class="all-list">
<!--
            <ul class="play-set">
                <li class="<?if($bbs_sect2=='')echo 'active';?>" onclick="javascript:go_list();">전체 놀이터</li>
                <li class="<?if($bbs_sect2=='진행중인 놀이터')echo 'active';?>" onclick="javascript:go_list2('진행중인 놀이터');">진행중인 놀이터</li>
                <li class="<?if($bbs_sect2=='종료된 놀이터')echo 'active';?>" onclick="javascript:go_list2('종료된 놀이터');">종료된 놀이터</li>
            </ul>
-->
			<div class="ing-title">
			 <p>종료된 놀이터</p>
			</div>
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
                 <div class="all-date">
                     <p class="date"><?=$row[bbs_sect2]?></p>
                     <p><?=substr($row[write_time],0,10)?></p>
                    </div>
                </li>

			<?
				}
			?> 
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
               <!--  <a href="javascript:;">
                    <img class="two" src="../img/b-all.png" alt="">
                </a>
                <a href="javascript:;">
                    <img class="one" src="../img/b-al.png" alt="">
                </a>
                <a href="javascript:;">
                    1
                </a>
                <a href="javascript:;">
                    <img class="one" src="../img/b-ar.png" alt="">
                </a>
                <a href="javascript:;">
                    <img class="two" src="../img/b-arr.png" alt="">
                </a> -->
				<?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front2.php";?>
            </span>
        </div>
        </div>
    </section>
    <? include "../include/footer_sub.php"?>