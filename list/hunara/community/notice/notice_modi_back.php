<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php 
	if(!$gconnet) {
		die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
	}

	if(isset($_POST['submit'])) {
		
		$name = $_REQUEST['name'];
		$title = $_REQUEST['title'];
		$content = $_REQUEST['content'];
		$pwd = $_REQUEST['pwd'];
		date_default_timezone_set("Asia/Seoul");
		$tableName = $_REQUEST['tableName'];
        $idx = $_REQUEST['idx'];
		
		if(!empty($_FILES['file']['name'])) {
			$file = $_FILES['file'];
			$fileName = $file['name'];
			$oriName = $file['name'];
			$fileType = $file["type"];
			$fileError = $file['error'];
			$fileSize = $file['size'];
			$fileTempName = $file["tmp_name"];

			$fileExt = explode(".", $fileName, 2);
			$fileActualExt = strtolower(end($fileExt));
			$fileActualName = strtolower(reset($fileExt));

			if($fileError === 0) {
				$oldSql = "SELECT b_file1 from " .$tableName. " WHERE idx = '" .$idx. "'";
                $result = mysqli_query($gconnet, $oldSql);
                $oldFile = mysqli_fetch_array($result);

				$sql = 'SELECT ori_name FROM '.$tableName.' WHERE ori_name = "' .$oriName.'"';
				$result = mysqli_query($gconnet, $sql);
				$dupCount = mysqli_num_rows($result);
				if($dupCount == 0) {
					$newFileName = $fileName;
				} else {
					$newFileName = $fileActualName."(". $dupCount . ").".$fileActualExt;
				}

				$fileDestination = "../../upload_file/pds/" . $newFileName;
				$sql = "UPDATE " .$tableName. " SET name = '" . $name . "', title = '" .$title. "', content = '" .$content. "', ori_name = '" .$oriName. "', b_file1 = '" .$newFileName. "' WHERE idx = '".$idx."'";
				$stmt = mysqli_stmt_init($gconnet);
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					echo "게시물 작성중 에러가 발생하였습니다.";
					exit();
				} else {
                    $oldDestination = "../../upload_file/pds/" . $oldFile['b_file1'];
                    unlink($oldDestination);
					mysqli_stmt_execute($stmt);
					move_uploaded_file($fileTempName, $fileDestination);
					echo "<script>alert('파일 게시글이 수정되었습니다.');
                    window.location.href = 'notice.php?upload-sucess';</script>";
                    exit();
				}
			} else {
				echo "파일 업로드중 에러가 발생하였습니다. 다시 시도해 주세요.";
				exit();
			}
			

		} else {
			$sql = "UPDATE " .$tableName. " SET `name` = '" . $name . "', `title` = '" .$title. "', `content` = '" .$content. "' WHERE idx = '".$idx."'";
			$stmt = mysqli_stmt_init($gconnet);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "파일 없이 수정에 실패";
				exit();
			} else {
				mysqli_stmt_execute($stmt);
				echo "<script>alert('게시글이 수정되었습니다.');
                    window.location.href = 'notice.php?upload-sucess';</script>";
                    exit();
			}
			
		}
	}
?>