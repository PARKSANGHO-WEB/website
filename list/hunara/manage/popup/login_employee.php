<? include("../inc/header.php"); ?>

<?
    $cidx   = trim(sqlfilter($_REQUEST['cidx']));
    $sano    = trim(sqlfilter($_REQUEST['sano']));

	$sql = " SELECT seq, pwd, cdx, sano, name, digit7, email, tel, hp, daycnt, year5, manychild, freshman FROM tb_employee ";
    $sql .= " WHERE cdx = '{$cidx}'  AND sano = '{$sano}' ";

    $rs = mysqli_query($gconnet, $sql);

	if(mysqli_num_rows($rs)>0){ 
		$row = mysqli_fetch_array($rs);

        $_SESSION['EMP_SEQ'] = $row['seq'];
        $_SESSION['EMP_CDX'] = $row['cdx'];
        $_SESSION['EMP_NO'] = $row['sano'];
        $_SESSION['EMP_NM'] = $row['name'];
        $_SESSION['EMP_DIGIT'] = $v['digit7'];
        $_SESSION['EMP_EMAIL'] = $row['email'];
        $_SESSION['EMP_DAY_CNT'] = $row['daycnt'];
        $_SESSION['EMP_TEL'] = $row['tel'];
        $_SESSION['EMP_HP'] = $row['hp'];  

	} 
    
?>
<script>
  location.href = '/mypage/reserv.php';
</script>
