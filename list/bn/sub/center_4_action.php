<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$company = trim(sqlfilter($_REQUEST['company']));
	$cell = trim(sqlfilter($_REQUEST['cell']));
	$email = trim(sqlfilter($_REQUEST['email']));
	$homep = trim(sqlfilter($_REQUEST['homep']));
	$refhomep = trim(sqlfilter($_REQUEST['refhomep']));
	$hpage = trim(sqlfilter($_REQUEST['hpage']));

	$vtype = $_REQUEST['vtype'];
	for($k=0; $k<sizeof($vtype); $k++){
		if($k == sizeof($vtype)-1){
			$vtype_arr .= $vtype[$k];
		} else {
			$vtype_arr .= $vtype[$k].",";
		}
	}

	$hcontent = trim(sqlfilter($_REQUEST['hcontent']));

	$bbs_code = "qna";
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";

	$file_i = "1";
	if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작
		$file_o = $_FILES['file_'.$file_i]['name']; 
		$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); 
	}

	$FROMNAME = $company;
	$FROMEMAIL = $email; 
	$SUBJECT = "[BN-SYSTEM] 문의 내용이 접수 되었습니다.";
	$tomail_1 = "best@bn-system.com";
	$tomail_2 = "gelila2@naver.com";

	$mail_file = $_P_DIR_FILE.$file_c;
				
		$content = "
		 <table cellspacing='0' cellpadding='0' width='600' border='0' align='center'>
		<tr><td height='100'></td></tr>
		<tr>
		<td align='center' valign='top'>
		<table cellspacing='1' cellpadding='5' width='100%' bgcolor='#abc3da' border='0'>
                <tbody>
				   <tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>실명 / 회사명 / 업체명</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$company</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>연락처</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$cell</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>이메일</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$email</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>현재 사이트</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$homep</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>참고 사이트</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$refhomep</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>예상 페이지 수</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$hpage page</td>
                    </tr>
					<tr height='26' style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>문의분야</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;'>$vtype_arr</td>
                    </tr>
					<tr style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>상세내용</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;padding-top:10px;padding-bottom:10px;'>".nl2br($hcontent)."</td>
                    </tr>
					<tr style='text-align:left;padding-left:10px;'>
                        <td width='150' bgcolor='#e8f3fd' style='text-align:left;padding-left:10px;'>기타 첨부자료</td>
                        <td bgcolor='#ffffff' width='450' style='text-align:left;padding-left:10px;padding-top:10px;padding-bottom:10px;'><a href='$inc_fdata_domain/pro_inc/download_file.php?nm=$file_c&on=$file_o&dir=qna'>".$file_o."</a></td>
                    </tr>
                 </tbody>
            </table>
			</tD>
			</tR>
			<tr><td height='100'></td></tr>
			</table>
		";

		$content = $content;
		
		$pwd_mail_1 = mail_utf($FROMEMAIL,$FROMNAME,$tomail_1,$SUBJECT,$content,$mail_file); // 메일을 발송한다.
		//exit;
		$pwd_mail_2 = mail_utf($FROMEMAIL,$FROMNAME,$tomail_2,$SUBJECT,$content,$mail_file); // 메일을 발송한다.

		error_frame_go("문의 등록이 접수 되었습니다. 곧 연락 드리겠습니다.","center_4.html");
?>