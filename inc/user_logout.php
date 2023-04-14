<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_dupl.php";
    session_start();

    $sql_logout = "UPDATE lms_info_user SET 
        user_connstatus=0
        WHERE idx =".$_SESSION['SSIDX'];

    if($mysqli -> query($sql_logout) === true){
        $result = session_destroy();
        if($result){
            echo"<script>
                alert('".$_SESSION['SSNAME']." 님, 로그아웃되었습니다.');
                location.href='/kdt_lms/index.php';
            </script>";
        }else{
            echo "<script>
                    alert('에러');
                    history.back();
                </script>";
        }
    }else{
        session_destroy();
        echo "<script>
            alert('오류가 발생되었습니다.');
            location.href='/kdt_lms/index.php';
        </script>";
    }

?>