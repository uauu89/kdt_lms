<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";
    $cateSkey = $_POST['sec_key'];

    $category = "SELECT cate_prim_link from lms_cate_secondary where cate_sec_key=$cateSkey";
    $reC = $mysqli -> query($category) or die("query error=>".$mysqli->error);
    $i = $reC->fetch_object();
    
    $result = $i->cate_prim_link;

    echo $result;

?>