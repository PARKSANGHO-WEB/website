<? include "./inc/header.php"; ?>
<body>
    <? include "./inc/gnb.php"; ?>
    <section class="main_visu">
            <div class="visu_wrap">
                <div class="bxslider">
			<?
				$main_ad_1_sql = "select * FROM mainban_info where 1 and banner_type='pc' and main_sect='' and view_ok='Y' order by align desc";
				$main_ad_1_query = mysqli_query($gconnet,$main_ad_1_sql);

				for($main_ad_1_i=0; $main_ad_1_i<mysqli_num_rows($main_ad_1_query); $main_ad_1_i++){
					$main_ad_1_row = mysqli_fetch_array($main_ad_1_query);
			?>
                    <div>
                        <div class="capt-bx">
                            <div class="capt-img">
								<img src="/upload_file/main_banner/img_thumb/<?=$main_ad_1_row['file_c']?>" alt="">
							</div>
                            <h1>
								<?=nl2br(stripslashes($main_ad_1_row[main_memo]))?>
							</h1>
                            <div class="capt-bar"></div>
                            <div class="capt-eng"><?=$main_ad_1_row[main_copy_txt]?></div>
                        </div>
						<?if($main_ad_1_row['link_url']){?>
							<a href="<?=$main_ad_1_row['link_url']?>" target="<?=$main_ad_1_row['link_target']?>">
						<?}else{?>
							<a href="javascript:;">
						<?}?>
							<img src="/upload_file/main_banner/img_thumb/<?=$main_ad_1_row['file_c2']?>" title="#">
						</a>
                    </div>
		<?}?>
               </div>
            </div>
		<!-- 모바일 배너 시작 -->
			<div class="visu_wrap visu_wrap2">
                <div class="bxslider bxslider2">
				<?
				$main_ad_1_sql = "select * FROM mainban_info where 1 and banner_type='pc' and main_sect='' and view_ok='Y' order by align desc";
				$main_ad_1_query = mysqli_query($gconnet,$main_ad_1_sql);

				for($main_ad_1_i=0; $main_ad_1_i<mysqli_num_rows($main_ad_1_query); $main_ad_1_i++){
					$main_ad_1_row = mysqli_fetch_array($main_ad_1_query);
				?>
                    <div>
                        <div class="capt-bx">
                            <div class="capt-img"><img src="/upload_file/main_banner/img_thumb/<?=$main_ad_1_row['file_c']?>" alt=""></div>
                            <h1>
								<?=nl2br(stripslashes($main_ad_1_row[main_memo]))?>
							</h1>
                            <div class="capt-bar"></div>
                            <div class="capt-eng"><?=$main_ad_1_row[main_copy_txt]?></div>
                        </div>
                       <?if($main_ad_1_row['link_url']){?>
							<a href="<?=$main_ad_1_row['link_url']?>" target="<?=$main_ad_1_row['link_target']?>">
						<?}else{?>
							<a href="javascript:;">
						<?}?>
							<img src="/upload_file/main_banner/img_thumb/<?=$main_ad_1_row['file_c3']?>" title="#">
						</a>
                    </div>
				<?}?>
                </div>
            </div>
		<!-- 모바일 배너 종료 -->
        <script>
            $(function(){
              $('.bxslider').bxSlider({
                mode: 'fade',
                captions: false,
                pager:false
              });
                
                $('#slide-counter').append(slider.getSlideCount());
            });
        </script>
    </section>
    <section  class="mid_sec">
        <div class="main_mid">
            <div class="mm_wrap">
                <li class="mid_tab mid_tab1 item" data-dot="<button>1</button>">
                    <div class="mm_left">
                        <img src="/img/main/main_ban1.png" alt="">
                        <div class="mc_img2">
                            <h1>과학·기술력
                            
                            <span>scientific and<br />technological<br />prowess</span></h1>
                        </div>
                    </div>
                    <div class="mm_center">
                        <img src="/img/main/arrow_mid.png" alt="">
                    </div>
                    <div class="mm_right">
                        <span class="dot"></span>
                        <div class="mm-titlee"><span class="in_dot">·</span><p>다중타겟 후보물질 도출 경험 보유</p></div>
                        <div class="mm-titlee"><span class="in_dot">·</span><p>CMC 고도화 핵심기술</p></div>
                        <div class="mm-titlee"><span class="in_dot">·</span><p>AI 기반 Bio-Fingerprinting</p></div>
                        <div class="mm-titlee"><span class="in_dot">·</span><p>Microbiome & Metabolomics, Omics</p></div>
                    </div>
                </li>
<!--
                <li class="mid_tab mid_tab2 item" data-dot="<button>2</button>">
                    <div class="mm_left">
                        <img src="/img/main/main_ban1.png" alt="">
                        <div class="mc_img2">
                            <h1>Open<br />Innovation과<br />네트워킹</h1>
                        </div>
                    </div>
                    <div class="mm_center">
                        <img src="/img/main/arrow_mid.png" alt="">
                    </div>
                    <div class="mm_right">
                        <span class="dot"></span>
                        <div class="mm-titlee"><span class="in_dot">·</span><p> 산·학·연·관·병 긴밀한 네트워크 구축</p></div>
                        <div class="mm-contents">
                            <span class="in_dot">·</span><p>정부부처:  천연물신약 산업체 리더, <br />국가과학기술자문회의 위원, <br />국가R&D 기획, 전략, 정책수립 참여</p>
                        </div>
                        <div class="mm-contents">
                            <span class="in_dot">·</span><p>해외 약물개발 관련 전문가 네트워크 확보</p>
                        </div>
                    </div>
                </li>
-->
            </div>
            <script>
            function oninit(event) {
                var total = event.item.count || this.$element.children().length;
                if (total <= 4) {
                    this.options.mouseDrag = false;
                    this.options.touchDrag = false;
                } else {
                    this.options.mouseDrag = true;
                    this.options.touchDrag = true;
                }
            }

                
                jQuery(document).ready(function($) {
                  $('.fadeOut').owlCarousel({
                    items: 1,
                    onInitialize: oninit,
                    animateOut: 'fadeOut',
                    loop: false,
                    margin: 0,
                    autoplay : 10000,
                    slideSpeed: 400,
                    dots: true,
                    dotsData: true,
                    autoplay:true,
                    loop: true
                  });
                });

            </script>
        </div>
    </section>
    <section class="main_border">
        <div class="mb_wrap">
            <div class="mb_left">
                <form action="#">
                    <div class="m_board">
                        <div class="title">
                            <span>
                                <img src="/img/main/mb_circle.png" alt="">
                            </span>
                            <span class="mb_t">공지&뉴스</span>
                            <span class="mb_m"><a href="/sub/notice.php?bbs_code=notice">More <img src="/img/main/mb_arrow.png" alt=""></a></span>
                        </div>
                        <div class="main_notice">
                            <table class="table_top">
					<?
						$main_board_1_sql = "select idx,subject,write_time,bbs_code,content from board_content where 1 and bbs_code = 'notice' and depth = 0 and is_del='N' order by idx desc limit 0,1";
						$main_board_1_query = mysqli_query($gconnet,$main_board_1_sql);

						for($main_board_1_i=0; $main_board_1_i<mysqli_num_rows($main_board_1_query); $main_board_1_i++){
							$main_board_1_row = mysqli_fetch_array($main_board_1_query);
							$reg_time3 = to_time(substr($main_board_1_row[write_time],0,10));
					?>
                                <tr>
                                    <td colspan="2">
                                        <p class="m_latest_t">
                                             <a href="../sub/notice_sub.php?idx=<?=$main_board_1_row['idx']?>&bbs_code=notice"><?=string_cut2(stripslashes($main_board_1_row[subject]),60)?> <?=now_date($reg_time3)?></a>
                                        </p>
                                        <p class="m_latest_c">
                                             <?=string_cut2(stripslashes(strip_tags($main_board_1_row[content])),100)?>
                                        </p>
                                    </td>
                                </tr>
						<?}?>
                            </table>
                            <div class="table_hypen" style="display: block; width: 80%; margin: 20px auto; height: 1px; background-color: #bababa;">

                            </div>
                            <table class="table_sum">
						<?
						$main_board_2_sql = "select idx,subject,write_time,bbs_code,content from board_content where 1 and bbs_code = 'notice' and depth = 0 and is_del='N' order by idx desc limit 1,2";
						$main_board_2_query = mysqli_query($gconnet,$main_board_2_sql);

						for($main_board_2_i=0; $main_board_2_i<mysqli_num_rows($main_board_2_query); $main_board_2_i++){
							$main_board_2_row = mysqli_fetch_array($main_board_2_query);
							$reg_time3 = to_time(substr($main_board_2_row[write_time],0,10));
					?>
                                <tr>
                                    <td class="notice_sumt"><p>
										<a href="../sub/notice_sub.php?idx=<?=$main_board_2_row['idx']?>&bbs_code=notice"><?=string_cut2(stripslashes($main_board_2_row[subject]),60)?> <?=now_date($reg_time3)?></a>
									</p></td>
                                    <td class="notice_sumd"><?=substr($main_board_2_row[write_time],0,10)?></td>
                                </tr>
					<?}?>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb_right">
                <img src="/img/main/notice_im.png" alt="">
            </div>
        </div>
    </section>
	<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/index_layer.php"; ?>
   <? include "./inc/footer.php"; ?>
</body>
</html>