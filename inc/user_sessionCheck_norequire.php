<?php
    session_start();
    if($_SESSION['SSIDX']){
        echo "<script>
                alert('이미 로그인하셨습니다.\\n 이전 페이지로 돌아갑니다.'); 
                history.back();
            </script>";
    }

    
?>