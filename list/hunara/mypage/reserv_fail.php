<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">
<?
    $pageNo = trim(sqlfilter($_REQUEST['pageNo']));
    $regflag = "6";

    $total_param = "regflag=".$regflag;

    if(!$pageNo){
        $pageNo = 1;
    }    

    $pageScale = 10; // 페이지당 10 개씩 
    $start = ($pageNo-1)*$pageScale;
    
    $StarRowNum = (($pageNo-1) * $pageScale);
    $EndRowNum = $pageScale;
    
    //당첨여부[5:당첨 6:예비당첨 7: 당첨후취소  8:취소 9:탈락] 
    $sql = " SELECT a.ridx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, a.regflag, date_format(a.udate, '%Y.%m.%d') as udate ";
    $sql .= "   FROM tb_reInfo a, tb_hu b ";
    $sql .= "   WHERE a.hidx = b.idx      ";
    $where = " AND a.cidx = '{$_COMPANY_ID}'   AND a.sano = '{$_SESSION['EMP_NO']}'  ";
    $where .= "AND a.regflag not in ( '5' ,'7','8' )  AND a.hide_yn = 'N' ";

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
            <? include("reserv_tab.php");  ?>
            <table id="reserv-t" class="reserv-not">
                <tr>
                    <th>번호</th>
                    <th>지망</th>
                    <th>휴양소명</th> 
                    <th>예약일</th>
                    <th>확정일</th>
                    <th>결과</th>
                </tr>
            <?
                    $listCnt = mysqli_num_rows($rs);
                    for ($i=0; $i<mysqli_num_rows($rs); $i++){
                        $row = mysqli_fetch_array($rs);      
                        $no = $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
            ?>
                <tr onclick="view('<?=$row['ridx']?>');">
                    <td><p><?=$no?></p></td>
                    <td><p><?=($row['chasu'] == "0")?"선착순":$row['chasu']."지망"?></p></td>
                    <td><p><?=$row['comname']?></p></td>
                    <td><p><?=tranStrDate($row['cymd'],'kordis.')?>부터 <?=$usedayArray[$row['useday']]?></p></td>
                    <td><p><?=$row['udate']?></p></td>
                    <td><p><?=$regFlagArray[$row['regflag']]?></p></td>
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