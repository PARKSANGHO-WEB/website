<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	//echo $_SERVER['PHP_SELF'];
	$current_path_arr = explode("/",$_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?if($current_path_arr[1] == "sub"){?>
    <link rel="canonical" href="http://mtherapharma.com/index.php">
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap');
    </style>
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
    <link rel="stylesheet" href="/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/sub.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.1">
    <title>엠테라파마 (MTHERA PHARMA)</title> 
<?}else{?>
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500;700;900&display=swap');
    </style>
    <link rel="stylesheet" href="/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.default.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="/js/jquery.bxslider.js"></script>
   <script src="/js/owl.carousel.js"></script>
    <meta charset="UTF-8">
    <link rel="canonical" href="http://mtherapharma.com/index.php">
    <meta name="robots" content="index,follow">
    <meta property="og:title" content="엠테라파마 (MTHERA PHARMA)">
    <meta property="title" content="엠테라파마 (MTHERA PHARMA)">
    <meta property="og:image" content="http://mtherapharma.com/img/common/og_image.jpg" />
    <meta property="og:url" content="http://mtherapharma.com/">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.1">
    <meta name="naver-site-verification" content="ef0718ece2290b49e696f3ddff8585d4910f6ed0" />
    <meta property="og:description" content="엠테라파마는 다중 성분 천연물 소재를 만성 난치성 질환의 다중타겟에 활용하여 질환을 근원적으로 치료하는 혁신적 신약 (Multi-Target-driven Innovative Therapeutics)을 개발하는 벤처회사입니다.">
    <meta property="description" content="엠테라파마는 다중 성분 천연물 소재를 만성 난치성 질환의 다중타겟에 활용하여 질환을 근원적으로 치료하는 혁신적 신약 (Multi-Target-driven Innovative Therapeutics)을 개발하는 벤처회사입니다.">
    <meta name="keywords" content="엠테라파마, mthera pharma, 손미원, 신약개발, 제약회사, 천연물신약개발, 천연물신약, 난치성 질환, 제약 벤처">
    <meta name="description" content="엠테라파마는 다중 성분 천연물 소재를 만성 난치성 질환의 다중타겟에 활용하여 질환을 근원적으로 치료하는 혁신적 신약 (Multi-Target-driven Innovative Therapeutics)을 개발하는 벤처회사입니다.">
    <title>엠테라파마 (MTHERA PHARMA)</title> 
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
