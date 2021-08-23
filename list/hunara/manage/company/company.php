<? include("../inc/header.php"); ?>

<script>
 
$(document).ready(function () {

    getList();

});

function getList(){

    $("#list").jqGrid({
		url: "company-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "id", "번호", "등록일", "기업명", "도메인", "담당자", "연락처", "핸드폰", "이메일" , "사원" , "휴양소"],
		colModel: [
			{ name: "idx", sortable:true, hidden:true},
			{ name: "no", sortable:true, align:"center", sorttype:'number', width:50},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 80},
			{ name: "comname", sortable:true, align:"center", width: 160},
            { name: "cdomain", sortable:true, align:"center", width: 180},
            { name: "dname", sortable:true, align:"center", width: 50},
			{ name: "tel", sortable:true, align:"center", width: 110},
            { name: "hp", sortable:true, align:"center", width: 110},
            { name: "email", sortable:true, align:"center", width: 140},
			{ name: "employeeCnt", sortable:true, align:"center", width: 50},
			{ name: "resortCnt", sortable:true, align:"center", width: 50}
			],
		pager: "#pager",
		rowNum: 10,
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onSelectRow: function(id){
        	view(id); 
        },
        loadComplete:function(data){   
        },	
		caption: ""

	});     

    jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});    
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

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "company-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    
    document.location.href = "company-view.php?idx="+idx;
}

</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents company-con">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>
		<div class="center-con ">
			<div class="cc-title">
				<div>기업관리</div>
			</div>

            <div class="com-search ">
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
                    <select name="searchType" id="searchType">
                        <option value="comname">기업명</option>
                        <option value="dname">담당자명</option>
                    </select>
                    <input type="text" name="searchValue" id="searchValue" >
                    <button type="button" onClick="search();">검색</button>
                </div>
            </div>

			<div class="cc-con">

                <table id="list"></table>
                <div id="pager"></div>


			</div>
		</div>
	</div>
	
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