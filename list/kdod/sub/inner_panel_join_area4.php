<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>

								<div class="sel-wrap">
									<div class="relationship inner-box">
										<p>Relationship</p>
										<div class="niceSct-sel">
											<select name="family_members_relationship[]" id="Relationship">
												<option></option><!--비워놓는 영역 화면상 안보임-->
												<option value="Father">Father</option>
												<option value="Mother">Mother</option>
												<option value="Spouse">Spouse</option>
												<option value="Brother">Brother</option>
												<option value="Grand mother">Grand mother</option>
												<option value="Grand father">Grand father</option>
												<option value="Son">Son</option>
												<option value="Daughter">Daughter</option>
												<option value="Relative">Relative</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
									<div class="birthYear inner-box">
										<p>BirthYear</p>
										<div class="date-sel">
											<input type="text" name="family_members_birth_year[]" id="birth" class="datepicker" style="height:40px;">
										</div>
									</div>
								</div>
								
						