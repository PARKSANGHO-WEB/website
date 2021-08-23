<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){
    $("#list").jqGrid({
        
		url: "review-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "제목", "작성자", "작성일", "조회수"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:checkBox, width:40} ,
			{ name: "no", sortable:true, align:"center", sorttype:'integer', width:60},
			{ name: "title", sortable:true, align:"left", width: 240},
			{ name: "name", sortable:true, align:"center", width: 80},
            { name: "nows", sortable:true, align:"center", sorttype:'date', width: 80},
            { name: "hit", sortable:true, align:"center", width: 50}
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

	   		if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn')
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
        var str = "<input type='checkbox' id='review[]' name='review[]' required='yes'  message='체크' value='"+idx+"'";
        
        return str;
}

function search(){

    var dataArr = {
            field : $('#field').val()
        ,   keyword : $('#keyword').val()
        ,   id : $('#id').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);
    //console.log(dataArr);
	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "review-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    
    document.location.href = "review-view.php?idx="+idx;
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
                frm.action = "review_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/
        /*const query = 'input[name="review[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });
        
        // 출력
        if(result){
            location.href='./review_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }*/

        let result = '';
        $('input[name="review[]"]:checked').each(function(){
            result += $(this).val() + ',';
        });
        
        // 출력
        if(result){
            location.href='./review_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }
    }
	
//-->
</SCRIPT>

<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents-review contents">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/notice/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>이용후기</div>
			</div>
			<div class="cc-con">
			<form name="s_mem" id="s_mem" method="post" action="<?php $_SERVER[PHP_SELP] ?>">
					
					<div class="com-tab">
						<div class="big-wsel">
                            <select name="id" id="id">
                                <option value="">기업명을 선택하세요.</option>
                                <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                            </select>
						</div>
						<div class="small-wsel">
							<select name="field" id="com-small">
								<option value="all" <?=$field=="all"?"selected":""?>>전체</option>
								<option value="a.title" <?=$field=="a.title"?"selected":""?>>제목</option>
								<option value="a.name" <?=$field=="a.name"?"selected":""?>>작성자</option>
								<option value="a.content" <?=$field=="a.content"?"selected":""?>>내용</option>
							</select>
						<input type="text" name="keyword" id="keyword" value="<?=$keyword?>">
						<button type="button" onclick="search();">검색</button>
						</div>
					</div>
            </form>
					<div class="all-c">
						<input type="checkbox" id="reAll" data-check-pattern="[name^='review']" name="reAll">
						<label for="reAll">전체선택</label>
						<button type="button" onclick="go_tot_del();" class="l-btn">선택삭제</button>
					</div>

                    <table id="list"></table>
                    <div id="pager"></div>

			</div>
		</div>
	</div>
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.php

			var inputs = document.querySelectorAll('.file-input')

			for (var i = 0, len = inputs.length; i < len; i++) {
			customInput(inputs[i])
			}

			function customInput (el) {
				const fileInput = el.querySelector('[type="file"]')
				const label = el.querySelector('[data-js-label]')

				fileInput.onchange =
				fileInput.onmouseout = function () {
					if (!fileInput.value) return

					var value = fileInput.value.replace(/^.*[\\\/]/, '')
					el.className += ' -chosen'
					label.innerText = value
				}
			}
		});


		
	</script>
	
	
	
	<!-- 테이블 sort 선언	-->
	
	
	<script>
		$(document).ready(function(){
			
			$('.view-t').on('click',function(){
					if( $(this).parents('.view').hasClass('on') ){
						$(this).parents('.view').removeClass('on');
					}else{
						$('.view').removeClass('on');
						$(this).parents('.view').addClass('on');
					}
				});
		});
	
	</script>
	
</body>
</html>