
	
		<div class="left-menu">
			<div class="lm-t">
				<p>기업관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big<?=($MENU_DEPTH1 == "1")?" active":""?>" >기업정보</p>
					<div class="lm-list">
						<ul>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "1")?"class='active'":""?>><a href="company-new.php">신규등록</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="company.php">기업관리</a></li>
							<li <?=($MENU_DEPTH1 == "1" && $MENU_DEPTH2 == "3")?"class='active'":""?>><a href="company-people.php">기업 사원 관리</a></li>
						</ul>
					</div>
				</li>
				<li class="lm-act">
					<p class="lm-big<?=($MENU_DEPTH1 == "2")?" active":""?>">기업 휴양소 관리</p>
					<div class="lm-list">
						<ul>
							<li <?=($MENU_DEPTH1 == "2" && $MENU_DEPTH2 == "1")?"class='active'":""?>><a href="company-room-new.php">신규 휴양소 추가</a></li>
							<li <?=($MENU_DEPTH1 == "2" && $MENU_DEPTH2 == "2")?"class='active'":""?>><a href="company-room-manage.php">기업 휴양소 관리</a></li>
							<li <?=($MENU_DEPTH1 == "2" && $MENU_DEPTH2 == "3")?"class='active'":""?>><a href="company-room-go.php">휴양소 추첨 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>