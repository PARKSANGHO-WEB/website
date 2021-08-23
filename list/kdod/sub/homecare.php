<? include "../include/header_sub.php"?>
<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
<script src="../js/jquery.mCustomScrollbar.js"></script>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 

    <section class="homecare">
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
                            <a href="./homecare.php">Homecare</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Public</span>
                    <span class="ban-text">Cosmetic, <strong>Homecare</strong>, Point-mall Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li>
                        <a href="./cosmetic.php">Cosmetic</a>
                    </li>
                    <li class="active">
                        <a href="./homecare.php">Homecare</a>
                    </li>
                    <li>
                        <a href="./point-mall.php">Point-mall</a>
                    </li>
                </ul>
            </div>
        </div>
<?
$goods_value = "Homecare";
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
                <p>Homecare Products</p>
                <span class="s-text">
                	K-DOD introduces <span class="dot">HOMECARE products </span>which will help to improve your quality of life and health. <br />By having our HOMECARE products at home, you will experience good professional care without visiting hospitals. <br />Provide the best private care to your skin and body!
                </span>
            </div>
            <div class="search-line">
			<form name="s_mem" id="s_mem" method="post" action="homecare.php">
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
					<li class="item-box <?if($row[goods_name_eng] !="OPERA LEBODY LED MASK (GOLD)") echo 'item-box2';?>"  onclick="javascript:go_view('<?=$row[idx]?>','<?=$row[goods_value]?>','<?=$row[goods_type]?>');">
                        <div class="item-img <?if($row[goods_name_eng] !="OPERA LEBODY LED MASK (GOLD)") echo 'item-img';?>">
                            <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name"><?=nl2br($row[goods_name_eng])?></p>
								<div class="list-rd content-rd">
								<div class="item-ex1">
									<?=stripslashes($row[goods_content_eng])?>
								</div>
								<div class="item-ex2">
								<?=stripslashes($row[goods_content_eng2])?>
								</div>
							 </div>
						   </div>
                        </div>
                    </li> 
				<?}?>

                    <!-- <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/homec-1.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">OPERA LEBODY<br /> LED MASK (GOLD)</p>
								<div class="item-ex1">
									<p>Premium wide volume LED Mask for<br /> Face and Neck Skin Care</p>
									<p>·Home skin care device</p>
									<p>·Face : 78pcs (156 wavelengths)</p>
									<p>·Neck : 36pcs (72 wavelengths)</p>
									<p>·Clinically proven effect</p>
								</div>
								<div class="item-ex2">
									<p class="item-regi">Registered : US FDA, CE, CVC</p>
									<p class="item-power">Power Consumption : 6W</p>
									<p class="item-size">Size : 265mm x 275mm x 290mm</p>
									<p class="item-weight">Weight : 565g (Incl. controller)</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/homec-2.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">LEBODY FACE + LEBODY BU:w<br /> Renewal Up Cream</p>
								<div class="item-ex1">
									<p>Micro electric current Ion for face<br /> + Skin moisturizing cream</p>
									<p>·Improve lifting & Elasticity of skin</p>
									<p>·Lebody Face : Utmost anti-aging care</p>
									<p>·Cream : Moisturizing, Calming & Nutrition</p>
								</div>
								<div class="item-ex2">
									<p class="item-regi">Registered : US FDA, CE, CVC </p>
									<p class="item-size">Size : 142mm x 51mm x 41mm</p>
									<p class="item-weight">Weight : 138g</p>
									<p class="item-weight">Cream : 80mL</p>
								</div>
						   </div>
                        </div>
                    </li>
                    
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/homec-3.png" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">GO SLEEP</p>
								<div class="item-ex1">
									<p>Premium Sleep Appliance</p>
									<p>·Direct sleep inducement effect</p>
									<p>·Shortening the time to fall asleep</p>
									<p>·Increasing CO2 partial pressure</p>
									<p>·Individualized setting</p>
									<p>·Safety : 2 human beta tests completed  &<br /> tolerant to long-term use</p>
								</div>
								<div class="item-ex2">
									<p class="item-size">Size : 220mm(W) x 220mm(D) x 820mm(H)</p>
									<p class="item-weight">Consumables : Cylinder, Aroma Scent Kit,<br /> Solid Oxygen</p>
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