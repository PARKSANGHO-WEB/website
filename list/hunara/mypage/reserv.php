<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">
<?
    $pageNo = trim(sqlfilter($_REQUEST['pageNo']));
    $regflag = trim(sqlfilter($_REQUEST['regflag']));

    $total_param = "regflag=".$regflag;

    if(!$pageNo){
        $pageNo = 1;
    }    

    $pageScale = 10; // 페이지당 10 개씩 
    $start = ($pageNo-1)*$pageScale;
    
    $StarRowNum = (($pageNo-1) * $pageScale);
    $EndRowNum = $pageScale;
    
    $sql = " SELECT a.ridx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, a.regflag, a.regflag_two , a.hide_yn ";
    $sql .= "       , date_format(a.wdate,'%Y.%m.%d') as wdate, c.type , c.flag, d.rArea ";
    $sql .= "       , (SELECT 'Y' FROM tb_pay WHERE ridx = a.ridx AND resultCode = '0000' ) as pgYN ";
    $sql .= "       , date_format(a.cancel_date, '%Y.%m.%d') as cancel_date ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c, tb_huType d ";
    $sql .= " WHERE a.hidx = b.idx      ";
    $sql .= "  AND a.midx = c.midx      ";
    $sql .= "  AND d.idx = b.idx        ";
    $sql .= "  AND a.seq = d.seq        ";
    $where = " AND a.cidx = '{$_COMPANY_ID}'   AND a.sano = '{$_SESSION['EMP_NO']}'";

    $sql .=  $where."   ORDER BY a.ridx  desc LIMIT  {$StarRowNum} , {$EndRowNum}";
	$rs = mysqli_query($gconnet, $sql);

    $query_cnt = "select a.ridx from tb_reInfo a where 1=1 ".$where;
    $result_cnt = mysqli_query($gconnet,$query_cnt);
    $num = mysqli_num_rows($result_cnt);

    $iTotalSubCnt = $num;
    $totalpage	= ($iTotalSubCnt - 1)/$pageScale;    

?>
<script>
    $(document).ready(function(){
        jQuery('.top-menu a').eq("2").addClass('active');
    });

    function view(ridx){
        var f = document.frm;
        f.ridx.value = ridx;
        f.action = "/mypage/reserv_view.php";
        f.submit();
    }


</script>
<body>
<form name="frm" method="get">
<input type="hidden" name="ridx" id="ridx">
</form>
    <header></header>
    <div id="container">
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li>
						<span onclick="location.href='/mypage/mypage.php'">회원정보</span>
					</li>
					<li class="active">
						<span onclick="location.href='/mypage/reserv.php'">예약내역</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/mywrite.php'">내 게시글 관리</span>
					</li>
				</ul>
			</div>
		</div>

        <div id="table">
            <? //include("reserv_tab.php");  ?>
            <table id="reserv-t" class="reserv-all">
                <tr>
                    <th style="width:5%">번호</th>
                    <th style="width:10%">지망</th>
                    <th style="width:10%">등록일</th>
                    <th style="width:20%">예약일</th>
                    <th style="width:8%">구분</th>
                    <th style="width:14%">휴양소명</th> 
                    <th style="width:8%">평형</th>
                    <th style="width:15%">결과</th>
                    <th style="width:10%">부담금결제</th>
                </tr>
                <?
                    for ($i=0; $i<mysqli_num_rows($rs); $i++){
                        $row = mysqli_fetch_array($rs);      
                        $no = $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
                ?>
                <tr onclick="view('<?=$row['ridx']?>');">
                    <td><p><?=$no?></p></td>
                    <td><p><?=($row['type'] == "F")?"선착순":$row['chasu']."지망"?></p></td>
                    <td><p><?=$row['wdate']?></p></td>
                    <td><p><?=$usedayArray[$row['useday']]?>
                    <?
                        $cymd = $row['cymd'];
                        $dayCnt = (int)$row['useday'];
                        echo "(";
                        for($j=0; $j < $dayCnt; $j++){
                            $day = date('m. d',strtotime($cymd."+{$j} days"));

                            if($j > 0) echo " / ";
                            echo $day;
                        }
                        echo ")";
                    ?>
                    </p></td>
                    <td><p><?=$row['flag']?></p></td>
                    <td><p><?=$row['comname']?></p></td>
                    <td><p><?=$row['rArea']?></p></td>
                    <td><p>
                        <?
                            if($row['regflag'] == "8" ){
                                echo "취소";
                            }else if($row['regflag_two'] == "2"){
                                echo "취소 신청중"."<br>".$row['cancel_date'];
                            }else if($row['regflag_two'] == "3"){
                                echo "취소 확정"."<br>".$row['cancel_date'];
                            }else if($row['regflag_two'] == "4"){
                                echo "취소 불가"."<br>".$row['cancel_date'];
                            }else if($row['hide_yn'] == "Y" ){
                                echo "-";
                            }else if($row['hide_yn'] == "N" ){
                                echo $regFlagArray[$row['regflag']]."<br>".$row['cancel_date'];    
                            }else if($row['regflag'] == "5" && $row['type'] == "F" && $row['hide_yn'] == "N" ){
                                echo "선착순";
                            }else if($row['regflag'] == "9"  && $row['hide_yn'] == "N" ){
                                echo "탈락";
                            }
                        ?>
                    </p></td>
                    <td><p><?=($row['pgYN'] == "Y")?"결제":"-"?></p></td>
                </tr>
                <?
                    }

                ?>
            </table>
            <div id="paging">
                <ul>
                    <?
    		    	    include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front.php";	
	        	    ?>	                
                </ul>
            </div>
    	</div>
    </div>
    <footer></footer>
</body>
</html>