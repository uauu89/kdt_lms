<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";

    $catePkey = $_POST['prim_key'];

    $cateC = "SELECT * from lms_cate_secondary where cate_prim_link=".$catePkey;

    $reC = $mysqli -> query($cateC) or die("query error=>".$mysqli->error);
    $returned = "<li><input type='radio' id='catS_0' name='cate_sec' value='0' checked onclick='func_sec_subcategory(this)'><label for='catS_0'>전체</label></li>";
    while($i = $reC->fetch_object()){
        $returned .="<li><input type='radio' id='catS_$i->cate_sec_key' name='cate_sec' value='$i->cate_sec_key' onclick='func_sec_subcategory(this)'><label for='catS_$i->cate_sec_key'>$i->cate_sec_name</label></li>";
    }

    echo $returned;

  

?>