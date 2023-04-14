<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();

    $user_id = $_SESSION['SSID'];
    $user_pw = hash("sha512", $_POST["user_pw"]);

    $sql = "SELECT * from lms_info_user where user_id='$user_id' and user_pw = '$user_pw'";
    
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);

    $i = $result -> fetch_object();

    if($i){
        $_SESSION['MODIFY'] = true;
        echo "<script>location.href='/kdt_lms/user_my_modify.php';</script>";
    }else{
        echo "<script>alert('회원정보 확인에 실패하였습니다.');history.back();</script>";
    }


?>

