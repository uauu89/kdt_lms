<?php
    session_start();

    $index = $_SERVER['DOCUMENT_ROOT'].'/kdt_lms';
    if(!$_SESSION['SSNAME']){
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='../index.php';
        </script>";
        
    };
    
    
?>