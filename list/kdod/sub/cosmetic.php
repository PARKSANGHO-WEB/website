<? include "../include/header_sub.php"?>
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
	<script src="../js/jquery.mCustomScrollbar.js"></script>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 
    
    
    <section class="cosme">
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
                            <a href="./cosmetic.php">Cosmetic</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Public</span>
                    <span class="ban-text"><strong>Cosmetic</strong>, Homecare, Point-mall Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li class="active">
                        <a href="./cosmetic.php">Cosmetic</a>
                    </li>
                    <li>
                        <a href="./homecare.php">Homecare</a>
                    </li>
                    <li>
                        <a href="./point-mall.php">Point-mall</a>
                    </li>
                </ul>
            </div>
        </div>

<?
$goods_value = "Cosmetic";
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
                <p>Cosmetic Products</p>
                <span class="s-text">
                    K-DOD approaches very carefully in cosmetic products selection. <br />All cosmetic products that we introduce are made by <span class="dot"> Korea Medical Companies</span> and approved from many countries’ governments such as Korea, Europe, US and Asia.<br />
                    Our cosmetic products are all premium lines with proven effects and safety, but still in reasonably affordable price.
                </span>
            </div>
            <div class="search-line">
			<form name="s_mem" id="s_mem" method="post" action="cosmetic.php">
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

			<li class="item-box <?if($row[goods_name_eng] !="LEBODY SERUMS") echo 'item-box2';?>" onclick="javascript:go_view('<?=$row[idx]?>','<?=$row[goods_value]?>','<?=$row[goods_type]?>');">
                        <div class="item-img <?if($row[goods_name_eng] !="LEBODY SERUMS") echo 'item-img';?>">
                            <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name"><?=string_cut2(stripslashes($row[goods_name_eng]),70)?> </p>
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
					<?
						}
					?>
                    <!-- <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/cos-1.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">LEBODY SERUMS </p>
								<div class="item-ex1">
									<p class="ext">5 Types Serum</p>
									<p>·GOLD 24 : Skin Vitality</p>
									<p>·IDEBENON : Antioxidant</p>
									<p>·HYALURONIC : Moisturizing</p>
									<p>·BTX COLLAGEN : Elasticity</p>
									<p>·PEPTIDE : Elasticity & Brightness</p>
								</div>
								<div class="item-ex2">
									<p class="item-size">Volume : 30ml/ each</p>
									<p class="item-weight">Ingredients : See detailed page</p>
									<p class="item-spe">Storage: 36 months (3 m after opening)</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-2.png" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">LEBODY COOL CREAM </p>
								<div class="item-ex1">
									<p class="ext">Body Massager Cream</p>
									<p>·Cool cream with convenient and <br />Effective massage balls</p>
									<p>·Effective penetration into the skin</p>
									<p>·Helping smooth the orange skin</p>
									<p>·Menthol : Relief of Calf Swelling</p>
								</div>
								<div class="item-ex2">
									<p class="item-size">Volume : 130ml</p>
									<p class="item-weight">Ingredients : Adipoless, <br />Botaniceutical plus -10, Slimatevia, <br />Oriental Beauty Fruit new plex, Menthol</p>
									<p class="item-spe">Storage : 2 years (6m after opening)</p>
								</div>
						   </div>
                        </div>
                    </li>
                    
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-3.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">DERMA MAX line</p>
								<div class="item-ex1">
									<p class="ext">3 steps brightening system - <span><br /> prevention, pigmentation & <br />regeneration brightening</span></p>
									<p>·Derma Max Brightening Serum</p>
									<p>·Derma Max Brightening Cream</p>
									<p>·Derma Max Brightening Clinic</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-4.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">PREMIUM ACTIVE line </p>
								<div class="item-ex1">
									<p class="ext">Tightening, Wrinkle care and <br />Rich nourishment</p>
									<p>·Premium Active Revival Essence</p>
									<p>·Premium Active Botol Ampoule</p>
									<p>·Premium Active Eternal Eye & Face Cream</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-5.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">PURE BALANCE line</p>
								<div class="item-ex1">
									<p class="ext">Expert Cleansing Line <span> based on<br /> advanced bio-fermentation technology</span></p>
									<p>·Micellar Gentle Lip & Eye Remover</p>
									<p>·Papaya Enzyme Peeing Wash</p>
									<p>·Refreshing Cleansing Milk</p>
									<p>·Refreshing Cleansing Gel</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-6.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">A.C CLEARING line</p>
								<div class="item-ex1">
									<p class="ext">Clearing & Refining products for acne, <br />congested pores and oily skin</p>
									<p>·Purifying Cleansing Gel</p>
									<p>·Active Control Solution</p>
									<p>·Active Control Moisturizer</p>
									<p>·Active Control Cream</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-7.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">MOISTURE MAX line</p>
								<div class="item-ex1">
									<p class="ext">3 steps moisturizing system - <span> <br />hydrating, nourishing & protecting</span></p>
									<p>·Moisture Max Aqua Mist</p>
									<p>·Moisture Max Hydro Moisturizer</p>
									<p>·Moisture Max Hydro Cream</p>
									<p>·Moisture Max Cleansing Form</p>
								</div>
						   </div>
                        </div>
                    </li>
                    
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-8.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">POST RAYS line</p>
								<div class="item-ex1">
									<p class="ext">Reinforcing and protecting skins</p>
									<p>·Derma Regener K Solution</p>
									<p>·Derma Regener Moisturizer</p>
									<p>·Derma Regener K Cream</p>
									<p>·Derma Regener Cell Cream</p>
									<p>·Chamomile Soothing Gel</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-9.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">BIO CELL FLUID line</p>
								<div class="item-ex1">
									<p class="ext">Highly functional solution that<br /> rejuvenates skin tissue</p>
									<p>·Max Bio Cell Moisturizing Fluid</p>
									<p>·Bio Cell Purifying Fluidr</p>
									<p>·Derma Regener K Cream</p>
									<p>·Bio Cell Brightening Fluid</p>
									<p>·Bio Cell Peptide Fluid</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-10.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">AMPOULE line</p>
								<div class="item-ex1">
									<p class="ext">Concentrated serums that quickly boost <br />nutrient levels & elasticity</p>
									<p>·Chamomile Complex 70% Ampoule</p>
									<p>·Hyaluronic Complex 65% Ampoule</p>
									<p>·Tea Tree Complex 60% Ampoule</p>
									<p>·Bio Cell Brightening Fluid</p>
									<p>·Vitamin-C Complex 50% Ampoule</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-11.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">PROTECT line</p>
								<div class="item-ex1">
									<p class="ext">Safeguards against UV damage</p>
									<p>·Post Rays UV Protect Sun Block<br /> SPF50+ PA+++</p>
									<p>·Post Rays Blemish Balm SPF36 PA++</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-12.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">E+ EPIDERMA MASK</p>
								<div class="item-ex1">
									<p class="ext">Mask packs for personal homecare & <br />professional uses</p>
									<p>·+e Epiderma Nova Cell Soothing Mask</p>
									<p>·+e Epiderma Nova Cell Brightening Mask</p>
									<p>·Professional masks</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-13.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">PURE AMPOULE line</p>
								<div class="item-ex1">
									<p class="ext">Highly functional ampoules<br />
									<span>(can be used with MTS treatment)</span>
									</p>
									<p>·Derma Max Pure Vitamin-C</p>
									<p>·Premium Active Pure Collagen</p>
								</div>
						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/cos-14.jpg" alt="">
                        </div>
                        <div class="item-info">
							<div class="info-ab">
								<p class="item-name">R20 INTENSE Ampoule</p>
								<div class="item-ex1">
									<p class="ext">High concentrated ampoules that<br /> rejuvenate skin vitality like the 20s
									<span><br />(can be used with mesotherapy, MTS, <br />iontophoresis, ultrasound)</span>
									</p>
									<p>·R20 Intense Bird’s Nest &<br /> Sodium DNA Ampoule</p>
									<p>·R20 Intense Multi-Threat<br /> Reversing Ampoule</p>
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