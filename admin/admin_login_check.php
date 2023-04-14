<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/dbcon.php";
    session_start();
    

    $admin_id = $_POST["admin_id"];
    $admin_pw = hash("sha512", $_POST["admin_pw"]);

    $sql = "SELECT * from lms_info_admin where admin_id = '{$admin_id}' and admin_pw = '{$admin_pw}'";
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);

    $i = $result -> fetch_object();

    if($i){
        $_SESSION['SSNAME'] = $i -> admin_name;
        $_SESSION['SSPOS'] = $i -> admin_pos;
        $_SESSION['SSTIME'] = date("Y-m-d H:i:s");
        session_id();

        echo "<script>
            alert('".$i -> admin_name."님 어서오세요');
            location.href='admin_lecture_list.php';
            </script>";

    }else{
        echo "<script>
            alert('아이디 또는 비밀번호가 일치하지 않습니다');
            history.back();
        </script>";
    }
?>
