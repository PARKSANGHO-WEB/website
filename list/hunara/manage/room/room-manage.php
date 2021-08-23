<? include("../inc/header.php"); ?>
<?php 
    $level = $_SESSION['MEM_LEVEL'];
?>
<link rel="stylesheet" href="/manage/css/room.css">

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){

    var dataArr = {
            searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
        ,   level : <?=$level?>
    }   

	console.log(dataArr); 

    $("#list").jqGrid({
        
		url: "/manage/room/room-manage-data.php",
		datatype: "json",
		mtype: "post",
        postData : dataArr,
		colNames: [ "선택", "번호", "등록일", "휴양소명", "연락처", "홈페이지","등록 객실"],
		colModel: [
			{ name: "idx",label:"id", sortable:false, align:"center", formatter:checkBox, width:30} ,
			{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'number', width:30},
            { name: "wdate",label:"등록일", sortable:true, align:"center", sorttype:'date', width: 30},
            { name: "comname",label:"휴양소명", sortable:true, align:"center", width: 80},
            { name: "tel",label:"연락처", sortable:true, align:"center", width: 50},
            { name: "homepage",label:"홈페이지", sortable:true, align:"center", width: 80},
            { name: "rcnt",label:"등록 객실", sortable:true, align:"center", width: 50}
			],
		pager: "#pager",
		rowNum: 10,
		sortname: "no",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

	   		if(cellNm[index].name == 'homepage')
   			{
                view2(contents);
   			}else if(cellNm[index].name != 'idx' && <?=$level ?> != 10)
   			{
                view(rowId);
   			}

	   	},
        loadError:function(xhr,status,error){
                alert("실패>>"+error);
        },
        loadComplete:function(data){   
        },	
		caption: ""

	});     
}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='rMana[]' name='rMana[]' required='yes'  message='체크' value='"+idx+"'";
        
        return str;
}

function formatOpt1(cellvalue, options, rowObject){ 

var str = "";

var val1 = rowObject[0];
	var val2 = rowObject[1];
   
			
	str += "<button id='modi' type=\"button\" onclick=\"location.href='./notice-modi.php?idx="+val1+"'\">수정</button>";   
 
   return str;

}

function search(){

    var dataArr = {
            searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);
    //console.log(dataArr);
	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "room-manage-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    document.location.href = "/manage/room/room-modify.php?idx="+idx;
}

function view2(idx){
    
    document.location.href = idx;
}

</script>
<style>
#modi{
    padding: 5px 20px;
    border-radius: 5px;
    border: none;
    background-color: #2b2e33;
    color: #fff;
    font-size: 14px;
    font-weight: normal;
}
</style>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function go_view(no,bcode){
		location.href = "board_view.php?idx="+no+"&bbs_code="+bcode+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&keyword=<?=$keyword?>&s_cate_code=<?=$s_cate_code?>&v_sect=<?=$v_sect?>&s_sect1=<?=$s_sect1?>&s_sect2=<?=$s_sect2?>&s_gender=<?=$s_gender?>&s_level=<?=$s_level?>";
	}
	
	function go_list(){
		location.href = "board_list.php?<?=$total_param?>";
	}

	function go_regist(){
		location.href = "board_write.php?<?=$total_param?>";
	}
	
	function go_search() {
		if(!frm_page.field.value || !frm_page.keyword.value) {
			alert("검색조건 또는 검색어를 입력해 주세요!!") ;
			exit;
		}
		frm_page.submit();
	}

	function cate_sel_1(z){
		var tmp = z.options[z.selectedIndex].value; 
		//alert(tmp);
		_fra_admin.location.href="../partner/cate_select_1.php?cate_code1="+tmp+"&fm=s_mem&fname=s_sect2";
	}

    function go_tot_del() {
        /*var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/

        let result = '';
        $('input[name="rMana[]"]:checked').each(function(){
            result += $(this).val() + ',';
        });
        
        // 출력
        if(result){
            location.href='./room_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }
    }
	
//-->
</SCRIPT>



<!--팝업 오픈-->
<script language="javascript">
	function roomPopup() {
		window.open("company-room-pop.php", "a",
			"width=900, height=800, left=100, top=50");
	}
</script>

<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents room-mana">
    <? 
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/room/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>휴양소 관리</div>
			</div>
			<div class="cc-con">
					<div class="com-search">
						<div class="com-day">
							<div class="cd-t">
								<span>등록일</span>
							</div>
							<div class="cd-c">
                                <input type="text" id="startDate" data-js-extra-date><span>~</span>
                                <input type="text" id="endDate" data-js-extra-date>
							</div>
						</div>
						<div class="com-tab">
                        <? if( $_SESSION['MEM_LEVEL'] == "00" || $_SESSION['MEM_LEVEL'] == "10" ){ ?>
							<select name="searchType" id="searchType">
								<option value="comname">휴양소명</option>
								<option value="tel">연락처</option>
							</select>
							<input type="text" name="searchValue" id="searchValue" >
                        <?} else { ?>                            
                            <input type="hidden" name="searchType" id="searchType" value="comname">
                            <input type="hidden" name="searchValue" id="searchValue" value="<?=$_SESSION['MEM_NAME']?>" >
                        <?} ?>
							<button type="submit" name="submit" onclick="search();">검색</button>
						</div>
					</div>
					<div class="view-c">
						<div class="btn-wrap">
							<div class="btn-float">
                                <? if( $_SESSION['MEM_LEVEL'] == "00" ){ ?>
								<button type="button" onclick="go_tot_del();">선택 삭제</button>
                                <?}?> 
								<button type="button" onclick="exportExcel('list');">프린트</button>
							</div>
						</div>
						<div class="view-host">
							<div class="all-c">
								<input type="checkbox" id="rMana"
									data-check-pattern="[name^='rMana']" name="rMana">
								<label for="rMana">전체선택</label>
							</div>
							<div class="cc-con">

                                <table id="list"></table>
                                <div id="pager"></div>


                            </div>
						</div>
					</div>
			</div>
		</div>
	</div>


	<!--  셀렉트박스  -->

	<script type="text/javascript">
		$(document).ready(function () {

			$('select').wSelect();
		});
	</script>

    <!--  달력과 셀렉트 박스	-->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
			(function(){
    
				var $extra_date = $('[data-js-extra-date]');
				var $end_date = $('[data-js-end-date]');
				var $start_date = $('[data-js-start-date]');


				$extra_date.Zebra_DatePicker();

				$end_date.Zebra_DatePicker({
					direction: 1,
					onClear: function(){
						extraOnChange();
						extraOnClear();
					},
					onSelect: function(val){
						extraOnChange();
						extraUpdate();      
					}
				});
				var dp_end = $end_date.data('Zebra_DatePicker');

				$start_date.Zebra_DatePicker({
					direction: true,
					pair: $end_date,
					onClear: function(){        
						endDateClear(true);
						dp_end.clear_date();

						extraOnChange();
						extraOnClear();
					},
					onSelect: function(val){
						endDateClear(false);
						extraOnChange();
						extraUpdate();
					}
				});


				function endDateClear(bool) {
					$end_date.prop('disabled', bool);
				}


				function extraOnClear(){
					$extra_date.each(function(){
						$(this).data('Zebra_DatePicker').clear_date();
					});
				}
				function extraUpdate(){
					$extra_date.each(function(){
						$(this).data('Zebra_DatePicker').clear_date();
						$(this).data('Zebra_DatePicker').update({
							direction: [$start_date.val(),$end_date.val()]
						});
					});
				}
				function extraOnChange(){
					if($start_date.val() !== '' && $end_date .val() !== ''){
						$extra_date.prop('disabled', false);
					}  else {
						$extra_date.prop('disabled', true);
					}
				}
				extraOnChange();

			})();
			
				
				$('select').wSelect();
			});
	</script>



</body>

</html>