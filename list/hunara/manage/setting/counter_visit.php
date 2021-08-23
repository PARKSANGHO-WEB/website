<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<link rel="stylesheet" href="/manage/css/setting.css">
<?
$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
$smenu = trim(sqlfilter($_REQUEST['smenu']));

$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

$year = trim(sqlfilter($_REQUEST['year']));
$month = trim(sqlfilter($_REQUEST['month']));
$day = trim(sqlfilter($_REQUEST['day']));

 // 날자 세팅
  if(!$year) $year=date("Y");
  if(!$month) $month=date("m");
  if(!$day) $day=date("d");

  // 사용자 IP 얻어옴
  $user_ip=$_SERVER["REMOTE_ADDR"];
  $referer=$_SERVER["HTTP_REFERER"];

  // 오늘의 날자 구함
  $today=mktime(0,0,0,$month,$day,$year);
  $yesterday=mktime(0,0,0,$month,$day,$year)-3600*24;


  // 이번달의 첫번째 날자 구함
  $month_start=mktime(0,0,0,$month,1,$year);


  // 이번달의 마지막 날자 구함
  $lastdate=01;
  while (checkdate($month,$lastdate,$year)): 
    $lastdate++;  
  endwhile;
  $lastdate=mktime(0,0,0,$month,$lastdate,$year);

  if(!$no)$no=1;

   // 전체
  $total=mysqli_fetch_array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where no=1"));
  $count[total_hit]=$total[0];
  $count[total_view]=$total[1];

  // 오늘 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$today'"));
  $count[today_hit]=$detail[0];
  $count[today_view]=$detail[1];

  // 어제 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday'"));
  $count[yesterday_hit]=$detail[0];
  $count[yesterday_view]=$detail[1];

  // 최고 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select max(unique_counter), max(pageview) from counter_main where no>1"));
  $count[max_hit]=$detail[0];
  $count[max_view]=$detail[1];

  // 최저 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select min(unique_counter), min(pageview) from counter_main where no>1 and date<$today"));
  $count[min_hit]=$detail[0];
  $count[min_view]=$detail[1];
?>
<body>
<div id="wrap" class="skin_type01">
	<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/admin_top.php"; // 상단메뉴?>
	<div class="sub_wrap">
		<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/status_left.php"; // 좌측메뉴?>
		<!-- content 시작 -->
		<div class="container clearfix">
			<div class="content">
				<a href="javascript:location.reload();" class="btn_refresh">새로고침</a>
				<div class="navi">
					<ul class="clearfix">
						<li>HOME</li>
						<li>통계 보기</li>
						<li>접속통계</li>
					</ul>
				</div>
				<div class="list_tit">
					<h3>홈페이지 접속통계</h3>
				</div>
				<!-- 네비게이션 종료 -->
				<div class="list">
				
			
				<div class="write">

					<table>
						<caption></caption>
						<colgroup>
							<col style="width:15%">
							<col style="width:35%">
							<col style="width:15%">
							<col style="width:35%">
						</colgroup>
						<tr>
							<th colspan="4" align="center">전체 접속자수</th>
						</tr>
						<tr>
							<th width="140px">전체 방문자수</th>
							<td colspan="3"><?=$count[total_hit]?> 명</td>
						</tr>
						<tr>
							<th width="140px">전체 페이지뷰</th>
							<td colspan="3"><?=$count[total_view]?> 회</td>
						</tr>
					</table>
                    <br><br><br><br>

					<table class="write" style="margin-top:-20px;">
					<tr>
							<th colspan="4" align="center">오늘 접속자수</th>
						</tr>
					<tr>
						<th width="140px">오늘 방문자수</th>
						<td colspan="3"><?=$count[today_hit]?> 명</td>
					</tr>
					<tr>
						<th width="140px">오늘 페이지뷰</th>
						<td colspan="3"><?=$count[today_view]?> 회</td>
					</tr>
					</table>
                    <br><br><br><br>

					<table class="write" style="margin-top:-20px;">
					<tr>
							<th colspan="4" align="center">어제 접속자수</th>
						</tr>
					<tr>
						<th width="140px">어제 방문자수</th>
						<td colspan="3"><?=$count[yesterday_hit]?> 명</td>
					</tr>
					<tr>
						<th width="140px">어제 페이지뷰</th>
						<td colspan="3"><?=$count[yesterday_view]?> 회</td>
					</tr>
					</table>
                    <br><br><br><br>

					<table class="write" style="margin-top:-20px;">
					<tr>
							<th colspan="4" align="center">최고 접속자수</th>
						</tr>
					<tr>
						<th width="140px">최고 방문자수</th>
						<td colspan="3"><?=$count[max_hit]?> 명</td>
					</tr>
					<tr>
						<th width="140px">최고 페이지뷰</th>
						<td colspan="3"><?=$count[max_view]?> 회</td>
					</tr>
					</table>
                    <br><br><br><br>

					<table class="write" style="margin-top:-20px;">
					<tr>
							<th colspan="4" align="center">최저 접속자수</th>
						</tr>
					<tr>
						<th width="140px">최저 방문자수</th>
						<td colspan="3"><?=$count[min_hit]?> 명</td>
					</tr>
					<tr>
						<th width="140px">최저 페이지뷰</th>
						<td colspan="3"><?=$count[min_view]?> 회</td>
					</tr>
					</table>
                    <br><br><br><br>

				</div>
			</div>
		</div>
		<!-- content 종료 -->
	</div>
</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>
