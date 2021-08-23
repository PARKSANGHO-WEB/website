<? include("../../inc/header.php"); ?>
<?php 
	if(!$gconnet) {
		die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
	}

	if(empty($_REQUEST['title'])) {

        popup_msg("제목을 입력하여 주십시오.");

    }else{
		
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$title = $_REQUEST['title'];
		$content = $_REQUEST['content'];
		$pwd = $_REQUEST['pwd'];
		date_default_timezone_set("Asia/Seoul");
		$nows = date('Y-m-d');
		$tableName = 'tb_qa';
		$eseq = $_SESSION['EMP_SEQ'];

        $remove = $_REQUEST['remove'];

        if($remove != 'Y'){
		
		if(!empty($_FILES['file']['name'])) {
			$file = $_FILES['file'];
			$fileName = $file['name'];
			$oriName = $file['name'];
			$fileType = $file["type"];
			$fileError = $file['error'];
			$fileSize = $file['size'];
			$fileTempName = $file["tmp_name"];
			$fileExt = explode(".", $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$allowed = array("jpg","jpeg","png");
			if(in_array($fileActualExt, $allowed)) {
				if($fileError === 0) {
					if ($fileSize < 1000000) {
						$newImageName = "hunara".uniqid("",true).".".$fileActualExt;
						$fileDestination = "../../upload_file/qa/" . $newImageName;
						$sql = "INSERT INTO $tableName(`name`, `email`, `title`, `content`, `pwd`, `nows`, `b_file1`, `ori_name`, `bkind`, `eseq`) VALUES ('$name', '$email', '$title', '$content', '$pwd', '$nows', '$newImageName', '$oriName', '$_COMPANY_ID', '$eseq');";
						$stmt = mysqli_stmt_init($gconnet);
						if(!mysqli_stmt_prepare($stmt, $sql)) {
							echo "게시물 작성중 에러가 발생하였습니다.";
							exit();
						} else {
							mysqli_stmt_execute($stmt);

                            $sql_pre2 = " select idx from tb_qa where 1=1 order by idx desc limit 0,1"; 
                            $result_pre2  = mysqli_query($gconnet,$sql_pre2);
                            $mem_row2 = mysqli_fetch_array($result_pre2);
                            $board_idx = $mem_row2[idx]; 

                            $sql_pre3 = " update tb_qa set ref = '".$board_idx."' where 1=1 and idx = '".$board_idx."'"; 
                            $result_pre3  = mysqli_query($gconnet,$sql_pre3);
                            

							move_uploaded_file($fileTempName, $fileDestination);
							header("location:qna.php?upload-sucess");
						}
					} else {
						echo "<script>alert('1MB 미만의 파일만 업로드가 가능합니다.');
                        window.history.back();
						</script>";
						exit();
					}
				} else {
					echo "<script>alert('파일 업로드중 에러가 발생하였습니다. 다시 시도해 주세요.');
                    window.history.back();
					</script>";
					exit();
				}
			} else {
				echo "<script>alert('사진파일 1MB 미만 jpg, jpeg, png 확장자만 업로드 가능합니다.');
                window.history.back();
				</script>";
				exit();
			}
		} else {
			$sql = "INSERT INTO $tableName(`name`, `email`, `title`, `content`, `pwd`, `nows`, `bkind`, `eseq`) VALUES ('$name', '$email', '$title', '$content', '$pwd', '$nows', '$_COMPANY_ID', '$eseq');";
			
            $stmt = mysqli_stmt_init($gconnet);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "사진 없이 업로드에 실패";
				exit();
			} else {
				mysqli_stmt_execute($stmt);
                

                $sql_pre2 = " select idx from tb_qa where 1=1 order by idx desc limit 0,1"; 
                $result_pre2  = mysqli_query($gconnet,$sql_pre2);
                $mem_row2 = mysqli_fetch_array($result_pre2);
                $board_idx = $mem_row2[idx]; 

                $sql_pre3 = " update tb_qa set ref = '".$board_idx."' where 1=1 and idx = '".$board_idx."'"; 
                $result_pre3  = mysqli_query($gconnet,$sql_pre3);


				header("location:qna.php?upload-sucess");
			}
		}
    } else {
			$sql = "INSERT INTO $tableName(`name`, `email`, `title`, `content`, `pwd`, `nows`, `bkind`, `eseq`) VALUES ('$name', '$email', '$title', '$content', '$pwd', '$nows', '$_COMPANY_ID', '$eseq');";
			
            $stmt = mysqli_stmt_init($gconnet);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "사진 없이 업로드에 실패";
				exit();
			} else {
				mysqli_stmt_execute($stmt);
                

                $sql_pre2 = " select idx from tb_qa where 1=1 order by idx desc limit 0,1"; 
                $result_pre2  = mysqli_query($gconnet,$sql_pre2);
                $mem_row2 = mysqli_fetch_array($result_pre2);
                $board_idx = $mem_row2[idx]; 

                $sql_pre3 = " update tb_qa set ref = '".$board_idx."' where 1=1 and idx = '".$board_idx."'"; 
                $result_pre3  = mysqli_query($gconnet,$sql_pre3);


				header("location:qna.php?upload-sucess");
			}
		}
	}
?>