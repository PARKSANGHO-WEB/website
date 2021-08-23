<? include "../include/header_sub.php"?>
<link rel="stylesheet" href="../css/board_FAQ_input.css">
    <!--    상단 탭메뉴 사이즈 변형-->
    <style>
        section .about-cont .about-flat {
            width: 512px;
        }

        section .about-cont .about-flat ul li {
            width: 256px;
        }

        /*        상단 배너 배경이미지 변경*/
        section.about-busy .sub-banner {
            background: url('../img/sub/faq-ban.jpg');
            height: 200px;
			background-position: center;
			background-size: cover
        }
    </style>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <script src="../js/jquery.nice-select.js"></script>
	<script src="../js/common_js_eng.js"></script>
<body>
     <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
   <? include "../include/gnb_sub1.php"?> 

    <section class="about-busy">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="#">Board</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="board_FAQ_input.php">Inquiry / Order / Suggestion</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">Inquiry / Order / Suggestion</span>
                    <span class="ban-text">We highly appreciate your time to share your <strong> questions and suggestions</strong></span>
                </div>
            </div>
        </div>
        <div class="about-cont">
            <div class="about-flat">
                <ul>
                    <li>
                        <a href="board_FAQ2.php">FAQ</a>
                    </li>
                    <li class="active">
                        <a href="board_FAQ_input.php">Inquiry / Order / Suggestion</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
<script>
function go_submit1(){
	
		var check = chkFrm('frm1');
		if(check) {
			frm1.submit();
		} else {
			false;
		}
		
}



function go_submit2(){

		var check = chkFrm('frm2');
		if(check) {
			frm2.submit();
		} else {
			false;
		}
}

function go_submit3(){

		var check = chkFrm('frm3');
		if(check) {
			frm3.submit();
		} else {
			false;
		}
}

</script>
    <div id="board_faq_input">
        <!--           검색창 시작-->
        <div class="container">
            <ul id="tab-btn" class="tabs cf">
                <li class="tab-link current" data-tab="tab-1">
                    <h1>1:1 Inquiry</h1>
                </li>
                <li class="tab-link" data-tab="tab-2">
                    <h1>Product Order</h1>
                </li>
                <li class="tab-link" data-tab="tab-3">
                    <h1>Suggestion</h1>
                </li>
            </ul>
<!--             1. 탭메뉴 시작-->
            <div id="tab-1" class="tab-content current">
                <p class="a_notice">
                    If you have any questions to K-DOD, we will reach out to you using your e-mail address. <br>
                    Please select the question title from the list.
                </p>
				<form name="frm1" method="post" action="board_FAQ_input_action1.php"  enctype="multipart/form-data">
				<input type="hidden" name="bbs_code" value="qna">
                <div class="title">
                    <h2>Title</h2>
                    <select name="bbs_sect2" class="bbs_sect2" required="yes" message="Title">
                        <!-- <option style="color: blue;" value="none" selected disabled><span class="none">Select category</span></option> -->
						<option style="color: blue;" value=""><span class="none">Select category</span></option>
                        <option value="Membership">Membership</option>
                        <option value="K-DOD Point">K-DOD Point</option>
                        <option value="Online Survey">Online Survey</option>
                        <option value="Medical Product">Medical Product</option>
                        <option value="Public Product">Public Product</option>
                        <option value="Point Mall">Point Mall</option>
                        <option value="K-DOD Playground">K-DOD Playground</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="name_sel">
                    <h2>Name</h2>
                    <input type="text" name="writer" required="yes" message="Name">
                </div>
                <div class="country_sel">
                    <h2>Country</h2>
                    <input type="text" name="nation" required="yes" message="Country">
                </div>
                <div class="phone_sel">
                    <h2>Phone</h2>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="cell" id="cell" required="yes" message="Phone" is_num="yes">
                </div>
                <div class="company_sel">
                    <h2>Company / Clinic (optional)</h2>
                    <input type="text" name="com_name">
                </div> 
                <div class="mail_sel">
                    <h2>E-mail address</h2>
                    <input type="text" name="email" required="yes" is_email="yes"  message="E-mail address">
				</div>
                <div class="inquiry_sel">
                    <h2>Inquiry Details</h2>
<!--                    <input type="text" name="subject" required="yes" message="Inquiry title">-->
                </div>
                <div class="contents_sel">
                    <textarea rows="10" cols="1000" name="content" class="contents form-control" placeholder="" required="yes" message="Contents"></textarea>
                </div>
                <div class="File_sel">
                    <h2>File attachment (optional)</h2>
                    <label for="ex_filename">file browse...</label>
                    <input class="upload-name" value="파일선택" disabled="disabled">
                    <input type="file" name="file1" id="ex_filename" class="upload-hidden"  required="no" message="File attachment (optional)">
                </div>
                <div class="agreement">
                    <h2>Agreement</h2>
                    <div class="txt">
                        <h3>
                            Do you agree to provide your personal information to K-DOD as below?
                        </h3>
                        <p>
                            <u>Personal Info</u><br>
                            - Country<br>
                            - Name (+Company/Clinic)<br>
                            - Phone, e-mail
                        </p>
                        <p>
                            <u>Purpose to collect</u><br>
                            - To provide service consultation
                        </p>
                        <p>
                            <u>Period</u> <br>
                            - 1 year after collection
                        </p>
                        <label>
                            <input class="check" type="checkbox" name="check" value="Agree" required="yes" message="Agreement">
                            <p>Agree</p>
                        </label>
                    </div>
                </div>
                <div class="btn">
                    <button onclick="javascript:go_submit1();">Send</button>
                </div>
				</form>
                <div class="service">
                    <p>
                        <a href="mailto:Korea@k-dod.com">Customer Service</a> <br>
                        <a href="+82-2-2633-1664">TEL +82-2-2633-1664</a>
                    </p>
                </div>
            </div>
<!--             1. 탭메뉴 끝-->
            
<!--             2. 탭메뉴 시작-->
            <div id="tab-2" class="tab-content">
                <p class="a_notice">
                    If you want to order K-DOD products, please place an order here. You need to input the product number. <br>
                    After receiving your order form, we will contact you via e-mail or phone number to discuss about payment or delivery.

                </p>
				<form name="frm2" method="post" action="board_FAQ_input_action2.php"  enctype="multipart/form-data">
				<input type="hidden" name="bbs_code" value="qna3">
                <div class="title">
                    <h2>Title</h2>
                    <select name="bbs_sect2" class="bbs_sect2" required="yes" message="Title">
                        <!-- <option style="color: blue;" value="none" selected disabled><span class="none">Select category</span></option> -->
						<option style="color: blue;" value=""><span class="none">Select category</span></option>
						<option value="Medical Product">Medical Product</option>
                        <option value="Cosmetics">Cosmetics</option>
                        <option value="Homecare Product">Homecare Product</option>
                        <option value="Point Mall Product">Point Mall Product</option>
                    </select>
                </div>
                <div class="product_sel">
                    <h2>Product Name / Product Number</h2>
                    <input type="text" name="product_number" required="yes" message="Product Number">
                </div>
                <div class="quantity_sel">
                    <h2>Quantity</h2>
                    <input type="text" name="quantity" required="yes" is_num="yes" message="Quantity">
                </div>
                <div class="country_sel">
                    <h2>Country</h2>
                    <input type="text" name="nation" required="yes" message="Country">
                </div>
                <div class="address_sel">
                    <h2>Address</h2>
                    <input type="text" name="addr1" id="addr1" required="yes" message="Address">
                </div>
                <div class="company_sel">
                    <h2>Company/Clinic (optional)</h2>
                    <input type="text" name="com_name">
                </div>
                <div class="name_sel2">
                    <h2>Name</h2>
                    <input type="text" name="writer" required="yes" message="Name">
                </div>
                <div class="phone_sel">
                    <h2>Phone</h2>
                    <input type="text" name="cell" required="yes" is_num="yes" message="Phone">
                </div>
                <div class="mail_sel">
                    <h2>e-mail address</h2>
                    <input type="text" name="email" required="yes"  is_email="yes" message="e-mail address">
                </div>
                <div class="question_sel">
                    <h2>Any question?</h2>
                    <input type="text" name="content" required="yes" message="Any question?">
                </div>
                <div class="File_sel">
                    <h2>File attachment (optional)</h2>
                    <label for="ex_filename2">file browse...</label>
                    <input class="upload-name" value="파일선택" disabled="disabled">
                    <input type="file" name="file1" id="ex_filename2" class="upload-hidden">
                </div>
                <div class="agreement">
                    <h2>Agreement</h2>
                    <div class="txt">
                        <h3>
                            Do you agree to provide your personal information to K-DOD as below?
                        </h3>
                        <p>
                            <u>Personal Info</u><br>
                            - Country<br>
                            - Name (+Company/Clinic)<br>
                            - Phone, e-mail
                        </p>
                        <p>
                            <u>Purpose to collect</u><br>
                            - To provide service consultation
                        </p>
                        <p>
                            <u>Period</u> <br>
                            - 1 year after collection
                        </p>
                        <label>
                            <input class="check" type="checkbox" name="check" value="Agree" required="yes" message="Agreement">
                            <p>Agree</p>
                        </label>
                    </div>
                </div>
                <div class="btn">
                    <button onclick="javascript:go_submit2();">Send</button>
                </div>
				</form>
                <div class="service">
                    <p>
                        <a href="mailto:Korea@k-dod.com">Customer Service</a><br>
                        <a href="tel:+82-2-2633-1664">TEL +82-2-2633-1664</a>
                    </p>
                </div>
            </div>
<!--             2. 탭메뉴 끝-->

<!--             3. 탭메뉴 시작-->
            <div id="tab-3" class="tab-content">
                <p class="a_notice">
                    If you have any suggestions to K-DOD, please feel free to write here. We highly appreciate of your valuable opinion, we <br>
                    take your advice or suggestions very seriously and we will use them to improve our services or products.
                </p>
				<form name="frm3" method="post" action="board_FAQ_input_action3.php"  enctype="multipart/form-data">
				<input type="hidden" name="bbs_code" value="qna2">
                <div class="title">
                    <h2>Title</h2>
                    <select  name="bbs_sect2" class="bbs_sect2" required="yes" message="Title">
                        <!-- <option style="color: blue;" value="none" selected disabled><span class="none">Select category</span></option> -->
						<option style="color: blue;" value=""><span class="none">Select category</span></option>
                        <option value="Membership & Point">Membership &amp; Point</option>
                        <option value="Online Survey">Online Survey</option>
                        <option value="Products">Products</option>
                        <option value="Playground">Playground</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Website">Website</option>
                        <option value="Report an error">Report an error</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="country_sel">
                    <h2>Country</h2>
                    <input type="text" name="nation" required="yes" message="Country">
                </div>
                <div class="company_sel">
                    <h2>Company/Clinic (optional)</h2>
                    <input type="text" name="com_name">
                </div>
                <div class="name_sel2">
                    <h2>Name</h2>
                    <input type="text" name="writer" required="yes" message="Name">
                </div>
                <div class="phone_sel">
                    <h2>Phone</h2>
                    <input type="text" name="cell" required="yes" is_num="yes" message="Phone">
                </div>
                <div class="mail_sel">
                    <h2>e-mail address</h2>
                    <input type="text" name="email" required="yes" is_email="yes" message="e-mail address">
                </div>
                <div class="contents_sel">
                    <h2>Suggestion Details</h2>
                    <textarea rows="10" cols="1000" name="content" class="contents form-control" placeholder="문의사항을 입력해주세요." required="yes" message="Suggestion title & contents"></textarea>
                </div>
                <div class="File_sel">
                    <h2>File attachment (optional)</h2>
                    <label for="ex_filename3">file browse...</label>
                    <input class="upload-name" value="파일선택" disabled="disabled">
                    <input type="file" name="file1" id="ex_filename3" class="upload-hidden" >
                </div>
                <div class="agreement">
                    <h2>Agreement</h2>
                    <div class="txt">
                        <h3>
                            Do you agree to provide your personal information to K-DOD as below?
                        </h3>
                        <p>
                            <u>Personal Info</u><br>
                            - Country<br>
                            - Name (+Company/Clinic)<br>
                            - Phone, e-mail
                        </p>
                        <p>
                            <u>Purpose to collect</u><br>
                            - To provide service consultation
                        </p>
                        <p>
                            <u>Period</u> <br>
                            - 1 year after collection
                        </p>
                        <label>
                            <input class="check" type="checkbox" name="check" value="Agree" required="yes" message="Agreement">
                            <p>Agree</p>
                        </label>
                    </div>
                </div>
                <div class="btn">
                    <button onclick="javascript:go_submit3();">Send</button>
                </div>
				</form>
                <div class="service">
                    <p>
                        <a href="mailto:Korea@k-dod.com">Customer Service</a><br>
                        <a href="+82-2-2633-1664">TEL +82-2-2633-1664</a>
                    </p>
                </div>
            </div>
<!--             3. 탭메뉴 끝-->

        </div>
    </div>
    <script>
        $(document).ready(function() {
//            드롭다운 option 커스텀js
            $('select').niceSelect();
        });
            //            약관동의 js
        $(document).ready(function() {
            /*
			$('.btn').click(function() {
                if ($('.check').prop('checked') == false) {
                    alert('필수 약관에 동의 하셔야 합니다.');
                } else {
                    alert('문의가 정상적으로 완료되었습니다.');
                }
            });
			*/

        //            파일 업로드 js
        var fileTarget = $('.File_sel .upload-hidden');

        fileTarget.on('change', function() {
            if (window.FileReader) {
                var filename = $(this)[0].files[0].name;
            } else {
                var filename = $(this).val().split('/').pop().split('\\').pop();
            }
            $(this).siblings('.upload-name').val(filename);
            });
        });
    </script>

   
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


        $(document).ready(function() {
            var tabBtn = $("#tab-btn > li");     //각각의 버튼을 변수에 저장
			var tabCont = $("div.tab-content");       //각각의 콘텐츠를 변수에 저장

            //컨텐츠 내용을 숨겨주세요!
            tabCont.hide().eq(0).show();

            tabBtn.click(function() {
                var target = $(this); //버튼의 타겟(순서)을 변수에 저장
                var index = target.index(); //버튼의 순서를 변수에 저장
                //alert(index);
               tabBtn.removeClass("current");    //버튼의 클래스를 삭제
				target.addClass("current");    //타겟의 클래스를 추가
                tabCont.css("display", "none");
                tabCont.eq(index).css("display", "block");
            });

        });
    </script>
<? include "../include/footer_sub.php"?>
