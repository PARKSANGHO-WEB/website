<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">
<?
?>
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close.png" alt="">
					</div>
				</div>
				<div class="modal-bot">
					<form action="#">
						<div class="mo-con">
							<p class="rr-title">
								설문조사
							</p>
							<div class="sml-line sml-line1">
								<p>1.올해 하계휴양소의 전체적인 시설선정에 대한 만족도를 선택하십시오.</p>
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="100" min="0" max="100">
									<span class="range-slider__value">0</span>
								</div>
							</div>
							<div class="sml-line sml-line2">
								<p>2. 이용하신 하계휴양소 객실의 청결상태에 대한 만족도를 선택하십시오.</p>
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="100" min="0" max="100">
									<span class="range-slider__value">0</span>
								</div>
							</div>
							<div class="sml-line sml-line3">
								<p>3. 이용하신 하계휴양소 부대시설에 대한 만족도를 선택하십시오.</p>
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="100" min="0" max="100">
									<span class="range-slider__value">0</span>
								</div>
							</div>
							<div class="sml-line sml-line4">
								<p>4. 이용하신 휴양시설의 직원 친절도 및 서비스에 대한 만족도를 선택하십시오.</p>
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="100" min="0" max="100">
									<span class="range-slider__value">0</span>
								</div>
							</div>
							<div class="sml-line sml-line5">
								<p>5. 이용하신 휴양시설에서 가장 만족스러웠던 점은 무엇입니까?(2개선택)</p>
								<div class="l5-label">
									<input type="checkbox" name="locate" id="locate">
									<label for="locate">위치</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="cunstruc" id="cunstruc">
									<label for="cunstruc">시설수준</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="service" id="service">
									<label for="service">임직원서비스</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="cunstruc2" id="cunstruc2">
									<label for="cunstruc2">부대시설</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="sale" id="sale">
									<label for="sale">할인혜택</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="clean" id="clean">
									<label for="clean">청결상태</label>
								</div>
								<div class="l5-label">
									<input type="checkbox" name="else" id="else">
									<label for="else">기타</label>
									<input type="text" id="anything" class="anything" disabled>
								</div>
							</div>
							<div class="sml-line sml-line6">
								<p>6. 이용하신 휴양시설에서 가장 불만족스러웠던 점은 무엇입니까?(2개선택)</p>
								<div class="l6-label">
									<input type="checkbox" name="locate-2" id="locate-2">
									<label for="locate-2">위치</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="cunstruc-2" id="cunstruc-2">
									<label for="cunstruc-2">시설수준</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="service-2" id="service-2">
									<label for="service-2">임직원서비스</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="cunstruc2-2" id="cunstruc2-2">
									<label for="cunstruc2-2">부대시설</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="sale-2" id="sale-2">
									<label for="sale-2">할인혜택</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="clean-2" id="clean-2">
									<label for="clean-2">청결상태</label>
								</div>
								<div class="l6-label">
									<input type="checkbox" name="else2" id="else2">
									<label for="else2">기타</label>
									<input type="text" id="anything2" class="anything" disabled>
								</div>
							</div>
							<div class="sml-line sml-line7">
								<p>7. 이용하신 휴양시설의 전반적인 만족도를 선택하십시오.</p>
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="100" min="0" max="100">
									<span class="range-slider__value">0</span>
								</div>
							</div>
							<div class="sml-line sml-line8">
								<p>8. 차년도 성공적인 휴양소 운영을 위한 제언 부탁드립니다.(선택사항)</p>
								<textarea name="l8-text" id="l8-text"></textarea>
							</div>
							<div class="sml-line sml-line9">
								<p>설문에 참여해 주셔서 감사합니다.</p>
								<button type="button">설문제출</button>
							</div>
						</div>
					</form>
				</div>
			</div>
