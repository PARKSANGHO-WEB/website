<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<script src="/manage/js/modal.js"></script>
<script src="../js/jquery.jqgrid.min.js" defer></script>

<script>
$(document).ready(function () {
	$("#list").jqGrid({
		url: "/manage/room/room-sample-data.php",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "휴양소명", "연락처", "홈페이지", "등록객실"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:checkBox, width: 58},
			{ name: "no", sortable:true, align:"center", sorttype:'number', width: 98},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 140},
			{ name: "comname", sortable:true, align:"center", width: 210},
			{ name: "tel", sortable:true, align:"center", width: 136},
			{ name: "homepage", sortable:true, align:"center", width: 294},
			{ name: "room", sortable:true, align:"center", width: 139}
			],
		pager: "#pager",
		rowNum: 10,
		rowList: [10,20,30],
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
        //multiselect:true, // checkbox 생성
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: ""

		}); 
        
        jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});
        jQuery("#list").jqGrid('sortableRows');
	});

    function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"'>";
        
        return str;
    }




</script>
    
        <div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>기업 검색</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>

            <table id="list"></table>
            <div id="pager"></div>            


            <!--
			<form action="#">
				<div class="mo-con">
					<div class="list-wrap">
						<div class="list-table">
							<table id="sortRc">
								<thead>
									<tr>
										<th>선택</th>
										<th class="th-btn"><span>번호</span></th>
										<th class="th-btn"><span>등록일</span></th>
										<th class="th-btn"><span>기업명</span></th>
										<th class="th-btn"><span>담당자</span></th>
										<th class="th-btn"><span>연락처</span></th>
										<th class="th-btn"><span>핸드폰</span></th>
										<th class="th-btn"><span>휴양소</span></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
								</tbody>
							</table>
							<div class="paging">
								<a class="first"></a>
								<a class="prev"></a>
								<a class="active">1</a>
								<a>2</a>
								<a>3</a>
								<a>4</a>
								<a>5</a>
								<a class="next"></a>
								<a class="last"></a>
							</div>	
							<div class="btn-apply">
								<button type="button">등록</button>
								<button type="button">취소</button>
							</div>						
						</div>
					</div>
				</div>
			</form>
            -->            
		</div>

