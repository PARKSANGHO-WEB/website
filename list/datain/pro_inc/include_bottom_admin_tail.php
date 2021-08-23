<?
//mysqli_close($gconnet);
//echo $_SERVER['REMOTE_ADDR'];  183.96.82.136
//echo "현재 아이피 = ".$_SERVER['REMOTE_ADDR'];
//echo $_SERVER["DOCUMENT_ROOT"];

if($_SERVER['REMOTE_ADDR'] == "59.5.188.44"){
	$show_iframe = true;	
}
?>
<iframe name="_fra_admin" width="90%" height="300" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
<div id="CalendarLayer" style="display:none; width:172px; height:250px; z-index:100;">
	<iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" border="0" frameborder="0" scrolling="no"></iframe>
</div>
