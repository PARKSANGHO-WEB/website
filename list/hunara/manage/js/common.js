$(document).ready(function(){

    $('#txt_menu1').html($('.lm-t p').html());
    $('#txt_menu2').html($('ul li .active a').html());

    $('.view-t').on('click',function(){
        if( $(this).parents('.view').hasClass('on') ){
            $(this).parents('.view').removeClass('on');
        }else{
            $('.view').removeClass('on');
            $(this).parents('.view').addClass('on');
        }
    });

});

/* 예약자명 클릭시  프론트 화면으로 새창 오픈 */
function employeeLogin(cidx, sano){

    var newForm = document.createElement('form');
    newForm.name = 'popForm'; 
    newForm.method = 'post'; 
    newForm.action = '/manage/popup/login_employee2.php'; 
    newForm.target = '_blank';

    var input1 = document.createElement('input'); 
    var input2 = document.createElement('input'); 
    input1.setAttribute("type", "hidden"); 
    input1.setAttribute("name", "cidx"); 
    input1.setAttribute("value", cidx); 
    input2.setAttribute("type", "hidden"); 
    input2.setAttribute("name", "sano"); 
    input2.setAttribute("value", sano );

    newForm.appendChild(input1); 
    newForm.appendChild(input2); 
    document.body.appendChild(newForm);
    
    newForm.submit();

}

/* 그리드 데이터 엑셀로 export */
function exportExcel(gridId) {

    //선택된 체크박스 ID
    var selectedId = new Array();
    $("input[type=checkbox]:checked").each(function(){
        if($(this).val() != "on"){
            selectedId.push($(this).val());
        }
    });


    var pGridObj = $("#"+gridId);
    var pFileName = "Data";
	var mya = pGridObj.getDataIDs();
	var data = pGridObj.getRowData(mya[0]);
    
	var colNames = new Array();
    var colHeaders = new Array();
	var ii = 0;
    var colModel = pGridObj.jqGrid('getGridParam', 'colModel');
    $.each(colModel, function(i){
        if(!this.hidden && this.name != "idx" ){
            colNames[ii] = this.name;
            colHeaders[ii] = this.label;
            ii++;
        }

    });

    var html = "<table border=1><tr>"; 
	for (var y = 0; y < colHeaders.length; y++) {
		html = html + "<td style=\"mso-number-format:'\@'\"><b>";

        if(colHeaders[y] != 'null' && colHeaders[y] != null){
            html = html + colHeaders[y];
        }
         html = html + "</b></td>";
	}

	html = html + "</tr>";


	//값 불러오기
    var mya = $("#"+gridId).jqGrid('getGridParam','data');
	for (var i = 0; i < mya.length; i++) {
        var datac = mya[i];
        
        if(selectedId.length > 0){
            //선택된 행 데이터만 조회
            if(selectedId.indexOf(datac["idx"]) > -1){
                html = html + "<tr>";
                for (var j = 0; j < colNames.length; j++){
                    html = html + '<td style="mso-number-format:\'\@\'">';

                    if(datac[colNames[j]] != 'null' && datac[colNames[j]] != null){
                        var data = String(datac[colNames[j]]);
                        data = data.replace('\n','<br>');

                        html = html + data;
                    }
                    html = html +  "</td>";
                }
                html = html + "</tr>";
            }

        }else{
            
            // 그리드 전체 데이터 조회
            html = html + "<tr>";
            for (var j = 0; j < colNames.length; j++){

                html = html + '<td style="mso-number-format:\'\@\'">';
                
                if(datac[colNames[j]] != 'null' && datac[colNames[j]] != null){

                    var data = String(datac[colNames[j]]);
                    data = data.replace('\n','<br>');
                    html = html + data;
                }
                
                html = html +  "</td>";
            }
            html = html + "</tr>";
        }
	}

	html = html + "</table>"; // end of line at the end

    var newForm = document.createElement('form');
    newForm.name = 'excelForm'; 
    newForm.method = 'post'; 
    newForm.action = '/manage/inc/down_excel.php'; 
    newForm.target = '_blank';

    var input1 = document.createElement('input'); 
    var input2 = document.createElement('input'); 
    input1.setAttribute("type", "hidden"); 
    input1.setAttribute("name", "csvBuffer"); 
    input1.setAttribute("value", html); 
    input2.setAttribute("type", "hidden"); 
    input2.setAttribute("name", "fileName"); 
    input2.setAttribute("value", encodeURIComponent(pFileName) );

    newForm.appendChild(input1); 
    newForm.appendChild(input2); 
    document.body.appendChild(newForm);
    
    newForm.submit();

}