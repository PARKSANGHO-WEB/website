        <div class="left-menu">
			<div class="lm-t">
				<p>휴양소 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">휴양소 관리</p>
					<div class="lm-list">
						<ul>
                        <?
                            if( $_SESSION['MEM_LEVEL'] == "00" ){
                        ?>
							<li <?=($MENU_DEPTH2 == "1")?"class='active'":""?> ><a href="room-new.php">신규 휴양소 등록</a></li>
                        <?
                            }
                        ?>
							<li <?=($MENU_DEPTH2 == "2")?"class='active'":""?> ><a href="room-manage.php">휴양소 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>