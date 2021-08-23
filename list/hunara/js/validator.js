/**
 validator
 폼객체 유효성 검사
******************************************************************************/

/// 에러메시지 포멧 정의 ///
var NO_BLANK = "{name+을를} 입력하여 주십시오";
var NO_SELECT = "{name+을를} 선택하여주십시오";
var NOT_VALID = "{name+이가} 올바르지 않습니다";
var TOO_LONG = "{name}의 길이가 초과되었습니다 (최대 {maxbyte}바이트)";
var TOO_SHORT = "{name}의 길이가 부족합니다 (최소 {minbyte}바이트)";

/// 스트링 객체에 메소드 추가 ///
String.prototype.trim = function(str) { 
	str = this != window ? this : str; 
	return str.replace(/^\s+/g,'').replace(/\s+$/g,''); 
}

String.prototype.hasFinalConsonant = function(str) {
	str = this != window ? this : str; 
	var strTemp = str.substr(str.length-1);
	return ((strTemp.charCodeAt(0)-16)%28!=0);
}

function trim(str){
	return str.replace(/^\s+/g,'').replace(/\s+$/g,''); 
}

function josa(str,tail) {
	return (str.hasFinalConsonant()) ? tail.substring(0,1) : tail.substring(1,2);
}

function validate(form) {
	var i=0;

	for (i = 0; i < form.elements.length; i++ ) {
		var el = form.elements[i];
		
		if(el.tagName.toUpperCase() != "OBJECT" && el.type != "file"  ) {
			try{	
				el.value = trim(el.value);
			}catch (err) {
				alert(err);
	    	return;
			}
			
			if (el.getAttribute("REQUIRED") != null) {
				//select 구문 처리
				if(el.type.indexOf("select")>-1){
					//|| el.option[el.selectedIndex].value == ""
					if (el.selectedIndex==0 ) {
						return doError(el,NO_SELECT);
					}
				}else{
					if (el.value == null || el.value == "") {
						return doError(el,NO_BLANK);
					}
				}
			}
	
			if (el.getAttribute("MAXBYTE") != null && el.value != "") {
				var len = 0;
				for(j=0; j<el.value.length; j++) {
					var str = el.value.charAt(j);
					len += (str.charCodeAt() > 128) ? 2 : 1
				}
				if (len > parseInt(el.getAttribute("MAXBYTE"))) {
					maxbyte = el.getAttribute("MAXBYTE");
					return doError(el,TOO_LONG,"",maxbyte);
				}
			}
			if (el.getAttribute("MINBYTE") != null && el.value != "") {
				var len = 0;
				for(j=0; j<el.value.length; j++) {
					var str = el.value.charAt(j);
					len += (str.charCodeAt() > 128) ? 2 : 1
				}
				if (len < parseInt(el.getAttribute("MINBYTE"))) {
					minbyte = el.getAttribute("MINBYTE");
					return doError(el,TOO_SHORT,"",minbyte);
				}
			}
	
			if (el.getAttribute("OPTION") != null && el.value != "") {
				if (!funcs[el.getAttribute("OPTION").toLowerCase()](el)) return false; 
			}
	
			if (el.getAttribute("FILETYPE") != null && el.value != "") {
				var validFileType = el.getAttribute("FILETYPE").split(",");
				var nFileType = el.value.substring(el.value.lastIndexOf(".")+1,el.length);
				var isValidFileType = false;
				for (j=0; j<validFileType.length ; j++) {
					if (nFileType.toUpperCase()==validFileType[j].toUpperCase().replace(/\s/g,"")) {
						isValidFileType = true;
					}
				}
				if (!isValidFileType) {
					var nameString = "";
					if (el.getAttribute("hname") != null && el.getAttribute("hname") != "") {
						nameString = "{name+이가} ";
					}
					return doError(el,nameString+"적절한 파일 포맷이 아닙니다.");
				}
			}
		}
	}
	return true;
}

function doError(el,type,action,byte) {
	var pattern = /{([a-zA-Z0-9_]+)\+?([가-힣]{2})?}/;
	var name = (hname = el.getAttribute("HNAME")) ? hname : el.getAttribute("NAME");

	
	pattern.exec(type);
	var tail = (RegExp.$2) ? josa(eval(RegExp.$1),RegExp.$2) : "";
	alert(type.replace(pattern,eval(RegExp.$1) + tail).replace(pattern,byte));
	if (action == "sel") {
		el.select();
	} else if (action == "del")	{
		el.value = "";
	}
	if (el.getAttribute("UNFOCUSED") == null) {
		if(el.type!="hidden"&&el.style.display.toUpperCase()!="NONE"){		
			el.focus();
		}
	}	
	return false;
}

function doErrorName(name,type,action,byte) {
	var pattern = /{([a-zA-Z0-9_]+)\+?([가-힣]{2})?}/;
	
	pattern.exec(type);
	var tail = (RegExp.$2) ? josa(eval(RegExp.$1),RegExp.$2) : "";
	alert(type.replace(pattern,eval(RegExp.$1) + tail).replace(pattern,byte));
	
	return false;
}	

/// 특수 패턴 검사 함수 매핑 ///
var funcs = new Array();
funcs['nospace'] = isNoSpace;
funcs['email'] = isValidEmail;
funcs['emailfirst'] = isValidEmailFirst;
funcs['tel'] = isValidTel;
funcs['phone'] = isValidPhone;
funcs['userid'] = isValidUserid;
funcs['hangul'] = hasHangul;
funcs['number'] = isNumeric;
funcs['number2'] = isNumeric2;
funcs['engonly'] = alphaOnly;
funcs['hangulonly'] = hangulOnly;
funcs['jumin'] = isValidJumin;
funcs['jumin'] = isValidJumin2;
funcs['bizno'] = isValidBizNo;
funcs['date'] = isValidDate;
funcs['pw'] = isValidPassword;
funcs['time'] = isValidTime;

/*****************
 * 
 * @param el
 * @param notNull : true, false
 * @param label
 * @param maxByte
 * @returns {Boolean}
 ****************/
function isValidData(el,label,notNull,maxByte){
	
	el.value = trim(el.value);
	el.setAttribute("HNAME",label);
	
	if (notNull && (el.value == null || el.value == "") ) {
		return doError(el,NO_BLANK);
	}
	
	var len = 0;
	for(j=0; j<el.value.length; j++) {
		var str = el.value.charAt(j);
		len += (str.charCodeAt() > 128) ? 2 : 1
	}
	if (len > parseInt(maxByte)) {
		return doError(el,TOO_LONG,"",maxByte);
	}
	
}

/// 패턴 검사 함수들 ///
function isNoSpace(el) {
	var pattern = /[\s]/;
	return (!pattern.test(el.value)) ? true : doError(el,"{name+은는} 띄어쓰기 없이 입력해주시기 바랍니다");
}

function isValidEmail(el) {
	var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}

function isValidEmailFirst(el) {
	var pattern = /^[_a-zA-Z0-9-\.]+$/;
	return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}



//수정 필요
function isValidUserid(el) {
	var pattern = /^[a-zA-Z]{1}[a-zA-Z0-9_]{3,11}$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 4자이상 12자 미만이어야 하고,\n 영문,숫자, _ 문자만 사용할 수 있습니다");
}

function hasHangul(el) {
	var pattern = /[가-힣]/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 한글을 포함해야 합니다");
}
function hangulOnly(el) {
	var pattern = /^[가-힣]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 한글만 입력가능 합니다");
}

function alphaOnly(el) {
	var pattern = /^[a-zA-Z]+$/;
	return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}

function isNumeric(el,label) {
	var pattern = /^[0-9]+$/;
	
	if(label != undefined && label != null ){
		el.setAttribute("HNAME",label);
	}
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
}

function isNumeric2(el,label) {
	var pattern = /^[0-9,.]+$/;
	
	if(label != undefined && label != null ){
		el.setAttribute("HNAME",label);
	}	
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
}


function isValidJumin(el) {
    var pattern = /^([0-9]{6})-?([0-9]{7})$/; 
	var num = el.value;
    if (!pattern.test(num)) return doError(el,NOT_VALID); 
    num = RegExp.$1 + RegExp.$2;

	var sum = 0;
	var last = num.charCodeAt(12) - 0x30;
	var bases = "234567892345";
	for (var i=0; i<12; i++) {
		if (isNaN(num.substring(i,i+1))) return doError(el,NOT_VALID);
		sum += (num.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
	}
	var mod = sum % 11;
	if(el.getAttribute("HNAME") == undefined ){
		el.setAttribute("HNAME","주민번호");
	}
	
	return ((11 - mod) % 10 == last) ? true : doError(el,NOT_VALID);
}

function isValidJumin2(name, value) {
    var pattern = /^([0-9]{6})-?([0-9]{7})$/; 
	var num = value;
    if (!pattern.test(num)) return doErrorName(name,NOT_VALID); 
    num = RegExp.$1 + RegExp.$2;

	var sum = 0;
	var last = num.charCodeAt(12) - 0x30;
	var bases = "234567892345";
	for (var i=0; i<12; i++) {
		if (isNaN(num.substring(i,i+1))) return doErrorName(name,NOT_VALID);
		sum += (num.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
	}
	var mod = sum % 11;
	
	return ((11 - mod) % 10 == last) ? true : doErrorName(name,NOT_VALID);
}

function isValidBizNo(el) { 
	var pattern = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/; 
	var num = el.value;
    if (!pattern.test(num)) return doError(el,NOT_VALID); 
    num = RegExp.$1 + RegExp.$2 + RegExp.$3;
    var cVal = 0; 
    for (var i=0; i<8; i++) { 
        var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7); 
        cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10; 
    } 
    var li_temp = parseFloat(num.substring(i,i+1)) * 5 + '0'; 
    cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2)); 
    return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10) ? true : doError(el,NOT_VALID); 
}

/*
function isValidPhone(el) {
	var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	if (pattern.exec(el.value)) {
		if(RegExp.$1 == "011" || RegExp.$1 == "016" || RegExp.$1 == "017" || RegExp.$1 == "018" || RegExp.$1 == "019") {
			el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
		}
		return true;
	} else {
		return doError(el,NOT_VALID);
	}
}
*/

function isValidTel(el) {

    var pattern = /^([0]{1}[0-9]{1,3})-?([0-9]{3,4})-?([0-9]{4})$/;

    if(trim(el.value)){
        if (pattern.exec(el.value)) {
            el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
            return true;
        } else {
            doError(el,"{name}는 000-0000-0000 형식으로 입력하십시오.");
        }
    }

}

function isValidPhone(el) {

    var pattern = /^([0-9]{3})-?([0-9]{3,4})-?([0-9]{4})$/;

    if(trim(el.value)){
        if (pattern.exec(el.value)) {
            el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
            return true;
        } else {
            doError(el,"{name}는 000-0000-0000 형식으로 입력하십시오.");
        }
    }

}

function isValidPhone2(el) {
	var pattern = /^[0-9-]+$/;
    var val = el.value;
    val = val.replace(/-/g,'');

    if(trim(val) == ''){
        return doError(el,"{name}가 올바르지 않습니다. ");
    }

	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
}

function isValidDate(el) {
	var param = el.value;
	
	try
	{
	    param = param.replace(/-/g,'');

	    // 자리수가 맞지않을때
	    if( isNaN(param) || param.length!=8 ) {
	        return doError(el,NOT_VALID);
	    }
	     
	    var year = Number(param.substring(0, 4));
	    var month = Number(param.substring(4, 6));
	    var day = Number(param.substring(6, 8));

	    var dd = day / 0;

	     
	    if( month<1 || month>12 ) {
	        return doError(el,NOT_VALID);
	    }
	     
	    var maxDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	    var maxDay = maxDaysInMonth[month-1];
	     
	    // 윤년 체크
	    if( month==2 && ( year%4==0 && year%100!=0 || year%400==0 ) ) {
	        maxDay = 29;
	    }
	     
	    if( day<=0 || day>maxDay ) {
	        return doError(el,NOT_VALID);
	    }
	    return true;

	} catch (err) {
	    return doError(el,NOT_VALID);
	}             	
	
}

function isValidTime(el) {

	try
	{

		var pattern = /^[0-9:]+$/;
		var val = el.value;
		
		if (!pattern.test(val)){
			return doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
		}
		
		
		return true;
		
	}catch (err) {
        return false;
    }        
}

function isValidDate3(param) {
    try
    {
        param = param.replace(/-/g,'');

        // 자리수가 맞지않을때
        if( isNaN(param) || param.length!=8 ) {
            return false;
        }
         
        var year = Number(param.substring(0, 4));
        var month = Number(param.substring(4, 6));
        var day = Number(param.substring(6, 8));

        var dd = day / 0;

         
        if( month<1 || month>12 ) {
            return false;
        }
         
        var maxDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var maxDay = maxDaysInMonth[month-1];
         
        // 윤년 체크
        if( month==2 && ( year%4==0 && year%100!=0 || year%400==0 ) ) {
            maxDay = 29;
        }
         
        if( day<=0 || day>maxDay ) {
            return false;
        }
        return true;

    } catch (err) {
        return false;
    }                       
}


function isValidDate2(el) {
	var oDateStr = el.value.replace(/\//gi,"");
  var oDate = null;

  if(oDateStr.length == 10){
	 oDate = new Date(oDateStr.substr(0,4),oDateStr.substr(5,2)-1,oDateStr.substr(8,2));
	}else {
	  oDate = new Date(oDateStr.substr(0,4),oDateStr.substr(4,2)-1,oDateStr.substr(6,2));
	}


	var oYearStr=oDate.getFullYear();

	var oMonthStr=(oDate.getMonth()+1).toString();
		
	oMonthStr = (oMonthStr.length ==1) ? "0"+ oMonthStr: oMonthStr; 
	var oDayStr=oDate.getDate().toString();
	oDayStr = (oDayStr.length ==1) ? "0"+ oDayStr: oDayStr; 

	return  (oDateStr == oYearStr+oMonthStr+oDayStr) ? true : doError(el,NOT_VALID); 
}

function isValidPassword(el) {
	var pattern = /^[A-Za-z0-9_\-\!@#]{7,8}$/;
	var patternAlpha = /[A-Z]/;
	var patternAlpha2 = /[a-z]/;
	var patternNumeric = /[0-9]/;
	return (pattern.test(el.value)
			&&patternAlpha.test(el.value)
			&&patternAlpha2.test(el.value)
			&&patternNumeric.test(el.value)) ? true : doError(el,"비밀번호가 올바르지 않습니다.\n비밀번호는 7자이상 8자 이하의 영문 대문자, 소문자, 숫자가 혼합되어있어야 합니다.");
}


function makeValidationDate(obj,obj_year,obj_month,obj_day){
	if(obj_month.value.length==1)
		obj_month.value = "0" + obj_month.value;
	if(obj_day.value.length==1)
		obj_day.value = "0" + obj_day.value;

	obj.value = obj_year.value+obj_month.value+obj_day.value;
}

function makeValidationDate_Sel(obj,obj_year,obj_month,obj_day){
	if(obj_month.options[obj_month.selectedIndex].value.length==1)
		var t_month = "0" + obj_month.options[obj_month.selectedIndex].value;
	else
		var t_month = obj_month.options[obj_month.selectedIndex].value;

	if(obj_day.options[obj_day.selectedIndex].value.length==1)
		var t_day = "0" + obj_day.options[obj_day.selectedIndex].value;
	else
		var t_day = obj_day.options[obj_day.selectedIndex].value;

	obj.value = obj_year.options[obj_year.selectedIndex].value+t_month+t_day;
}

Date.prototype.toY4MDString = function(delim) {
	if (delim == undefined) delim = "";
	var year = this.getFullYear().toString();
	var month = this.getMonth() + 1;
	var day = this.getDate();
	month = (month < 10 ? "0" : "") + month;
	day = (day < 10 ? "0" : "") + day;
	return year + delim + month + delim + day;
}





/**
 허용된 byte만큼 입력도중 실시간으로 string자르기
 <textArea>등에 사용하면 됩니다.
 onKeyup="checkByte(this,제한할byte수,"현재byte정보뿌려줄영역의ID");"
 마지막 인자는 선택사항입니다.
 ex)  onKeyup="checkByte(this,200,'nowByteShowArea');"
******************************************************************************/

function getBytes(sString) {
	var c = 0;
	for (var i=0; i<sString.length; i++) {
		c += parseInt(getByte(sString.charAt(i)));
	}
	return c;
}
function getByte(sChar) {
	var c = 0;
	var u = escape(sChar);
	if (u.length < 4) { // 반각문자 : 기본적인 영문, 숫자, 특수기호
		c++; // + 1byte
	} else {
		var s = parseInt(sChar.charCodeAt(0));
		if (((s >= 65377)&&(s <= 65500))||((s >= 65512)&&(s <= 65518))) // 반각문자 유니코드 10진수 범위 : 한국어, 일본어, 특수문자
			c++; // + 1byte
		else // 전각문자 : 위 조건을 제외한 모든 문자
			c += 2; // + 2byte
	}
	return c;
}
function cutOverText(obj,maxByte,viewAreaID) {
	var sString = obj.value;
	var c = 0;
	for (var i=0; i<sString.length; i++) {
		c += parseInt(getByte(sString.charAt(i)));
		if (c>maxByte) {
			obj.value = sString.substring(0,i);
			break;
		}
	}
	showNowByte(obj.value,viewAreaID);
}

function showNowByte(sString,viewAreaID) {
	var vArea = document.getElementById(viewAreaID);
	if (vArea) {
		var nBytes = getBytes(sString);
		try {
			vArea.innerHTML = nBytes;
		} catch(e) {
			vArea.value = nBytes;
		}
	}
}

function checkByte(obj,maxByte,viewAreaID) {
	var sString = obj.value;
	showNowByte(sString,viewAreaID);
	if (getBytes(sString) > maxByte) {
		alert("최대 "+maxByte+"Bytes(한글 "+(maxByte/2)+"자/영문 "+maxByte+"자)까지만 입력하실 수 있습니다.");
		cutOverText(obj,maxByte,viewAreaID);
	}
}



/**
 기타 유틸
******************************************************************************/

/*
 SelectBox의 값을 가져온다.
**/
function getSelectBoxValue(obj) {
	var result = "";
	try {
		result = obj.options[obj.selectedIndex].value
	} catch (e) { }
	return result;
}

/*
 다음 폼으로 이동
**/
function goNext(obj,nextObj) {
	try {
		var maxLength = obj.getAttribute("MAXLENGTH");
		if (maxLength>0&&obj.value.length==maxLength) {
			nextObj.focus();
		}
	} catch (e) { }
}

/*
 checkbox, radio 기본값 셋팅
**/
function setDefaultCheck(_obj, _value, _isNotFirstValueCheck) {
	if (_obj) {
		if (_isNotFirstValueCheck==null) _isNotFirstValueCheck = false;
		var isChecked = false;
		if (_obj.length>1) {
			for (var i=0; i<_obj.length; i++) {
				if (_obj[i].value==_value) {
					_obj[i].checked = true;
					isChecked = true;
					break;
				}
			}
			if (!_isNotFirstValueCheck&&!isChecked) _obj[0].checked = true;
		} else {
			if (_obj.value==_value) {
				_obj.checked = true;
				isChecked = true;
			}
			if (!_isNotFirstValueCheck&&!isChecked) _obj.checked = true;
		}
	}
}

/*
 멀티인풋(checkbox, radio 등) 선택된 값 가져오기
**/
function getMultiInputValue(_obj) {
	var result = "";
	if (_obj) {
		if (_obj.length>1) {
			for (var i=0; i<_obj.length; i++) {
				if (_obj[i].checked) {
					result = _obj[i].value;
					break;
				}
			}
		} else {
			if (_obj.checked) {
				result = _obj.value;
			}
		}
	}
	return result;
}



/*
 인풋의 disabled 모드 설정 (멀티인풋가능)
**/
function setDisabledMode(_obj, _isDisabled) {
	if (_obj) {
		if (_obj.length>1) {
			for (var i=0; i<_obj.length; i++) {
				_obj[i].disabled = _isDisabled;
			}
		} else {
			_obj.disabled = _isDisabled;
		}
	}
}



