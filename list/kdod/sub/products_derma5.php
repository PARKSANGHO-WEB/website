<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/modal-b.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/common.js"></script>
</head>
<body>
   <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>

      <? include "../include/gnb_sub1.php"?> 

<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$search = sqlfilter($_REQUEST['search']);
$goods_value = trim(sqlfilter($_REQUEST['goods_value']));
$goods_type = trim(sqlfilter($_REQUEST['goods_type']));
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&search='.$search.'&goods_value='.$goods_value;

$query = "select * from goods_info where idx='".$idx."' and  goods_value = '".$goods_value."' and  goods_type = '".$goods_type."'";
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);
?>
    <section class="frame5-g">
        <div class="frame5-cont">
           	<div class="f5-txt">
				<div class="title">
					<?=$row[goods_name_eng]?>
				</div>
				<div class="main">
					<div class="main-img">
			<?
			$i=1;
			$sql_file = "select list_img_o,list_img_c from goods_info2 where 1=1 and goods_idx='".$row['idx']."' order by idx asc";
			$query_file = mysqli_query($gconnet,$sql_file);
			while($row_file = mysqli_fetch_array($query_file)){
			?>
			<img src="<?=$_P_DIR_WEB_FILE?>goods/img_thumb/<?=$row_file['list_img_o']?>" alt="">
			<?
			}
			?></div>
					<div class="main-txt"><?=$row[goods_content_eng3]?></div>
				</div>
			</div>
			<div class="return">
				<button type="button" onclick="javascript:history.back();">List</button>
			</div>
        </div>
    </section>
    <script>
        $(document).ready(function(){           
            
            
            $('.visual-slider').bxSlider({
              auto: true,
              pager: true,
              mode: 'fade',
              hideControlOnEnd:true
            });
            
            $('.cont1-slider').bxSlider({
              auto: true,
              pager: true,
              hideControlOnEnd:true
            });
        });
        
        
        $(document).ready(function(){    
        var tabBtn = $("#tab-btn > ul > li");     //각각의 버튼을 변수에 저장
        var tabCont = $("#tab-cont > div");       //각각의 콘텐츠를 변수에 저장

        //컨텐츠 내용을 숨겨주세요!
        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
          var target = $(this);         //버튼의 타겟(순서)을 변수에 저장
          var index = target.index();   //버튼의 순서를 변수에 저장
          //alert(index);
          tabBtn.removeClass("active");    //버튼의 클래스를 삭제
          target.addClass("active");    //타겟의 클래스를 추가
          tabCont.css("display","none");
          tabCont.eq(index).css("display", "block");
        });
        
        
        });
    </script>
<? include "../include/footer_sub.php"?>
</body>
</html>