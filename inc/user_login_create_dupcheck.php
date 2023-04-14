<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";

    $val_id = $_POST['id'];

    $sql_check = "SELECT idx from lms_info_user where user_id = '$val_id'";
    $check = $mysqli ->query($sql_check) or die("query error=>".$mysqli->error);
    $result = $check -> fetch_assoc();

    echo isset($result)? "true": "false";
?>