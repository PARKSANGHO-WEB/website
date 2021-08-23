<? include "../include/header_sub.php"?>

<body>
    <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
    <? include "../include/gnb_sub1.php"?>

    <section class="ophthal">
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
                            <a href="./ophthal.php">Ophthalmology</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Products for Doctor</span>
                    <span class="ban-text">Dermatology, Dental, <strong>Ophthalmology</strong> Products</span>
                </div>
            </div>
        </div>
        <div class="derma-cont">
            <div class="derma-flat">
                <ul>
                    <li>
                        <a href="./dermatology.php">Dermatology</a>
                    </li>
                    <li>
                        <a href="./dental.php">Dental</a>
                    </li>
                    <li class="active">
                        <a href="./ophthal.php">Ophthalmology</a>
                    </li>
                </ul>
            </div>
        </div>

        <?
$goods_value = "Ophathalmology";
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

        <script LANGUAGE="JavaScript">
            function go_search() {
                if (!frm_page.field.value || !frm_page.keyword.value) {
                    alert("검색조건 또는 검색어를 입력해 주세요!!");
                    exit;
                }
                frm_page.submit();
            }

        </script>
        <div class="derma-list">
            <div class="dl-top">
                <p>OPHTHALMOLOGY Products </p>
                <span class="s-text">
                    K-DOD brings high quality of Korean ophthalmology (eye care) products for professional treatment.<br />
                	Due to COVID-19, we temporarily hold off medical products sales. For any questions or suggestions, go to <a href="./board_FAQ_input.php">QA/Board</a>
                </span>
            </div>
            <div class="search-line">
                <form name="s_mem" id="s_mem" method="post" action="ophthal.php">
                    <input type="hidden" name="mode" value="ser">
                    <input type="hidden" name="goods_value" value="<?=$goods_value?>" />
                    <input type="hidden" name="bmenu" value="<?=$bmenu?>" />
                    <input type="hidden" name="smenu" value="<?=$smenu?>" />
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
                    <!-- <li class="item-box">
                        <div class="item-img">
						<?
							if($row_file['file_chg']){
						?>	
							<img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['file_chg']?>" alt="">
                        <?
							}
						?>
						</div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">
								
						<?
							if($row[goods_name_eng]){
						?>
							<?=string_cut2(stripslashes($row[goods_name_eng]),70)?>
						<?}else{?>
								준비 중입니다.
						<?}?>		
								</p>
								<div class="item-ex1">
						<?
							if($row[goods_content_eng]){
						?>	
						<p><?=stripslashes($row[goods_content_eng])?></p>
						<?}else{?>
									<p>준비 중입니다.</p>
						<?}?>			
								</div>
						   </div>
                        </div>
                    </li>  -->
                    <li class="item-box">
                        <div class="item-img">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
                                <p class="item-name">coming soon</p>
<!--
                                <div class="item-ex1">
                                    <p>coming soon</p>
                                </div>
-->
                            </div>
                        </div>
                    </li>


                    <!-- <li class="item-box">
                        <div class="item-img">
                        </div>
                        <div class="item-info">
                            <div class="info-ab">
								<p class="item-name">준비 중입니다.</p>
								<div class="item-ex1">
									<p>준비 중입니다.</p>
								</div>
						   </div>
                        </div>
                    </li> -->
                </ul>
            </div>
            <script>
                $(document).ready(function() {
                    $('.item-box').on('click', function() {
                        alert('준비중 입니다.');
                    });
                });

            </script>
            <div class="paging">
                <span class="paging-wrap">
                <?
					include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front.php";	
				?>
                </span>
            </div>
        </div>

    </section>

    <script>
        $(document).ready(function() {


            $('.visual-slider').bxSlider({
                auto: true,
                pager: true,
                mode: 'fade',
                hideControlOnEnd: true
            });

            $('.cont1-slider').bxSlider({
                auto: true,
                pager: true,
                hideControlOnEnd: true
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            var iiheight = $('.item-info').height();
            var iaheight = $('.info-ab').height();

            if (iaheight > iiheight) {
                $(iiheight).height(iaheight);
            }


        });

    </script>


    <script>
        $(document).ready(function() {

            $(".content-rd").mCustomScrollbar({
                theme: "light-3"
            });
        });

    </script>

    <? include "../include/footer_sub.php"?>
