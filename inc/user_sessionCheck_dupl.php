<?php
    // include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();
    
    if($_SESSION['SSIDX']){
        // echo "exist";
        $sql_ipcheck = "SELECT * from lms_info_user where idx=".$_SESSION['SSIDX'];
        $ipcheck = $mysqli -> query($sql_ipcheck) or die("query error=>".$mysqli->error);
        $c = $ipcheck -> fetch_object();

        if($_SESSION['SSIP'] != $c -> user_lastconn_ip){
            session_destroy();
            echo "<script>
                    alert('같은 계정으로 중복 로그인이 감지되어 접속을 종료합니다.');
                    location.href='/kdt_lms/index.php';
                </script>";
        }
    }
?>