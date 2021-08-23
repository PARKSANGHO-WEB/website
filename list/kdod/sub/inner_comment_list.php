<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$board_tbname = urldecode(sqlfilter($_REQUEST['board_tbname']));
	$product_idx = urldecode(sqlfilter($_REQUEST['product_idx']));
	$bbs_code = urldecode(sqlfilter($_REQUEST['bbs_code']));
	$pageNo = trim(sqlfilter($_REQUEST['pageNo'])); 

	$total_param = 'board_tbname='.$board_tbname.'&product_idx='.$product_idx.'&bbs_code='.$bbs_code;
	
	if(!$pageNo){
		$pageNo = 1;
	}
	
	$where = " and board_tbname = '".$board_tbname."' and board_code='".$bbs_code."' and board_idx='".$product_idx."' and (p_no='' or p_no is null)";
	
	$pageScale = 4; // 페이지당 4 개씩
	$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY ref desc, step asc, depth asc";

$query = "select *,(select user_id from member_info where 1 and idx=a.member_idx) as user_nick,(select member_type from member_info where 1 and idx=a.member_idx) as member_type from board_comment a where 1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;

//echo $query."<br>";

$query_cnt = "select a.idx from board_comment a where 1 ".$where;
$result = mysqli_query($gconnet,$query);
$result_cnt = mysqli_query($gconnet,$query_cnt);

$num = mysqli_num_rows($result_cnt);

//echo $num;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;

$totpam = $total_param."&pageNo=".$pageNo;

	for ($i=0; $i<mysqli_num_rows($result); $i++){
		$row = mysqli_fetch_array($result);

		$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
		$reg_time3 = to_time(substr($row[write_time],0,10));

		$query2 = "select *,(select user_id from member_info where 1 and idx=a.member_idx) as user_nick,(select member_type from member_info where 1 and idx=a.member_idx) as member_type from board_comment a where 1 and p_no='".$row['idx']."' order by idx desc";
		$result2 = mysqli_query($gconnet,$query2);
?>
	<!-- 댓글 한개당 row -->
		 <article>
                    <div class="content_bg cf" id="board_2_1_<?=$row[idx]?>">
                       <aside>
                          <?if($row['member_idx'] == $_SESSION['member_coinc_idx']){?>
						   <h2>
                               <span onclick="board_3_v('<?=$row[idx]?>');" style="cursor:pointer;">수정</span>
                           </h2>
                           <h2 class="delete">
                               <span onclick="go_comment_delete('<?=$row[idx]?>');" style="cursor:pointer;">삭제</span>
                           </h2>
						<?}?>
						<?if($row['member_idx'] != $_SESSION['member_coinc_idx']){?>
						   <h2>
                               <span onclick="board_2_v('<?=$row[idx]?>');" style="cursor:pointer;">댓글</span>
                           </h2>
						<?}?>
                        </aside>
                        <div class="fl">
                            <div class="profile cf">
                                <div class="id">
                                    <div class="profile_img">
                                        <img src="../img/sub/profile.png" alt="프로필 이미지">
                                    </div>
                                    <h3>
                                        <?=$row['user_nick']?>
                                    </h3>
                                </div>
                                <div class="date">
                                    <h3>
                                        <span><?=substr($row['write_time'],0,10)?></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="cm">
                                <p id="board_3_1_<?=$row[idx]?>"><?=nl2br(stripslashes($row['content']))?></p>
								<p id="board_3_2_<?=$row[idx]?>" style="display:none;">
									
									<input type="hidden" name="bbs_idx" id="inner_bbs_idx_<?=$row['idx']?>" value="<?=$row['idx']?>"/>
									<input type="hidden" name="rcpage" id="inner_rcpage_<?=$row['idx']?>" value="<?=$pageNo?>"/>

									<textarea cols="30" rows="10" name="fm_mod" id="inner_fm_write_<?=$row['idx']?>" style="width:100%;height:70px;border-radius: 8px;border: 1px solid #707070;position: relative;" class="comments"><?=$row['content']?></textarea>
									<button type="button" onclick="go_comment_mod('<?=$row[idx]?>');" style=" background-color: #E5E5E5;border: 1px solid #707070;border-radius: 18px;padding: 5px 20px;font-size: 1rem;font-weight: 600;">수정</button>
								</p>
                            </div>
							<!-- 댓글창 시작 -->
								<div id="board_2_2_<?=$row[idx]?>" style="display:none;height:110px;">
									<form name="cmt_frm_<?=$row[idx]?>" id="cmt_frm_<?=$row[idx]?>" action="comment_reply_action.php" target="_fra" method="post"  enctype="multipart/form-data">
										<input type="hidden" name="total_param" value="<?=$total_param?>">
										<input type="hidden" name="pageNo" value="<?=$pageNo?>">
										<input type="hidden" name="board_tbname" value="<?=$board_tbname?>">
										<input type="hidden" name="board_code" value="<?=$bbs_code?>">
										<input type="hidden" name="board_idx" value="<?=$product_idx?>">
										<input type="hidden" name="target_link" value="inner_comment_list.php">
										<input type="hidden" name="target_id" value="toc-content">
										<input type="hidden" name="is_html" value="N">
										<input type="hidden" name="view_idx" id="orgin_view_idx" value="<?=$row[member_idx]?>">
										<input type="hidden" name="p_no" id="orgin_p_no" value="<?=$row[idx]?>">
										
										<textarea cols="30" rows="10" name="fm_write" id="fm_write_<?=$row[idx]?>" style="width:100%;height:70px;border-radius: 8px;border: 1px solid #707070;position: relative;" class="comments" required="yes" message="답글내용"></textarea>

										<div style="text-align:right;padding-right:10px;">
											<button type="button" onclick="go_comment_reply('cmt_frm_<?=$row[idx]?>');" style=" background-color: #E5E5E5;border: 1px solid #707070;border-radius: 18px;padding: 5px 20px;font-size: 1rem;font-weight: 600;">댓글작성</button>
										</div>
									</form>
								</div>
							<!-- 댓글창 종료 -->
                        </div>
                    </div>
				<?
					for ($i2=0; $i2<mysqli_num_rows($result2); $i2++){
						$row2 = mysqli_fetch_array($result2);
				?>	
					<!-- 답글 area 시작 -->
                    <div class="content_bg cf reple">
                       <aside>
                           <?if($row2['member_idx'] == $_SESSION['member_coinc_idx']){?>
						   <h2>
                               <span onclick="board_3_v('<?=$row2[idx]?>');" style="cursor:pointer;">수정</span>
                           </h2>
                           <h2 class="delete">
                               <span onclick="go_comment_delete('<?=$row2[idx]?>');" style="cursor:pointer;">삭제</span>
                           </h2>
						   <?}?>
                        </aside>
                        <div class="fl">
                            <div class="profile cf">
                                <div class="id">
                                    <div class="profile_img">
                                        <img src="../img/sub/profile.png" alt="프로필 이미지">
                                    </div>
                                    <h3>
                                        <?=$row2['user_nick']?>
                                    </h3>
                                </div>
                                <div class="date">
                                    <h3>
                                        <span><?=substr($row2['write_time'],0,10)?></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="cm">
                                <p id="board_3_1_<?=$row2[idx]?>"><?=nl2br(stripslashes($row2['content']))?></p>
								<p id="board_3_2_<?=$row2[idx]?>" style="display:none;">
									
									<input type="hidden" name="bbs_idx" id="inner_bbs_idx_<?=$row2['idx']?>" value="<?=$row2['idx']?>"/>
									<input type="hidden" name="rcpage" id="inner_rcpage_<?=$row2['idx']?>" value="<?=$pageNo?>"/>

									<textarea cols="30" rows="10" name="fm_mod" id="inner_fm_write_<?=$row2['idx']?>" style="width:100%;height:70px;border-radius: 8px;border: 1px solid #707070;position: relative;" class="comments"><?=$row2['content']?></textarea>
									<button type="button" onclick="go_comment_mod('<?=$row2[idx]?>');" style=" background-color: #E5E5E5;border: 1px solid #707070;border-radius: 18px;padding: 5px 20px;font-size: 1rem;font-weight: 600;">수정</button>
								</p>
                            </div>
                        </div>
                    </div>
					<!-- 답글 area 종료 -->
				  <?}?>
                </article>		
		 <?}?>
		<!-- 댓글 한개당 row -->

	<!-- 페이지 시작 -->
       <div class="paging">
            <span class="paging-wrap">
		  <?
			$target_link = "inner_comment_list.php";
			$target_id = "toc-content";
			$target_param = $total_param;
			include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front_ajax.php";	
		   ?>
           </span>
       </div>
	 <!-- 페이지 종료 -->
	
        
				