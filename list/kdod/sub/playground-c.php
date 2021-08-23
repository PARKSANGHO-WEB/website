<? include "../include/header_sub.php"?>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
     <? include "../include/gnb_sub1.php"?> 
    
    <section class="play-g">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">&gt;</li>
                        <li>
                            <a href="./k-dod-play-meme.php">K-DOD Playground</a>
                        </li>
                        <li class="arrow">&gt;</li>
                        <li>
                            <a href="./play-list.php">PLAYGROUND</a>
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
                        <a href="./k-dod-play-meme.php">K-DOD MEME?</a>
                    </li>
                    <li class="active">
                        <a href="./play-list.php">PLAYGROUND</a>
                    </li>
                </ul>
            </div>
        </div>

<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$bbs_code = sqlfilter($_REQUEST['bbs_code']);
$bbs_sect2 = sqlfilter($_REQUEST['bbs_sect2']);
$total_param =  'pageNo='.$pageNo.'&bbs_code='.$bbs_code.'&bbs_sect2='.$bbs_sect2;
if($bbs_sect2){
	$where .= "and a.bbs_sect2='".$bbs_sect2."'";
}
$sql = "SELECT * FROM board_content a where 1=1 and a.idx = '".$idx."' and a.bbs_code='".$bbs_code."'".$where;
$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('There is no corresponding article.');
	location.href =  "play-list.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

$wdate=date_create($row[write_time]);
$wdate_str=date_format($wdate,'Y-m-d');
?>
        <div class="play-cont">
            <div class="title">
                <?=$row[subject]?>
            </div>

			<?if($row['bbs_tag']){?>
			<div class="sub-title" style="text-align:center;">
				<iframe src="https://www.youtube.com/embed/<?=str_replace("https://youtu.be/","",$row['bbs_tag'])?>" frameborder="0" width="100%" height="400" allowfullscreen></iframe>
			</div>
			<?}?>
<!--
            <div class="sub-title">
                <p>작성자 : <?=$row[user_id]?></p>
                <p>날짜 : <?=$wdate_str?></p>
            </div>
-->
		<?
			$content = stripslashes($row[content]);
			$content = str_replace('target="_self"','target="_blank"',$content);
			//$content = str_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1</a>", $content);
			$content = str_replace('<a href=','<a target="_blank" href=',$content);
		?>
            
			<div class="main">
				
                <!-- <div class="main-img"><img src="../img/sub/main.png" alt=""></div>
                <div class="main-txt">원하는글을 여기에 적으면 됩니다~
                    진행 중인 서베이와 진행 종료된 서베이 리스트를 확인하세요. 
                    현재 진행중인 서베이를 확인하신 후 참여하시면, 포인트와 (추첨) 경품을 받으실 수 있습니다. 
                    1) 패널 멤버는 로그인하신 후 참여할 수 있습니다
                    2) 패널이 아닌 경우 회원 가입 후 참여할 수 있습니다</div> -->
					<?=$content?>
			</div>
		  <div class="return">
        	<button type="button" onclick="javascript:location.href='play-list.php?<?=$total_param?>';">List</button>
        </div>
        </div>
    </section>

<? include "../include/footer_sub.php"?>