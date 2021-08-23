<? include "../include/header_sub.php"?>
 <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
 <script src="../js/jquery.mCustomScrollbar.js"></script>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 

    <section class="derma">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="javascript:;">Products for Doctor</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="./dermatology.php">Dermatology</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Doctor</span>
                    <span class="ban-text"><strong>Dermatology</strong>, Dental, Ophthalmology Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li class="active">
                        <a href="./dermatology.php">Dermatology</a>
                    </li>
                    <li>
                        <a href="./dental.php">Dental</a>
                    </li>
                    <li>
                        <a href="./ophthal.php">Ophthalmology</a>
                    </li>
                </ul>
            </div>
        </div>
<?
$goods_value = "Dermatology";
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
                <p>Dermatology, Skin Care, Aesthetic Care Products </p>
                <span class="s-title">
                    Providing dermatology skin aesthetic products to doctors in professional purposes
                </span>
                <span class="s-text">
                    <span class="dot">·</span>for the people who have trouble or problem with skins
                </span>
                <span class="s-text">
                    <span class="dot">·</span>for the people who desire to have good skins as if they originally had
                </span>
                <span class="s-text">
                    <span class="dot">·</span>for the people who want to have healthier body shape
                </span>
            </div>
            <div class="search-line">
			<form name="s_mem" id="s_mem" method="post" action="dermatology.php">
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
					<li class="item-box <?if($row[goods_name_eng] !="LESHAPE") echo 'item-box2';?>" onclick="javascript:go_view('<?=$row[idx]?>','<?=$row[goods_value]?>','<?=$row[goods_type]?>');">
                        <div class="item-img <?if($row[goods_name_eng] !="LESHAPE") echo 'item-img';?>">
                            <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        </div>
                       <div class="item-info">
            				<p class="item-name"><?=string_cut2(stripslashes($row[goods_name_eng]),70)?></p>
						   <div class="list-rd content-rd">
							   <div class="info-ab">
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
				
           <!--  <div class="item-list">
                <ul>
                    <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/thumb1.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
            								<p class="item-name">LESHAPE</p>
            								<div class="item-ex1">
            									<p>The new concept of diode laser system using 1060nm for BODY</p>
            									<p>·Practical apppcator frames</p>
            									<p>·4 Handpieces</p>
            									<p>·Superior contact coopng & heating</p>
            									<p>·25mins treatment time</p>
            								</div>
            								<div class="item-ex2">
            									<p class="item-size">Size : 885mm(W) x 865mm(D) x 1350mm(H)</p>
            									<p class="item-weight">Weight : 85Kg (Full package)</p>
            									<p class="item-spe">Laser diode power : 60W Max</p>
            								</div>
            						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/thumb2.png" alt="">
                        </div>
                        <div class="item-info">
            							<div class="info-ab">
            								<p class="item-name">INSHAPE</p>
            								<div class="item-ex1">
            									<p>New generation of Electromagnetic system<br /> for BODY shaping</p>
            									<p>·Effective both on muscle & fat</p>
            									<p>·Non-invasive & no pain </p>
            									<p>·30mins treatment time</p>
            								</div>
            								<div class="item-ex2">
            									<p class="item-size">Size : 460mm(W) x 590mm(D) x 1280mm(H)</p>
            									<p class="item-weight">Weight : 66Kg</p>
            									<p class="item-spe">Power Consumption : 2.3kVA</p>
            								</div>
            						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/thumb3.png" alt="">
                        </div>
                        <div class="item-info">
            							<div class="info-ab">
            								<p class="item-name">ABAS-ONE</p>
            								<div class="item-ex1">
            									<p>One shot HIFU system for FACE</p>
            									<p>·High Intensity Focused Ultrasound</p>
            									<p>·Lifting and toning at once</p>
            									<p>·Better effect and less pain comparing <br />to conventional lifting system</p>
            									<p>·Easier to treat Handpiece for difficult areas<br /> such as periorbital areas</p>
            								</div>
            								<div class="item-ex2">
            									<p class="item-size">Size : Cartridge 3.0mm, 4.5mm<br />(1.5mm, 6.5mm Option)</p>
            									<p class="item-weight">Weight : -Frequency : 7MHz, 4MHz</p> 
            								</div>
            						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/thumb4.png" alt="">
                        </div>
                        <div class="item-info">
            							<div class="info-ab">
            								<p class="item-name">D-COOL</p>
            								<div class="item-ex1">
            									<p>3 Functional Cryo-Electroporation system <br />for effective POST CARE</p>
                                <p>·Electroporation + Cooling + Heating</p>
                                <p>·Possible to combine with all kinds of <br />solutions</p>
                                <p>·Reduce downtime & PHI risk after <br />Laser / MTS treatment</p>
                                <p>·Compact handpiece</p>
            								</div>
            								<div class="item-ex2">
            									<p class="item-size">Size : 270mm(W) x 245mm(D) x 175mm(H)</p>
            									<p class="item-weight">Weight : 2.8Kg (main unit only)</p>
            									<p class="item-spe">Power Input : 72W Max</p>
            								</div>
            						   </div>
            						</div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/thumb5.png" alt="">
                        </div>
                        <div class="item-info">
            							<div class="info-ab">
            								<p class="item-name">PEPBU:W+</p>
            								<div class="item-ex1">
            									<p>3 Functional Cryo-Electroporation system for effective POST CARE</p>
            									<p>·Hospital specializing product</p>
            									<p>·High concentration of peptide</p>
            									<p>·Lifting & Wrinkle, Brightening and Skin<br /> Regeneration</p>
            									<p>·Before & after professional skin care</p>
            								</div>
            						   </div>
            						</div>
                    </li>
                </ul>
            </div> -->

				</ul>
            </div>
            <div class="paging">
                <span class="paging-wrap">
                   <!--  <a href="javascript:;">
                        <img class="two" src="../img/b-all.png" alt="">
                    </a>
                    <a href="javascript:;">
                        <img class="one" src="../img/b-al.png" alt="">
                    </a>
                    <a href="javascript:;">
                        1
                    </a>
                    <a href="javascript:;">
                        <img class="one" src="../img/b-ar.png" alt="">
                    </a>
                    <a href="javascript:;">
                        <img class="two" src="../img/b-arr.png" alt="">
                    </a> -->
					<?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front2.php";?>
                </span>
            </div>
        </div>
        <div class="bottom-list">
            <p class="bottom-title">
                Recommended skin protocol by Korean doctors
            </p>
            <div class="bottom-item">
                <ul>
                    <li>
                        <div class="bi-wrap">
                            <img src="../img/sub/b-thumb1.png" alt="">
                        </div>
                        <div class="bi-title">
                            <span>Before Tx</span>
                        </div>
                        <div class="bi-text">
                            <span>Cleansing</span>
                        </div>
                    </li>
                    <li>
                        <div class="bi-wrap">
                            <img src="../img/sub/b-thumb2.png" alt="">
                        </div>
                        <div class="bi-title">
                            <span>Treatment</span>
                        </div>
                        <div class="bi-text">
                            <span>Laser or other Main Skin Treatment</span>
                        </div>
                    </li>
                    <li>
                        <div class="bi-wrap">
                            <img src="../img/sub/b-thumb3.png" alt="">
                        </div>
                        <div class="bi-title">
                            <span>After care-1</span>
                        </div>
                        <div class="bi-text">
                            <span>PEPBU:W+</span>
                        </div>
                    </li>
                    <li>
                        <div class="bi-wrap">
                            <img src="../img/sub/b-thumb4.png" alt="">
                        </div>
                        <div class="bi-title">
                            <span>After care-2</span>
                        </div>
                        <div class="bi-text">
                            <span>D-COOL</span>
                        </div>
                    </li>
                    <li>
                        <div class="bi-wrap">
                            <img src="../img/sub/b-thumb5.png" alt="">
                        </div>
                        <div class="bi-title">
                            <span>After care-3</span>
                        </div>
                        <div class="bi-text">
                            <span>Calming mask</span>
                        </div>
                    </li>
                </ul>
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