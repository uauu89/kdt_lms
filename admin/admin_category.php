<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    $catePkey = $_POST['prival'];
    $cateC = "SELECT * from lms_cate_secondary where cate_prim_link=".$catePkey;
    $reC = $mysqli -> query($cateC) or die("query error=>".$mysqli->error);
    while($i = $reC->fetch_object()){
        $returned .= "<option value='".$i->cate_sec_key."'>".$i->cate_sec_name."</option>";
    }
    echo $returned;
?>