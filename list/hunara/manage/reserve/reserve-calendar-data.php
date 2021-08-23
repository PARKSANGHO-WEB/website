<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $startDate = trim(sqlfilter($_REQUEST['startDate']));
    $endDate = trim(sqlfilter($_REQUEST['endDate']));
    $defaultCnt = false;
    $revList = [];
    $rev = array("name"=>"", "cnt"=>"", "date" => "");
    
    $sql .= " SELECT t.date as startDate, count(r.ridx) as cnt, min(r.name) as name  ";
    $sql .= " FROM( ";
    $sql .= "           select date_format(a.Date, '%Y%m%d') as Date from ( ";
    $sql .= "               select date_format('{$endDate}', '%Y-%m-%d') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date ";
    $sql .= "               from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a ";
    $sql .= "               cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b ";
    $sql .= "               cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c ";
    $sql .= "           ) a where a.Date between date_format('{$startDate}', '%Y-%m-%d') and date_format('{$endDate}', '%Y-%m-%d') ";
    $sql .= " )t, tb_reInfo r ";
    $sql .= " WHERE r.regflag = '5' ";
    $sql .= "   AND t.date BETWEEN r.cymd AND r.cymd2  ";
    $sql .= " GROUP BY t.Date ORDER BY t.Date ";

    $rs = mysqli_query($gconnet, $sql); 

    $defaultCnt = true;

    for($i=0; $i < mysqli_num_rows($rs); $i++){
        $row = mysqli_fetch_array($rs);
        
        $rev["name"] = $row['name'];
        $rev["cnt"] = $row['cnt'];
        $rev["date"] = to_date($row['startDate']);

       	array_push($revList, $rev);
   	}

    
    echo json_encode($revList, JSON_UNESCAPED_UNICODE);
    exit;



?>