<?php
    session_start();
    if(!$_SESSION['SSIDX']){
        echo "<script>
                alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
                location.href='/kdt_lms/index.php';
            </script>";
    }

    
?>