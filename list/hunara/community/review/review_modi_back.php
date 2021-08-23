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
		$idx = $_REQUEST['idx'];
		date_default_timezone_set("Asia/Seoul");
		$tableName = $_REQUEST['tableName'];

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
						$oldSql = "SELECT b_file1 from " .$tableName. " WHERE idx = '" .$idx. "'";
						$result = mysqli_query($gconnet, $oldSql);
						
						$oldFile = mysqli_fetch_array($result);
						$newImageName = "hunara".uniqid("",true).".".$fileActualExt;
						$fileDestination = "../../upload_file/rv/" . $newImageName;
						$sql = "UPDATE " .$tableName. " SET name = '" . $name . "', email = '" .$email. "', title = '" .$title. "', content = '" .$content. "', ori_name = '" .$oriName. "', b_file1 = '" .$newImageName. "' WHERE idx = '".$idx."'";
					
						$stmt = mysqli_stmt_init($gconnet);
						if(!mysqli_stmt_prepare($stmt, $sql)) {
							echo "게시물 작성중 에러가 발생하였습니다.";
							exit();
						} else {
							$oldDestination = "../../upload_file/rv/" . $oldFile['b_file1'];
							unlink($oldDestination);
							mysqli_stmt_execute($stmt);
							move_uploaded_file($fileTempName, $fileDestination);
							echo "<script>alert('게시글이 수정되었습니다.');
							window.location.href = 'review.php?upload-sucess';</script>";
							exit();
						}
					} else {
						echo "<script>alert('1MB 미만의 파일만 업로드가 가능합니다.');
						window.history.back();</script>";
						exit();
					}
				} else {
					echo "<script>alert('파일 업로드중 에러가 발생하였습니다. 다시 시도해 주세요.');
					window.history.back();</script>";
					exit();
				}
			} else {
				echo "<script>alert('사진파일 1MB 미만 jpg, jpeg, png 확장자만 업로드 가능합니다.');
				window.history.back();</script>";
				exit();
			}
		} else {
			$sql = "UPDATE " .$tableName. " SET `name` = '" . $name . "', `email` = '" .$email. "', `title` = '" .$title. "', `content` = '" .$content. "' WHERE idx = '".$idx."'";
			$stmt = mysqli_stmt_init($gconnet);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo $sql."<br>";
				echo "사진변경 없이 수정에 실패";
				exit();
			} else {
				mysqli_stmt_execute($stmt);
				echo "<script>alert('게시글이 수정되었습니다.');
				window.location.href = 'review.php?upload-sucess';</script>";
				exit();
			}
		}
     } else {
			$sql = "UPDATE " .$tableName. " SET `name` = '" . $name . "', `email` = '" .$email. "', `title` = '" .$title. "', `content` = '" .$content. "' WHERE idx = '".$idx."'";
			$stmt = mysqli_stmt_init($gconnet);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo $sql."<br>";
				echo "사진변경 없이 수정에 실패";
				exit();
			} else {
				mysqli_stmt_execute($stmt);
				echo "<script>alert('게시글이 수정되었습니다.');
				window.location.href = 'review.php?upload-sucess';</script>";
				exit();
			}
		}
	}
?>