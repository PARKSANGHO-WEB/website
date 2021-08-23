<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/slick.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/modal-b.css">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <meta charset="UTF-8">
    <title>K-DOT</title>
    <link rel="stylesheet" href="../css/products_doctorBuy2.css">
    <style>
        
/*        상단 배너 배경 이미지 변경*/
        section.about-busy .sub-banner {
            background: url('../img/sub/derma_ban.png');
        }
    </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/slick.js"></script>
	<script src="../js/jquery.mCustomScrollbar.js"></script>
    <script src="../js/common.js"></script>
</head>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>

      <? include "../include/gnb_sub1.php"?> 
<!--


    <section class="about-busy">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.html">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="#">Products for Doctor</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="dermatology.html">Dermatology</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Doctor</span>
                    <span class="ban-text">Dermatology, Dental, Ophthalmology Products</span>
                </div>
            </div>
        </div>
    </section>
-->

<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$search = sqlfilter($_REQUEST['search']);
$goods_value = trim(sqlfilter($_REQUEST['goods_value']));
$goods_type = trim(sqlfilter($_REQUEST['goods_type']));
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&search='.$search.'&goods_value='.$goods_value;

$query = "select * from goods_info where idx='".$idx."' and  goods_value = '".$goods_value."' and  goods_type = '".$goods_type."'";
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);
?>
    <div id="products2">
		<div class="header cf">
			
		    <div id="prod_pic">
				<div class="slider slider-for">

				<?
			$i=1;
			$sql_file = "select file_org,file_chg from goods_file where 1=1 and goods_idx='".$row['idx']."' order by idx asc";
			$query_file = mysqli_query($gconnet,$sql_file);
			while($row_file = mysqli_fetch_array($query_file)){
			?>
			<div class="img-big"><img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt=""></div>
			<?
			}
			?>
					<!-- <div class="img-big"><img src="../img/sangse/derma-2c1.png" alt=""></div>
					<div class="img-big"><img src="../img/sangse/derma-2c2.png" alt=""></div>
					<div class="img-big"><img src="../img/sangse/derma-2c3.png" alt=""></div>
					<div class="img-big"><img src="../img/sangse/derma-2c4.png" alt=""></div>
					<div class="img-big"><img src="../img/sangse/derma-2c5.png" alt=""></div> -->
				</div>
		        <div class="slider slider-nav">

				<?
			$i=1;
			$sql_file = "select file_org,file_chg from goods_file where 1=1 and goods_idx='".$row['idx']."' order by idx asc";
			$query_file = mysqli_query($gconnet,$sql_file);
			while($row_file = mysqli_fetch_array($query_file)){
			?>
			<div class="img-sm"><img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt=""></div>
			<?
			}
			?>
					<!-- <div class="img-sm"><img src="../img/sangse/derma-2c1.png" alt=""></div>
					<div class="img-sm"><img src="../img/sangse/derma-2c2.png" alt=""></div>
					<div class="img-sm"><img src="../img/sangse/derma-2c3.png" alt=""></div>
					<div class="img-sm"><img src="../img/sangse/derma-2c4.png" alt=""></div>
					<div class="img-sm"><img src="../img/sangse/derma-2c5.png" alt=""></div> -->
		        </div>
		    </div>
			<script>

				$(document).ready(function(){
					$('.slider-for').slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false,
						fade: true,
						asNavFor: '.slider-nav',
						  autoplay: true,
						  autoplaySpeed: 2000
					});
					$('.slider-nav').slick({
						slidesToShow: 6,
						slidesToScroll: 1,
						asNavFor: '.slider-for',
						dots: false,
						centerMode: true,
						focusOnSelect: true,
						arrows: false,
						autoplay: true,
						autoplaySpeed: 2000
					});
				});


			</script>
		    <section id="desc">
		        <p class="cont-r"><?=$row[goods_name_eng]?></p>
		        <article class="info">
		            <p>
		               <?=$row[goods_content_eng]?>
		            </p>
		        </article>
		        <article class="size">
		            <p class="color">
		                	<?
							if($row[goods_content_ok]=="사용함"){
						?>
						<?=$row[goods_content_eng2]?>
						<?}?>
		            </p>
		        </article>
		    </section>
		</div>
<?
$sql_file2 = "select * from goods_info2 where 1=1 and goods_idx='".$row['idx']."' order by idx asc";
$query_file2 = mysqli_query($gconnet,$sql_file2);
$row_file2 = mysqli_fetch_array($query_file2);
?>		
		<section class="Line">
            <p  class="cont-r">Line Introduction</p>
			<?
				if($row[key_str_view_ok1]=="사용함" || $row[key_str_view_ok1_1]=="사용함"){
			?>
			<article class="type1 cf">
		       <div class="img">
				   <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['key_str_img_c1']?>" alt="">
		        </div>
		        <div class="r_text">
				<div class="text-w content-rd">
		            <?=stripslashes($row['key_str_content_eng1'])?>
                 </div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[key_str_view_ok2]=="사용함" || $row[key_str_view_ok2_1]=="사용함"){
			?>
		    <article class="type2 cf">
		        <div class="img">
				   <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['key_str_img_c2']?>" alt="">
		        </div>
		        <div class="l_text">
				<div class="text-w content-rd">
		             <?=stripslashes($row['key_str_content_eng2'])?>
		        </div>
				</div>
		    </article>
			<?}?>
        </section>
        
        <section class="items">
            <p  class="cont-r">Individual Items</p>
		    <?
				if($row[treatment_view_ok1]=="사용함" || $row[treatment_view_ok1_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c1']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c1_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng1'])?>
					</div>	
		            </div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng1_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng1_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok2]=="사용함" || $row[treatment_view_ok2_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c2']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c2_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng2'])?>
		            </div>
					</div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng2_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng2_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok3]=="사용함" || $row[treatment_view_ok3_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c3']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c3_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng3'])?>
		            </div>
					</div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng3_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng3_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok4]=="사용함" || $row[treatment_view_ok4_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c4']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c4_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng4'])?>
		            </div>
					</div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng4_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng4_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok6]=="사용함" || $row[treatment_view_ok6_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c6']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c6_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng6'])?>
		            </div>
					</div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng6_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng6_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok7]=="사용함" || $row[treatment_view_ok7_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c7']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c7_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng7'])?>
		            </div>
					</div>
		            <div class="txt2">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng7_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng7_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
			<?}?>
			<?
				if($row[treatment_view_ok8]=="사용함" || $row[treatment_view_ok8_1]=="사용함"){
			?>
			<article class="content">
		        <div class="img-w cf">
	            	<div class="img img-left">
					 <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c8']?>" alt="">
	            	</div>
	            	<div class="img img-right">
					  <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c8_1']?>" alt="">
	            	</div>
		        </div>
		        <div class="text cf">
		            <div class="txt1">
					<div class="text-w content-rd">
		                 <?=stripslashes($row['treatment_content_eng8'])?>
		            </div>
					</div>
		            <div class="txt2">
		            <div class="text-w content-rd">
						<?=stripslashes($row['treatment_content_eng8_1'])?>
		            </div>
					</div>
		            <div class="txt3">
					<div class="text-w content-rd">
		                <?=stripslashes($row['treatment_content_eng8_2'])?>
		            </div>
					</div>
		        </div>
		    </article>
        </section>
        <?
			}
		?>
		<?
				if($row[treatment_view_ok5]=="사용함" || $row[treatment_view_ok5_1]=="사용함"){
			?>
        <section class="For cf">
           <div class="img">
				<img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file2['treatment_img_c5']?>" alt="">
           </div>
            <div class="text">
			<div class="text-w content-rd">
             <?=stripslashes($row['treatment_content_eng5'])?>
            </div>
			</div>
        </section>
		<?}?>
		    <div class="return">
        	<button type="button" onclick="javascript:history.back();">List</button>
        </div>
    </div>

    <script>


		$(document).ready(function(){

			$(".content-rd").mCustomScrollbar({
					theme:"light-3"
				});
			});
	</script>
	
<? include "../include/footer_sub.php"?>
</body>
</html>