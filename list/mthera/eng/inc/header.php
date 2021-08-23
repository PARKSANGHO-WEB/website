<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	//echo $_SERVER['PHP_SELF'];
	$current_path_arr = explode("/",$_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?if($current_path_arr[2] == "engsub"){?>
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap');
    </style>
    <link rel="stylesheet" href="/eng/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/eng/css/index.css">
    <link rel="stylesheet" href="/eng/css/sub.css">
    <link rel="stylesheet" href="/eng/css/header.css">
    <link rel="stylesheet" href="/eng/css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.1">
    <title>MTHERA PHARMA</title> 
<?}else{?>
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500;700;900&display=swap');
    </style>
    <link rel="stylesheet" href="/eng/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/eng/css/index.css">
    <link rel="stylesheet" href="/eng/css/owl.carousel.css">
    <link rel="stylesheet" href="/eng/css/owl.theme.default.css">
    <link rel="stylesheet" href="/eng/css/header.css">
    <link rel="stylesheet" href="/eng/css/footer.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="/js/jquery.bxslider.js"></script>
   <script src="/js/owl.carousel.js"></script>
    <meta charset="UTF-8">
    <meta property="og:title" content="MTHERAPHARMA">
    <meta property="title" content="MTHERAPHARMA">
    <meta property="og:image" content="http://mtherapharma.com/img/common/og_image.jpg" />
    <meta property="og:url" content="http://mtherapharma.com/">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.1">
    <title>MTHERA PHARMA</title> 
<?}?>
   <script type="text/javascript" src="/js/common_js.js"></script>
 </head>
<script> 
    $(document).ready(function(){
     $(document).bind("contextmenu", function(e) {
      return false;
     });
    });
    $(document).bind('selectstart',function() {return false;}); 
    $(document).bind('dragstart',function(){return false;}); 
</script>
