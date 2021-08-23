<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="../css/reserve.css">
<?
$sidx = sqlfilter($_REQUEST['sidx']); //설문지 순번
$hidx = sqlfilter($_REQUEST['hidx']); //휴양소 순번


$query = " SELECT a.cidx, a.hidx, b.comname, c.comname as huname, a.answer, (select count(*) cnt from tb_survey_question where cidx = a.cidx and sidx = a.sidx ) as cnt ";
$query .= " FROM ( ";
$query .= "         select  a.cidx, a.sidx, a.hidx, count(distinct a.ridx) as answer  ";
$query .= "         from tb_survey_answer a ";
$query .= "         where 1=1  ";
$query .= "           and a.sidx = {$sidx} and a.hidx = {$hidx} ";
$query .= "         group by a.cidx, a.sidx, a.hidx  ";
$query .= " )a, tb_company b, tb_hu c ";
$query .= " WHERE a.cidx = b.idx and a.hidx = c.idx ";


$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);
$cidx = $row['cidx'];
$cnt = $row['cnt'];

?>
<script>
$(document).ready(function () {

    getList();
    

});

function getList(){
    
    var dataArr = {
        cidx : $('#cidx').val()
        ,   idx : $('#sidx').val()
        ,   hidx : $('#hidx').val()
    }

    console.log(dataArr);

    var cnt = Number('<?=$cnt?>');
    var colList = [];

    colList.push({ name: "no", label:"순번", sortable:true, align:"center", width: 50});
    colList.push({ name: "wdate", label:"등록일", sortable:true, align:"center", sorttype:'date', width: 80});

    for(var i=1; i<= cnt; i++){
        colList.push({ name: i+"", label:i+"", align:"center"});
    }

    $("#list").jqGrid({
        url: "/manage/reserve/reserve-survey-view-data.php", 
		datatype: "json",
		mtype: "post",
        postData : dataArr,
        colModel: colList,
        pager: "#pager",
        rowNum: 10,
        sortname: "no",
        sortorder: "desc",
        height: 'auto',
        autowidth : true,
        shrinkToFit : false,
        viewrecords: true,
        gridview: true,
        loadonce : true,
        loadComplete:function(data){   
            console.log(data);
            
        },	
        caption: ""

    });     

    $("#list").jqGrid('setGroupHeaders', {
        useColSpanStyle: true, 
        groupHeaders:[
            {startColumnName: '1', numberOfColumns: cnt, titleText: '<span style="color:#ffffff; font-size:13px;">문항</span>'},
        ]
    }); 


}


function getList2(){
    
    var dataArr = {
        cidx : $('#cidx').val()
        ,   sidx : $('#sidx').val()
        ,   hidx : $('#hidx').val()
    }

    console.log(dataArr);

    $("#list").jqGrid({
        url: "/manage/reserve/reserve-survey-view-data.php", 
		datatype: "json",
		mtype: "post",
        postData : { sidx : '1', cidx : '105', hidx : '20', idx :'1' },
        colModel: [
            { name: "cidx", label: "cidx", align:"center"},
            { name: "sidx", label: "sidx", align:"center"},
            { name: "hidx", label: "hidx", align:"center"},
            { name: "idx", label: "idx", align:"center"}
        ],
        pager: "#pager",
        rowNum: 10,
        height: 'auto',
        autowidth : true,
        shrinkToFit : false,
        viewrecords: true,
        gridview: true,
        loadonce : true,
        loadComplete:function(data){   
            console.log(data);
        },	
        caption: ""

    });     


}


</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>

	<div class="contents survey-result-v">
        <? 
        $MENU_DEPTH1 = "3";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
        ?>
		<div class="center-con">
			<div class="cc-title">
				<div>설문 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>결과 관리</div>
			</div>
			<div class="cc-con">
				<form name="frm" action="#">
                    <input type="hidden" id="cidx" name="cidx" value="<?=$cidx?>" >
                    <input type="hidden" id="sidx" name="sidx" value="<?=$sidx?>" >
                    <input type="hidden" id="hidx" name="hidx" value="<?=$hidx?>" >
					<div class="view-c">
						<div class="view-mana">
							<div class="com-search">
								<div class="company">
									<span class="ct-t">기업</span>
									<span class="ct-c"><?=$row['comname']?></span>
								</div>
								<div class="room">
									<span class="ct-t">휴양소</span>
									<span class="ct-c"><?=$row['huname']?></span>
								</div>
								<div class="num">
									<span class="ct-t">응답수</span>
									<span class="ct-c"><?=number_format($row['answer'])?></span>
									<button class="print" type="button" onClick="exportExcel('list');">엑셀다운로드</button>
								</div>
							</div>

                            <table id="list"></table>
                            <div id="pager"></div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>