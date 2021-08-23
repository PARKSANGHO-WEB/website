<!-- 
    @param $numberOfPage 총 페이지 수 값 
    @param $page 현재 페이지 수 값 
    ** 위 2개의 값이 필요 **
-->
<div id="paging">
    <ul>
    <? 
        if($numberOfPage > 0 ) {
    ?>
        <li><a href="<?=$_SERVER['PHP_SELF']?>?page=1&types=<?=$types?>&search=<?=$search?>" class="first"></a></li>
        <?php
            if($page > 5) {
                echo "<li><a href='".$_SERVER['PHP_SELF']."?page=". ($page - 5) ."&types=".$types."&search=".$search."' class='prev'></a></li>";
            } else {
                echo "<li><a href='".$_SERVER['PHP_SELF']."?page=1&types=".$types."&search=".$search."' class='prev'></a></li>";
            }
            
            if ( $numberOfPage < 5) {
                for ($index = 1; $index <= $numberOfPage; $index++) {
                    if ($index == $page) {
                        echo 
                        "
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$index."&types=".$types."&search=".$search."'>".$index."</a></li>
                        ";
                    } else {
                        echo 
                        "
                            <li><a href='".$_SERVER['PHP_SELF']."?page=". $index ."&types=".$types."&search=".$search."'>".$index."</a></li>
                        ";
                    }
                }
            } 
            else {
                if ($page == ($numberOfPage - 3)) {
                    echo 
                    "
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."&types=".$types."&search=".$search."'>".($page - 1)."</a></li>
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$page."&types=".$types."&search=".$search."'>".$page."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."&types=".$types."&search=".$search."'>".($page + 1)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 2)."&types=".$types."&search=".$search."'>".($page + 2)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 3)."&types=".$types."&search=".$search."'>".($page + 3)."</a></li>
                    ";
                } elseif ($page == ($numberOfPage - 2)) {
                    echo 
                    "
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 2)."&types=".$types."&search=".$search."'>".($page - 2)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."&types=".$types."&search=".$search."'>".($page - 1)."</a></li>
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$page."&types=".$types."&search=".$search."'>".$page."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."&types=".$types."&search=".$search."'>".($page + 1)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 2)."&types=".$types."&search=".$search."'>".($page + 2)."</a></li>
                    ";
                } elseif ($page == ($numberOfPage - 1)) {
                    echo
                    "
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 3)."&types=".$types."&search=".$search."'>".($page - 3)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 2)."&types=".$types."&search=".$search."'>".($page - 2)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."&types=".$types."&search=".$search."'>".($page - 1)."</a></li>
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$page."&types=".$types."&search=".$search."'>".$page."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."&types=".$types."&search=".$search."'>".($page + 1)."</a></li>
                    ";
                } elseif ($page == $numberOfPage) {
                    echo
                    "
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 4)."&types=".$types."&search=".$search."'>".($page - 4)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 3)."&types=".$types."&search=".$search."'>".($page - 3)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 2)."&types=".$types."&search=".$search."'>".($page - 2)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."&types=".$types."&search=".$search."'>".($page - 1)."</a></li>
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$page."&types=".$types."&search=".$search."'>".$page."</a></li>
                    ";
                } else {
                    echo
                    "
                        <li class='active'><a href='".$_SERVER['PHP_SELF']."?page=".$page."&types=".$types."&search=".$search."'>".$page."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."&types=".$types."&search=".$search."'>".($page + 1)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 2)."&types=".$types."&search=".$search."'>".($page + 2)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 3)."&types=".$types."&search=".$search."'>".($page + 3)."</a></li>
                        <li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 4)."&types=".$types."&search=".$search."'>".($page + 4)."</a></li>
                    ";
                }
            }
            if($page < ($numberOfPage - 5)) {
                echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 5)."&types=".$types."&search=".$search."' class='next'></a></li>";
            } else {
                echo "<li><a href='".$_SERVER['PHP_SELF']."?page=". $numberOfPage ."&types=".$types."&search=".$search."' class='next'></a></li>";
            }
        ?>
        <li><a href="<?$_SERVER['PHP_SELF']?>?page=<?=$numberOfPage?>&types=<?=$types?>&search=<?=$search?>" class="last"></a></li>
    <? 
        }
    ?>

    </ul>

    <?
        if(isset($writeUrl)){
    ?>
        <a href="<?=$writeUrl?>"><div class="go-write">글쓰기</div></a>
    <?            
        }
    ?>
</div>
