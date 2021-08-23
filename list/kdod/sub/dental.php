<? include "../include/header_sub.php"?>
   <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
   <script src="../js/jquery.mCustomScrollbar.js"></script>

<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 
    
    <section class="dental">
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
                            <a href="./dental.php">Dental</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Doctor</span>
                    <span class="ban-text">Dermatology, <strong>Dental</strong>, Ophthalmology Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li>
                        <a href="./dermatology.php">Dermatology</a>
                    </li>
                    <li class="active">
                        <a href="./dental.php">Dental</a>
                    </li>
                    <li>
                        <a href="./ophthal.php">Ophthalmology</a>
                    </li>
                </ul>
            </div>
        </div>
<?
$goods_value = "Dental";
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
			alert('준비중 입니다.');
			exit;
		}else if(gtype=='5'){
		location.href = "products_derma5.php?idx="+no+"&goods_value="+gubun+"&goods_type="+gtype+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&search=<?=search?>";
		}
	}

	</script>

        <div class="derma-list">
            <div class="dl-top">
                <p>Dental Care Products</p>
                <span class="s-text">
                    K-DOD brings high quality of Korean dental clinic products for professional treatment.<br />
                    Due to COVID-19, we temporarily hold off medical products sales. For any questions or suggestions, go to <a href="./board_FAQ_input.php">QA/Board</a> 
                </span>
            </div>
            <div class="search-line">
			<form name="s_mem" id="s_mem" method="post" action="dental.php">
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
					 
					 <li class="item-box <?if($row[goods_name_eng] !="Dental Handpiece") echo 'item-box2';?>" onclick="javascript:go_view('<?=$row[idx]?>','<?=$row[goods_value]?>','<?=$row[goods_type]?>');">
                        <div class="item-img <?if($row[goods_name_eng] !="Dental Handpiece") echo 'item-img';?>">
                            <img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        </div>

                        <div class="item-info">
                            <div class="info-ab">
                    		<p class="item-name"><?=string_cut2(stripslashes($row[goods_name_eng]),70)?></p>
                    		<div class="list-rd content-rd">
							<div class="item-ex1">
                    			<?=stripslashes($row[goods_content_eng])?>
                    		</div>
							</div>
							<p class="cm-soon">
									<?=stripslashes($row[goods_content_eng2])?>
								</p>
                    	 </div>
                        </div>
                    </li>
				<?
					}
				?>
                    <!-- <li class="item-box">
                        <div class="item-img">
                            <img src="../img/sub/dental_1.png" alt="">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
                    								<p class="item-name">Dental Handpiece</p>
                    								<div class="item-ex1">
                    									<p>·High speed handpiece</p>
                    									<p>·Low speed handpiece</p>
                    									<p>·Surgical handpiece</p>
                    								</div>
                    						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/dental_2.png" alt="">
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">BRACKETS</p>
                    								<div class="item-ex1">
                    									<p>·Ceramic, Sapphire, Resin, Metal</p>
                    									<p>·Active, Passive</p>
                    									<p>·Self-ligation </p>
                    								</div>
                    						   </div>
                        </div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/dental_3.png" alt="">
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">STRIPS</p>
                    								<div class="item-ex1">
                    									<p>·Double, Single-right, Single-left Hole types</p>
                    									<p>·Compatible with any auto stripping<br /> hand piece</p>
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
                    								<p class="item-name">WIRES</p>
                    								<div class="item-ex1">
                    									<p>·Coated Arch, Elastic, Stainless Steel,<br /> Reverse, etc</p>
                    									<p>·Square, Ovoid, Natura</p>
                    								</div>
                    						   </div>
                    						</div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/dental_5.png" alt="">
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">Miniscrews</p>
                    								<div class="item-ex1">
                    									<p>·Smart Anchor</p>
                    									<p>·Titanium & Stainless Steel</p>
                    									<p>·Various sizes</p>
                    									<p>·Standard & Crosshead type</p>
                    								</div>
                    						   </div>
                    						</div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/dental_6.png" alt="">
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">Miniscrews</p>
                    								<div class="item-ex1">
                    									<p>·Bondable</p>
                    									<p>·1st and 2nd Molar</p>
                    									<p>·Round & Square Shape</p>
                    								</div>
                    						   </div>
                    						</div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-img item-img">
                            <img src="../img/sub/dental_7.png" alt="">
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">Miniscrews</p>
                    								<div class="item-ex1">
                    									<p>·Ligature Tie</p>
                    									<p>·Power Chain</p>
                    									<p>·Separator</p>
                    									<p>·O-Ring</p>
                    									<p>·Torsion Pad</p>
                    									<p>·Ligature Gun</p>
                    								</div>
                    						   </div>
                    						</div>
                    </li>
                    <li class="item-box item-box2">
                        <div class="item-infol">
                        	<div class="info-ab">
                    								<div class="il-top">
                    									<div class="il-t">
                    										<p>[Inside Oral Cavity]</p>
                    									</div>
                    									<div class="il-c">
                    										<p>·Crimpable Stops</p>
                    										<p>·Crimpable Hooks</p>
                    										<p>·Crimpable Tubes</p>
                    										<p>·Bondable Lingual Button</p>
                    										<p>·Lingual Retainers</p>
                    										<p>·Expansion Screw</p>
                    										<p>·etc</p>
                    									</div>
                    								</div>
                    								<div class="il-bot">
                    									<div class="il-t">
                    										<p>[Outside Oral Cavity]</p>
                    									</div>
                    									<div class="il-c">
                    										<p>·Cheek Retractor</p>
                    										<p>·Lip Ring Retracto</p>
                    										<p>·Photo Mirror - Metal/Glass</p>
                    										<p>·Forward Pull Headgear</p>
                    										<p>·Lingual Retainers</p>
                    										<p>·etc</p>
                    									</div>
                    								</div>
                    							</div>
                        </div>
                        <div class="item-info">
                    							<div class="info-ab">
                    								<p class="item-name">Oral Cavity</p>
                    								<div class="item-ex1">
                    									<p>·Inside Oral Cavity</p>
                    									<p>·Outside Oral Cavity</p>
                    								</div>
                    						   </div>
                    						</div>
                    </li> -->
                </ul>
            </div>
            <div class="paging">
                <span class="paging-wrap">
                    <!-- <a href="javascript:;">
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