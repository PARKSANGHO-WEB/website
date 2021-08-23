		<div class="left-menu">
			<div class="lm-t">
				<p>예약관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big<?=($MENU_DEPTH1 == "1")?" active":""?>">예약관리</p>
					<div class="lm-list">
						<ul>
                        <?
                            if( $_SESSION['MEM_LEVEL'] == "00" ){
                        ?>                        
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "1")?"class='active'":""?>><a href="reserve-selected.php">당첨 등록 관리</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="reserve-list.php">예약 내역 관리</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "3")?"class='active'":""?>><a href="reserve-calendar.php">캘린더</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "4")?"class='active'":""?>><a href="reserve-cancel.php">취소 승인 관리</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "5")?"class='active'":""?>><a href="reserve-using.php">객실 배정 관리</a></li>
                        <?
                            }else {
                        ?>
                                <li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="reserve-list.php">예약 내역 관리</a></li>
                        <?
                            }
                        ?>
						</ul>
					</div>
				</li>
                <?
                    if( $_SESSION['MEM_LEVEL'] == "00" ){
                ?>                 
				<li class="lm-act">
					<p class="lm-big<?=($MENU_DEPTH1 == "2")?" active":""?>">결제 관리</p>
					<div class="lm-list">
						<ul>
							<li <?=($MENU_DEPTH1 == "2" && $MENU_DEPTH2 == "1")?"class='active'":""?>><a href="reserve-pay.php">결제 관리</a></li>
							<li <?=($MENU_DEPTH1 == "2" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="reserve-pg.php">PG결제 관리</a></li>
						</ul>
					</div>
				</li>
				<li class="lm-act">
					<p class="lm-big<?=($MENU_DEPTH1 == "3")?" active":""?>">설문 관리</p>
					<div class="lm-list">
						<ul>
							<li <?=($MENU_DEPTH1 == "3" && $MENU_DEPTH2 == "1")?"class='active'":""?>><a href="reserve-survey.php">설문 등록</a></li>
							<li <?=($MENU_DEPTH1 == "3" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="reserve-survey-manage.php">설문 관리</a></li>
							<li <?=($MENU_DEPTH1 == "3" && $MENU_DEPTH2 == "3")?"class='active'":""?>><a href="reserve-survey-result.php">결과 관리</a></li>
						</ul>
					</div>
				</li>
                <?
                    }
                ?>
			</ul>
		</div>        