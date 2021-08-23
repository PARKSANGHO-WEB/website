<? include("./inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/home.css">
<link rel="stylesheet" href="/manage/css/highcharts.css">
<script src="/manage/js/highcharts.js"></script>

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>

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
  $dtoday = date('Y-m-d', $today);
  // -1일
  $yesterday=mktime(0,0,0,$month,$day,$year)-3600*24;
  $dyesterday = date('Y-m-d', $yesterday);
  //-2일
  $yesterday2=mktime(0,0,0,$month,$day,$year)-3600*48;
  $dyesterday2 = date('Y-m-d', $yesterday2);
  //-3일
  $yesterday3=mktime(0,0,0,$month,$day,$year)-3600*72;
  $dyesterday3 = date('Y-m-d', $yesterday3);
  //-4일
  $yesterday4=mktime(0,0,0,$month,$day,$year)-3600*96;
  $dyesterday4 = date('Y-m-d', $yesterday4);
  //-5일
  $yesterday5=mktime(0,0,0,$month,$day,$year)-3600*120;
  $dyesterday5 = date('Y-m-d', $yesterday5);
  //-6일
  $yesterday6=mktime(0,0,0,$month,$day,$year)-3600*144;
  $dyesterday6 = date('Y-m-d', $yesterday6);

  $week_start_day=$day;
 while(date('l',mktime(0,0,0,$month,$week_start_day,$year))!='Sunday')
 {
  $week_start_day--;
 }
 $week_last_day=$day;
 while(date('l',mktime(0,0,0,$month,$week_last_day,$year))!='Saturday')
 {
  $week_last_day++;
 }

 $start_time=mktime(0,0,0,$month,$week_start_day,$year);
 $last_time=mktime(23,59,59,$month,$week_last_day,$year);

//주간
 $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select sum(unique_counter), sum(pageview) from counter_main where date>=$start_time and date<=$last_time"));
 $count[week_hit]=$detail[0];
 $count[week_view]=$detail[1];


//연간
$year_start=mktime(0,0,0,1,1,$year);
$year_end=mktime(0,0,0,12,31,$year);

  // 이번달의 첫번째 날자 구함
  $month_start=mktime(0,0,0,$month,1,$year);

  // 이번달의 마지막 날자 구함
  $lastdate=01;
  while (checkdate($month,$lastdate,$year)): 
    $lastdate++;  
  endwhile;
  $lastdate=mktime(0,0,0,$month,$lastdate,$year);

  //echo date('Y-m-d',$start_time);
  if(!$no)$no=1;

   // 전체
  $total=mysqli_fetch_array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where no=1"));
  $count[total_hit]=$total[0];
  $count[total_view]=$total[1];

    // 연간 카운터 읽어오는 부분
    $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select sum(unique_counter), sum(pageview) from counter_main where date>= $year_start and date<=$year_end"));
    $count[year_hit]=$detail[0];
    $count[year_view]=$detail[1];

  // 한달 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select sum(unique_counter), sum(pageview) from counter_main where date between '$month_start' and '$lastdate'"));
  $count[month_hit]=$detail[0];
  $count[month_view]=$detail[1];

  // 오늘 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$today'"));
  $count[today_hit]=$detail[0];
  $count[today_view]=$detail[1];
  if(!$count[today_view]){
    $count[today_view] = 0;
  }

  // 어제 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday'"));
  $count[yesterday_hit]=$detail[0];
  $count[yesterday_view]=$detail[1];

  if(!$count[yesterday_view]){
    $count[yesterday_view] = 0;
  }

    // -2
    $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday2'"));
    $count[yesterday_hit2]=$detail[0];
    $count[yesterday_view2]=$detail[1];

    if(!$count[yesterday_view2]){
        $count[yesterday_view2] = 0;
      }

      // -3
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday3'"));
  $count[yesterday_hit3]=$detail[0];
  $count[yesterday_view3]=$detail[1];

  if(!$count[yesterday_view3]){
    $count[yesterday_view3] = 0;
  }

    // -4
    $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday4'"));
    $count[yesterday_hit4]=$detail[0];
    $count[yesterday_view4]=$detail[1];

    if(!$count[yesterday_view4]){
        $count[yesterday_view4] = 0;
      }

      // -5
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday5'"));
  $count[yesterday_hit5]=$detail[0];
  $count[yesterday_view5]=$detail[1];

  if(!$count[yesterday_view5]){
    $count[yesterday_view5] = 0;
  }

    // -6
    $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select unique_counter, pageview from counter_main where date='$yesterday6'"));
    $count[yesterday_hit6]=$detail[0];
    $count[yesterday_view6]=$detail[1];

    if(!$count[yesterday_view6]){
        $count[yesterday_view6] = 0;
      }

  // 최고 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select max(unique_counter), max(pageview) from counter_main where no>1"));
  $count[max_hit]=$detail[0];
  $count[max_view]=$detail[1];

  // 최저 카운터 읽어오는 부분
  $detail=mysqli_fetch_Array(mysqli_query($gconnet,"select min(unique_counter), min(pageview) from counter_main where no>1 and date<$today"));
  $count[min_hit]=$detail[0];
  $count[min_view]=$detail[1];

  //qna
  $order_by = " ORDER BY a.nows desc ";
  $query = "select * from tb_qa a where 1=1 and idx = ref ".$where.$order_by." limit 0 , 5";
  $result = mysqli_query($gconnet,$query);

  //공지
  $query2 = "select * from tb_pds a where 1=1 ".$where.$order_by." limit 0 , 5";
  $result2 = mysqli_query($gconnet,$query2);

  //이용후기
  $query3 = "select * from tb_rv a where 1=1 ".$where.$order_by." limit 0 , 5";
  $result3 = mysqli_query($gconnet,$query3);
?>

<body>
	<div class="root-wrap">
		<div class="root">
			<ul>
				<li>
					<a href="./home.php">Home</a>
				</li>
				<li class="arrow"><img src="./img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./home.php">관리자 메인</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="main1-con">
		<div class="m1c-wrap">
			<div class="cc-title">
				<div>사이트 방문 현황</div>
			</div>
			<div class="contents">
				<div class="visit-w">
					<div id="visit-1"></div>
				</div>
				<div class="itbt-b">
					<ul>
						<li class="circle_bg circle_bg1">
							<div class="circle_g">
							  <div class="single-chart">
								<svg viewBox="0 0 36 36" class="circular-chart orange">
								  <path class="circle-bg"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								  <path class="circle"
									stroke-dasharray="20, 100"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								</svg>
								<div class="text-wrap">
									<span class="title">일간</span>
									<span class="t-num" id="num_se"><?=$count[today_view]?></span>
								</div>
							  </div>
							</div>
						</li>
						<li class="circle_bg circle_bg2">
							<div class="circle_g">
							  <div class="single-chart">
								<svg viewBox="0 0 36 36" class="circular-chart green">
								  <path class="circle-bg"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								  <path class="circle"
									stroke-dasharray="20, 100"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								</svg>
								<div class="text-wrap">
								<span class="title">주간</span>
									<span class="t-num" id="num_bub"><?=$count[week_view]?></span>
								</div>
							  </div>
							</div>
						</li>
						<li class="circle_bg circle_bg3">
							<div class="circle_g">
							  <div class="single-chart">
								<svg viewBox="0 0 36 36" class="circular-chart orange">
								  <path class="circle-bg"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								  <path class="circle"
									stroke-dasharray="40, 100"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								</svg>
								<div class="text-wrap">
									<span class="title">월간</span>
									<span class="t-num" id="num_no"><?=$count[month_view]?></span>
								</div>
							  </div>
							</div>
						</li>
						<li class="circle_bg circle_bg4">
							<div class="circle_g">
							  <div class="single-chart">
								<svg viewBox="0 0 36 36" class="circular-chart green">
								  <path class="circle-bg"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								  <path class="circle"
									stroke-dasharray="80, 100"
									d="M18 2.0845
									  a 15.9155 15.9155 0 0 1 0 31.831
									  a 15.9155 15.9155 0 0 1 0 -31.831"
								  />
								</svg>
								<div class="text-wrap">
									<span class="title">연간</span>
									<span class="t-num" id="num_ser"><?=$count[year_view]?></span>
								</div>
							  </div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="main2-con">
		<div class="m1c-wrap">
			<div class="cc-title">
				<div>최근 게시글</div>
			</div>
			<div class="contents">
				<div class="left">
					<div class="top">
						<div class="sc-title">
							Q&amp;A
						</div>
						<table>
							<tbody>
                            <?
                                for ($i=0; $i<mysqli_num_rows($result); $i++){
                                    $row = mysqli_fetch_array($result);

                                ?>
								<tr>
									<td><?=$i +1 ?></td>
									<td><a href="notice/qna-reple.php?idx=<?=$row[idx]?>"><?=$row[title]?></a></td>
									<td><?=substr($row[nows],0,11)?></td>
									<td><?=$row[hit]?></td>
								</tr>
                            <?}?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="center">
					<div class="top">
						<div class="sc-title">
							공지사항
						</div>
						<table>
							<tbody>
                            <?
                                for ($i=0; $i<mysqli_num_rows($result2); $i++){
                                    $row2 = mysqli_fetch_array($result2);

                                ?>
								<tr>
									<td><?=$i +1 ?></td>
									<td><a href="notice/notice-view.php?idx=<?=$row2[idx]?>"><?=$row2[title]?></a></td>
									<td><?=substr($row2[nows],0,11)?></td>
									<td><?=$row2[hit]?></td>
								</tr>
                            <?}?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="right">
					<div class="top">
						<div class="sc-title">
							이용후기
						</div>
						<table>
							<tbody>
                            <?
                                for ($i=0; $i<mysqli_num_rows($result3); $i++){
                                    $row3 = mysqli_fetch_array($result3);

                                ?>
								<tr>
									<td><?=$i +1 ?></td>
									<td><a href="notice/review-view.php?idx=<?=$row3[idx]?>"><?=$row3[title]?></a></td>
									<td><?=substr($row3[nows],0,11)?></td>
									<td><?=$row3[hit]?></td>
								</tr>
                            <?}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			
			Highcharts.chart('visit-1', {
				chart: {
					type: 'column'
				},
					title: {
					text: ''
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: ['<?=$dyesterday6?>', '<?=$dyesterday5?>', '<?=$dyesterday4?>', '<?=$dyesterday3?>', '<?=$dyesterday2?>', '<?=$dyesterday?>', '<?=$dtoday?>'],
				title: {
					text: null
				}
				},
				yAxis: {
					min: 0,
					   lineWidth: 0,
					   minorGridLineWidth: 0,
					   lineColor: 'transparent',
				title: {
					text: '',
					align: 'high'
				},
				labels: {
					overflow: 'justify'
				}
				},
				tooltip: {
					valueSuffix: '명'
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}
					}
				},
                //열 위에 데이터값 표시
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            crop: false,
                            overflow: 'none'
                        }
                    }
                },
                
//				legend: {
//					layout: 'vertical',
//					align: 'right',
//					verticalAlign: 'top',
//					x: -40,
//					y: 80,
//					floating: true,
//					borderWidth: 1,
//					backgroundColor:
//					Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
//					shadow: true
//				},
				credits: {
					enabled: false
				},
				series: [ {
					name: '방문',
					data: [<?=$count[yesterday_view6]?>, <?=$count[yesterday_view5]?>, <?=$count[yesterday_view4]?>, <?=$count[yesterday_view3]?>, <?=$count[yesterday_view2]?>,<?=$count[yesterday_view]?>, <?=$count[today_view]?>],
					color: '#4f81bd'
				}]
			});
			
			
			
			$('#pie').highcharts({
            chart: {
                type: 'pie'
            },
            colors: [
               '#4662a0',
               '#aadb87',
               '#da495b',
               '#a87bc6',
               '#fde5a5',
               '#66ceed',
	             '#d565ad',
	             '#7ea45d',
	             '#eace6b',
	             '#66edc6',
	             '#fdb7a5'
            ],
            title: {
                text: '',
                style: {
                  color: '#555'
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0,
                backgroundColor: '#FFFFFF'
            },
            xAxis: {
                categories: [
                    '2006',
                    '2007',
                    '2008',
                    '2009',
                    '2010',
                    '2011'
                ]
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            tooltip: {
                shared: false,
                valueSuffix: 'points'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: '',
                data: [
                    ['Data 1', 25.0],
                    ['Data 2', 26.8],
                    ['Data 3', 16.8],
                    ['Data 4', 8.5],
                    ['Data 5', 6.2],
                    ['Data 6', 2.7],
                    ['Data 7', 3.7],
                    ['Data 8', 4.7],
                    ['Data 9', 5.7],
                    ['Data 10', 6.7],
                    ['Data 11', 7.7]
                ]
            }]
        });
		});
	</script>
</body>
</html>