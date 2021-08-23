<? include "../include/header_sub.php"?>
<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
<script src="../js/jquery.mCustomScrollbar.js"></script>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 
    
    
    <section class="pointmall">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">Products for Public</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="./point-mall.php">Point-mall</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Public</span>
                    <span class="ban-text">Cosmetic, Homecare, <strong>Point-mall</strong> Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li>
                        <a href="./cosmetic.php">Cosmetic</a>
                    </li>
                    <li>
                        <a href="./homecare.php">Homecare</a>
                    </li>
                    <li class="active">
                        <a href="./point-mall.php">Point-mall</a>
                    </li>
                </ul>
            </div>
        </div>
<?
$goods_value = "Pointmall";
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$search = sqlfilter($_REQUEST['search']);

$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&search='.$search.'&goods_value='.$goods_value;

if(!$pageNo){
	$pageNo = 1;
}


if ($goods_value){
	$where .= "and goods_value = '".$goods_value."'";
}

if ($search){	
	$where .= "and goods_name_eng like '%".$search."%'";
}


$pageScale = 10; // 페이지당 20 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY write_time asc ";


$query = "select * from goods_info where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;
//echo $query;
$query_cnt = "select idx from goods_info  where 1=1 ".$where;

$result = mysqli_query($gconnet,$query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);

//echo $num;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;

?>

<SCRIPT LANGUAGE="JavaScript">
	
	function go_search() {
		if(!frm_page.field.value || !frm_page.keyword.value) {
			alert("검색조건 또는 검색어를 입력해 주세요!!") ;
			exit;
		}
		frm_page.submit();
	}

	function go_view(no,gubun,gtype){
		if(gtype=='1'){				
		location.href = "products_derma1.php?idx="+no+"&goods_value="+gubun+"&goods_type="+gtype+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&search=<?=search?>";
		}else if(gtype=='2'){
		location.href = "products_derma2.php?idx="+no+"&goods_value="+gubun+"&goods_type="+gtype+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&search=<?=search?>";
		}else if(gtype=='3'){
		location.href = "products_derma3.php?idx="+no+"&goods_value="+gubun+"&goods_type="+gtype+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&search=<?=search?>";
		}else if(gtype=='4'){
			alert('comming soon!!');
			exit;
		}else if(gtype=='5'){
		location.href = "products_derma5.php?idx="+no+"&goods_value="+gubun+"&goods_type="+gtype+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&search=<?=search?>";
		}
	}


	</script>
        <div class="derma-list">
            <div class="dl-top">
                <p>Point-mall Products</p>
                <span class="s-text">
                	K-DOD introduces various Korean products to help you to use your K-DOD points more conveniently.<br />Most products that we introduce in this mall are ‘<span class="dot">Made in Korea</span>’ and professionally qualified.<br /> You cannot compare with any other similar products in your markets as those products are unique and high quality. <br />
					We will keep updating point mall items with premium Korean products with reasonably affordable prices

                </span>
            </div>
            <div class="search-line">
			<form name="s_mem" id="s_mem" method="post" action="point-mall.php">
			<input type="hidden" name="mode" value="ser">
						<input type="hidden" name="goods_value" value="<?=$goods_value?>"/>
						<input type="hidden" name="bmenu" value="<?=$bmenu?>"/>
						<input type="hidden" name="smenu" value="<?=$smenu?>"/>
                <div class="numbering">
                    <span class="nb-title">Total </span><span>:</span>
                    <span class="nb-count"><?=$num?></span>
                </div>
                <div class="search-t">
                    <input type="search" name="search" id="search" value="<?=$search?>">
                    <button type="button" onclick="s_mem.submit();"><img src="../img/sub/search.svg" alt=""></button>
                </div>
				</form>
            </div>
            <div class="item-list">
                <ul>
				 <?
			for ($i=0; $i<mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_array($result);
				$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;

				$sql_file = "select file_org,file_chg from goods_file where 1=1 and goods_idx='".$row['idx']."' order by idx asc limit 0,1";
				//echo $sql_file;
				$query_file = mysqli_query($gconnet,$sql_file);
				$row_file = mysqli_fetch_array($query_file);

			?>
				<li class="item-box" onclick="javascript:go_view('<?=$row[idx]?>','<?=$row[goods_value]?>','<?=$row[goods_type]?>');">
                        <div class="item-img">
                            <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name"><?=$row[goods_name_eng]?></p>
								<div class="list-rd content-rd">
								<div class="item-ex1">
								<?=stripslashes($row[goods_content_eng])?>
								</div>
								</div>
<!--
								<div class="item-ex2">
									<p class="item-point"><?=stripslashes($row[goods_content_eng2])?></p>
								</div>
-->
						   </div>
                        </div>
                    </li>
				<?}?>
			
                    <!-- <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m1.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Smartphone Grip <span>(PM001)</span></p>
								<div class="item-ex1">
									<p>·Color : Pink, Blue green</p>
									<p>·Made in Korea</p>
									<p>·Material : TPU, PC</p>
									<p>·Size : 40 x 5 mm</p>
									<p>·Weight : 15g</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">4,500 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m2.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Premium Eco Bag<span>(PM002)</span></p>
								<div class="item-ex1">
									<p>·Color : Beige, Black</p>
									<p>·Made in Korea</p>
									<p>·Material : Cotton 10 Ply</p>
									<p>·Size : 360 x 360 mm</p>
									<p>·Strap : 30 x 550 mm</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">8,500 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m3.jpg" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Shell Point Nail Care Set<span>(PM003)</span></p>
								<div class="item-ex1">
									<p>·Color : White, Black</p>
									<p>·Made in Korea (Patented)</p>
									<p>·Material : Cotton 10 Ply</p>
									<p>·Size : 111 x 71 x 15 mm</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">10,500 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m4.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Eco Friendly Dry Bag 3L<span>(PM004)</span></p>
								<div class="item-ex1">
									<p>·Color : Green, Blue, Grey</p>
									<p>·Made in Korea (Patented)</p>
									<p>·Material : Eco friendly PVC</p>
									<p>·Size : 250 x 420 mm</p>
									<p>·Weight : 74g</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">10,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m5.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Free Brief Case<span>(PM005)</span></p>
								<div class="item-ex1">
									<p>·Color : Grey, Blue</p>
									<p>·Made in Korea</p>
									<p>·Material : Fabric</p>
									<p>·Size : 330 x 370 mm</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">11,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m6.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Mini Bear Air Freshener<span>(PM006)</span></p>
								<div class="item-ex1">
									<p>·Color : White, Pink, Black</p>
									<p>·Made in Korea (Handmade)</p>
									<p>·Material : Plaster, Aluminum, Chamois Suede</p>
									<p>·Size : 45 x 62 x 27 mm</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">13,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m7.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Hard Carrier Pouch<span>(PM007)</span></p>
								<div class="item-ex1">
									<p>·Color : Black, Pink, Green, Yellow</p>
									<p>·Made in Korea (OEM)</p>
									<p>·Material : PC, ABS (Hard Carrier), Poly (Lining)</p>
									<p>·Size : 190 x 120 x 60 mm</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">14,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m8.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Agatha Long Umbrella<span>(PM008)</span></p>
								<div class="item-ex1">
									<p>·Color : Pink, Mint</p>
									<p>·France (OEM in China)</p>
									<p>·Material : PC, ABS</p>
									<p>·Size : 60cm x 14k (total length 79.5cm)</p>
									<p>·Weight : 455g</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">18,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/point-m9.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">Agatha Long Umbrella<span>(PM009)</span></p>
								<div class="item-ex1">
									<p>·Color : Blue, White</p>
									<p>·Made in Korea</p>
									<p>·Material : PC, ABS</p>
									<p>·Size : 210 x 25cm x 50 mm</p>
									<p>·Weight : 100g</p>
								</div>
								<div class="item-ex2">
									<p class="item-point">20,000 Point</p>
								</div>
						   </div>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="paging">
                <span class="paging-wrap">
                 <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front2.php";?>
                </span>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){           
            
            
            $('.visual-slider').bxSlider({
              auto: true,
              pager: true,
              mode: 'fade',
              hideControlOnEnd:true
            });
            
            $('.cont1-slider').bxSlider({
              auto: true,
              pager: true,
              hideControlOnEnd:true
            });
        });
        
        
        
    </script>
    
    <script>
		$(document).ready(function(){
			var iiheight = $('.item-info').height();
			var iaheight = $('.info-ab').height();
			
			if( iaheight > iiheight ){
				$(iiheight).height(iaheight);
			}
			
			
		});
	</script>
	<script>


		$(document).ready(function(){

			$(".content-rd").mCustomScrollbar({
					theme:"light-3"
				});
			});
	</script>
    
	<? include "../include/footer_sub.php"?>