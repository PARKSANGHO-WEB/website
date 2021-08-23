function insert_data(session_id,page_idx,check_idx,last) {
	$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
		url:"./action.php",
		method:"POST",
		async: false,
		dataType: "json",
		data:{"session_id":session_id,'page_idx':page_idx,'check_idx':check_idx},
		success:function(data){
			console.log(data);
			var a = parseInt(data);
			console.log(a);
			if(last == 8){
				if(a > 6)
					location.href="result01.php";
				if(a == 6 || a == 5)
					location.href="result02.php";
				if(a == 4)
					location.href="result03.php";
				if(a == 3 || a == 2)
					location.href="result04.php";
				if(a < 2)
					location.href="result05.php";
			}
		}
	});
}

function get_data(url, element_id, params,params2,params3,params4) {
  if (params != '') {
    url = url + '?' + encodeURI(params) + '&' +  encodeURI(params2)  + '&' +  encodeURI(params3)+ '&' +  encodeURI(params4)
  }
  $.ajax({
    type: 'get',
    url: url,
    dataType: 'html',
  }).done(function (data) {
    $('#' + element_id).html(data)
  })
}
