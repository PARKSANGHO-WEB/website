// 로그인 여부 체크
$(document).ready(function() {
    console.log("emp_no ="+"<?=$_SESSION['EMP_NO']?>");
    if("<?=$_SESSION['EMP_NO']?>" == ""){
        login();
    }
});