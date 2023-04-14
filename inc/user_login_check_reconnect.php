<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";

    $idx = $_POST['idx'];
    $ip = $_POST['ip'];
    $time = date("Y-m-d H:i:s");

    $sql_reconnect = "UPDATE lms_info_user set user_connstatus = 0, user_lastconn_ip='".$ip."', user_lastconn_date='".$time."' where idx =".$idx;
    
    $reconnect = $mysqli ->query($sql_reconnect) or die("query error=>".$mysqli->error);

    echo $reconnect;

?>