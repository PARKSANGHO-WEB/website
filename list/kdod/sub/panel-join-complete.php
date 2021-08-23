<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
</head>
<body>
	<div id="panel-join-complete">
		<section class="joina">
			<div class="joina-wrap">
				<div class="joina-logo">
					<a href="../index.php">
						<img src="../img/logo.png" alt="kdot 로고">
					</a>
				</div>
			</div>
			<div class="container">
				<div class="content">
					<h2>Thank you</h2>
					<p class="txt01">Thank you very much for being our online panel membership!<br>
					Your valuable voice will be a big asset with contribution to development of your society, country and industry.<br>
					<span class="color">200 K-DOD points</span> were given and you can find your point information at <span class="color">'My Info’</span> page.<p>
					<p class="txt02">Thanks!</p>
				</div>
			</div>
			<div class="btnWrap btnWrap02" style="padding-top:10px;">
				<a href="javascript:com_close();" class="btn btn01">Close</a>
			</div>
		</section>
	</div>

	<script>
	function com_close(){
		opener.location.reload();
		self.close();
	}
	</script>

</body>
</html>