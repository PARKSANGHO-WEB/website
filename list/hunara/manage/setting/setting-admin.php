<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<link rel="stylesheet" href="/manage/css/setting.css">

<script>
 
$(document).ready(function () {

    getList();

});

function getList(){
    $("#list").jqGrid({
        
		url: "admin_data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "아이디", "성명", "연락처", "이메일","등록일"],
		colModel: [
			{ name: "idx", sortable:false, align:"center" , hidden:true , width:30} ,
			{ name: "no", sortable:true, align:"center", sorttype:'number', width:40},
			{ name: "mem_idx", sortable:true, align:"center", width: 40},
			{ name: "mem_name", sortable:true, align:"center", width: 40},
            { name: "mem_tel", sortable:true, align:"center", sorttype:'date', width: 40},
            { name: "email", sortable:true, align:"center", width: 100},
			{ name: "nows", sortable:true, align:"center", sorttype:'date', width: 100}
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


function search(){

    var dataArr = {
            field : $('#field').val()
        ,   keyword : $('#keyword').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);
    //console.log(dataArr);
	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "admin_data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    
    document.location.href = "setting-admin-view.php?idx="+idx;
}

</script>

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
        const query = 'input[name="notice[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });
        
        // 출력
        if(result){
            location.href='./notice_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }
    }
	
//-->
</SCRIPT>

<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents setting-admin">
		<div class="left-menu">
			<div class="lm-t">
				<p>설정 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">설정 관리</p>
					<div class="lm-list">
						<ul>
							<li class="active"><a href="./setting-admin.php">관리자 정보 관리</a></li>
							<li><a href="./setting-pop.php">기업별 팝업 관리</a></li>
							<!--<li><a href="./counter_visit.php">조회수</a></li>-->
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>관리자 정보 관리</div>
			</div>
			<div class="cc-con">
                <form name="s_mem" id="s_mem" method="post" action="<?php $_SERVER[PHP_SELP] ?>">
                    <div class="set-tab">
                        <div class="set-sear">
                            <select name="field" id="field">
                                <option value="default" disabled selected>검색기준</option>
                                <option value="a.mem_idx" <?=$field=="a.mem_idx"?"selected":""?>>아이디</option>
								<option value="a.mem_name" <?=$field=="a.mem_name"?"selected":""?>>이름</option>
                            </select>
                            <input type="text" name="keyword" id="keyword" value="<?=$keyword?>">
						    <button type="button" class="msel-search" onclick="search();">검색</button>
                        </div>
                </form>
                <div class="btn-float">
                    <button type="button" onclick="location.href='./admin_write.php'">관리자등록</button>
                </div>

                <table id="list"></table>
                <div id="pager"></div>

				
			</div>
		</div>
	</div>
	
	
	<!--  셀렉트 박스  -->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
				$('select').wSelect();
			});

	</script>
	
</body>
</php>