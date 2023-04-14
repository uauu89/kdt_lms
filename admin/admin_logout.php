<?php
    session_start();

    $loginId = $_SESSION['SSNAME'];
    $result = session_destroy();

    if($result){
        
        echo"<script>
            alert('$loginId 님, 로그아웃되었습니다.');
            location.href='admin_login.php';
        </script>";
    }
?>