<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    
    $user_id = $_POST["user_id"];
    $user_pw = hash("sha512", $_POST["user_pw"]);
    $user_pw_check = hash("sha512", $_POST["user_pw_check"]);
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];

    if(
        mb_strlen($user_id) < 21 &&
        $user_pw == $user_pw_check &&
        mb_strlen($user_pw) < 256 &&
        mb_strlen($user_name) < 8 &&
        mb_strlen($user_email) < 51
    ){
        $user_create_conn_check = true;
        include_once $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_login_create_insert.php";

    }else{
        echo "<script>
            alert('입력된 정보가 잘못되었습니다.');
            location.href = '/kdt_lms/user_login_create.php';
        </script>";
    };
    
?>