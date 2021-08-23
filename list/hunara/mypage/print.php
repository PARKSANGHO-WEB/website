<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $ridx = trim(sqlfilter($_REQUEST['ridx']));

	$sql = " SELECT a.ridx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, date_format(a.cymd2, '%Y-%m-%d') as cymd2, a.useday, c.flag, ";
	$sql .= "   d.rArea, d.rType, d.rAvg, d.rMax, d.rInfra, a.pcnt1, a.pcnt2, c.per_amount, a.chasu, ";
    $sql .= "   a.name, a.sano, a.hp, a.email, a.regflag, concat(b.addr1, b.addr2) as addr, b.tel, b.homepage,  ";
    $sql .= "   e.dname, e.tel as d_tel  ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c, tb_huType d, tb_company e ";
	$sql .= " WHERE a.hidx = b.idx   AND a.midx = c.midx  AND b.idx = d.idx ";
    $sql .= " AND a.seq = d.seq   AND a.cidx = e.idx AND a.ridx = '{$ridx}'  ";    

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/css/sub.css">
    <title>휴양소 배정권 출력</title>
</head> 
<body>
	<section class="print">
		<div class="print-logo">
			<img src="../img/common/logo.png" alt="">
		</div>
		<div class="print-table">
			<P class="title">
				[휴양소 배정권]
			</P>
			<table class="pc-table">
				<tr>
					<th>회사명</th>
					<td><?=$_SITE_COMPANY?></td>
					<th>사번</th>
					<td><?=$row['sano']?></td>
				</tr>
				<tr>
					<th>성명</th>
					<td><?=$row['name']?></td>
					<th>연락처</th>
					<td><?=$row['hp']?></td>
				</tr>
				<tr>
					<th>휴양소명</th>
					<td><?=$row['comname']?></td>
					<th>이용기간</th>
					<td><?=$row['cymd']?> ~ 
                    <?
                        $cymd = explode("-",$row['cymd']);
                        $cymd2 = explode("-",$row['cymd2']);
                        $endDt = "";

                        if($cymd[0] != $cymd2[0]){
                            $endDt = $cymd2[0]."-";
                        }

                        if($cymd[1] != $cymd2[1]){
                            $endDt .= $cymd2[1]."-";
                        }
                        if($cymd[2] != $cymd2[2]){
                            $endDt .= $cymd2[2];
                        }


                    ?>
                    <?=$endDt?>(<?=$usedayArray[$row['useday']]?>)</td>
				</tr>
				<tr>
					<th>평형</th>
					<td><?=$row['rArea']?></td>
					<th>기준인원</th>
					<td>최소<?=$row['rAvg']?>명 / 최대 <?=$row['rMax']?>명</td>
				</tr>
				<tr>
					<th>리조트 주소</th>
					<td colspan="3"><?=$row['addr']?></td>
				</tr>
				<tr>
					<th>연락처</th>
					<td><?=$row['tel']?></td>
					<th>홈페이지</th>
					<td><span><?=$row['homepage']?></span></td>
				</tr>
				<tr>
					<th>담당자</th>
					<td><?=$row['dname']?></td>
					<th>담당자연락처</th>
					<td><?=$row['d_tel']?></td>
				</tr>
				<tr>
					<th>주의사항</th>
					<td colspan="3">
						1. 휴양소 이용은 임, 직원 및 그 가족 이외에는 사용할 수 없습니다.
						<br />
						2. 객실이용 인원 준수
					</td>
				</tr>
			</table>
			<table class="mob-table">
				<tr>
					<th>회사명</th>
					<td><?=$_SITE_COMPANY?></td>
				</tr>
				<tr>
					<th>사번</th>
					<td><?=$row['sano']?></td>
				</tr>
				<tr>
					<th>성명</th>
					<td><?=$row['name']?></td>
				</tr>
				<tr>
					<th>연락처</th>
					<td><?=$row['hp']?></td>
				</tr>
				<tr>
					<th>휴양소명</th>
					<td><?=$row['comname']?></td>
				</tr>
				<tr>
					<th>이용기간</th>
					<td><?=$row['cymd']?> ~ 06(<?=$usedayArray[$row['useday']]?>)</td>
				</tr>
				<tr>
					<th>평형</th>
					<td><?=$row['rArea']?>평</td>
				</tr>
				<tr>
					<th>기준인원</th>
					<td>최소<?=$row['rAvg']?>명 / 최대 <?=$row['rMax']?>명</td>
				</tr>
				<tr>
					<th>리조트 주소</th>
					<td><?=$row['addr']?></td>
				</tr>
				<tr>
					<th>연락처</th>
					<td><?=$row['tel']?></td>
				</tr>
				<tr>
					<th>홈페이지</th>
					<td><span><?=$row['homepage']?></span></td>
				</tr>
				<tr>
					<th>담당자</th>
					<td><?=$row['dname']?></td>
				</tr>
				<tr>
					<th>담당자연락처</th>
					<td><?=$row['d_tel']?></td>
				</tr>
				<tr>
					<th>주의사항</th>
					<td colspan="3">
						1. 휴양소 이용은 임, 직원 및 그 가족 이외에는 사용할 수 없습니다.
						<br />
						2. 객실이용 인원 준수
					</td>
				</tr>
			</table>
		</div>
        <button class="print-btn" type="button" onclick="window.print();">출력하기</button>
	</section>
</body>
</html>