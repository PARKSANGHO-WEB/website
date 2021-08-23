<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$regflag        = trim(sqlfilter($_REQUEST['excelFlag']));
$hidx           = trim(sqlfilter($_REQUEST['hidx']));
$cidx           = trim(sqlfilter($_REQUEST['cidx']));
$useday         = trim(sqlfilter($_REQUEST['usedays']));
$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$pgubun         = trim(sqlfilter($_REQUEST['pgubun']));
$searchDate     = trim(sqlfilter($_REQUEST['searchDate']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));

$fileName = "excel.xls";

if($regflag == "5"){
    $fileName = "당첨자리스트.xls";
}else if($regflag == "9"){
    $fileName = "탈락자리스트.xls";
}else if($regflag == "7"){
    $fileName = "당첨후취소리스트.xls";
}

header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
header( "Content-Disposition: attachment; filename=$fileName" );

$WHERE = "";
if(!empty($hidx)){
    $WHERE .= " AND a.hidx = '{$hidx}' ";
}

if(!empty($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(!empty($useday)){
    $WHERE .= " AND a.useday in ( {$useday} )";
}

if(!empty($searchValue)){

    if($searchType == "name"){
        $WHERE .= " AND a.name LIKE '%{$searchValue}%' ";
    }else if($searchType == "sano"){
        $WHERE .= " AND a.sano LIKE '%{$searchValue}%' ";
    }else if($searchType == "hp"){
        $WHERE .= " AND (a.hp LIKE '%{$searchValue}%' OR a.tel LIKE '%{$searchValue}%' ) ";
    }

}

if(!empty($regflag)){
    $WHERE .= " AND a.regflag = $regflag  ";
}

if(!empty($pgubun)){
    $WHERE .= " AND a.pgubun <= $pgubun  ";
}

if(!empty($startDate)){

    if($searchDate == "cymd"){
        $WHERE .= " AND a.cymd >= date_format('$startDate', '%Y%m%d' )  ";
    }else if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate >= date_format('$startDate', '%Y-%m-%d' )  ";

    }else if($searchDate == "cancel"){
        $WHERE .= " AND ( a.udate >= date_format('$startDate', '%Y-%m-%d' )   ";
        $WHERE .= "       OR a.cancel_date >= date_format('$startDate', '%Y-%m-%d' ) ";
    }
}

if(!empty($endDate)){

    if($searchDate == "cymd"){
        $WHERE .= " AND a.cymd <= date_format('$endDate', '%Y%m%d' )  ";
    }else if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate <= date_format('$endDate', '%Y-%m-%d' )  ";

    }else if($searchDate == "cancel"){
        $WHERE .= " AND ( a.udate <= date_format('$endDate', '%Y-%m-%d' )   ";
        $WHERE .= "       OR a.cancel_date <= date_format('$endDate', '%Y-%m-%d' ) ";
    }
}


/*
SELECT a.ridx, date_format(a.wdate,'%Y.%m.%d') as wdate, b.cname, c.hname, a.pgubun, d.rArea, 
a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, a.midx, a.hidx, a.cidx, a.seq
FROM tb_reInfo a
LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx
LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx
LEFT OUTER JOIN (select idx,seq,rArea  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq
WHERE 1=1 
 AND a.hidx = AND a.cidx= AND a.useday= AND a.name = AND a.sano = AND (a.hp= OR a.tel=) AND a.regflag= AND a.pgubun = AND a.cymd= AND a.wdate= AND a.udate= AND a.cancel_date
*/ 


$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.cymd, a.useday, b.cname, c.hname, a.pgubun, d.rArea, d.rCnt, ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, a.midx, a.hidx, a.cidx, a.seq, date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   case when a.chasu = 0 then '선착순' else concat(a.chasu,'지망') end as chasu ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,seq,rArea, rCnt  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq ";
$SQL .= "WHERE 1=1 ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

?>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
/* 엑셀 다운로드로 저장시 숫자로 표시될 경우 방지 */
	.txt {mso-number-format:'\@'}
</style>
</head>
<body bgcolor="#ffffff" topmargin="0" leftmargin="0">

<table border=1>
	<tr height=28>
		<td>번호</td>
		<td>지망</td>
		<td>등록일</td>
		<td>예약일</td>
		<td>기업명</td>
        <td>구분</td>
		<td>휴양소명</td>
		<td>평형</td>
		<td>객실수</td>
		<td>예약자</td>
		<td>사원번호</td>
		<td>연락처</td>
		<td>결과</td>
	</tr>
<?

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    $useday = $usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")";
    
    if($row['regflag'] == "7"){
        $regflag = $regFlagArray[$row['regflag']]."\n".$row['udate'];
    }else{
        $regflag = $regFlagArray[$row['regflag']];
    }

?>
    <tr>
        <td><?=($totalCnt-$i)?></td>
        <td><?=$row['chasu']?></td>
        <td><?=$row['wdate']?></td>
        <td><?=$useday?></td>
        <td><?=$row['cname']?></td>
        <td><?=$row['pgubun']?></td>
        <td><?=$row['hname']?></td>
        <td><?=$row['rArea']?></td>
        <td><?=$row['rCnt']?></td>
        <td><?=$row['name']?></td>
        <td class="txt" ><?=$row['sano']?></td>
        <td class="txt" ><?=$row['hp']?></td>
        <td><?=$regflag?></td>
    </tr>
<?
}
?>

</table>

</body>
</html>