
            <div id="subMenu2">
				<button type="button" onClick="document.location.href = '/mypage/reserv.php';" <?=($regflag=="")?'class="active"':''?>>전체내역</button>
				<button type="button" onClick="document.location.href = '/mypage/reserv_win.php';" <?=($regflag=="5")?'class="active"':''?>> 당첨내역</button>
				<button type="button" onClick="document.location.href = '/mypage/reserv_fail.php';" <?=($regflag=="6")?'class="active"':''?>>미당첨내역</button>
				<button type="button" onClick="document.location.href = '/mypage/reserv_cancel.php';" <?=($regflag=="7")?'class="active"':''?>>취소내역</button>
            </div>