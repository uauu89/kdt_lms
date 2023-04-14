<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();

    if($_POST["conn_check"]){
        $cart_lect_link = $_POST["lect"];
        $cart_user_link = $_SESSION["SSIDX"];
        
        $sql_delete = "DELETE from lms_cart where cart_user_link=$cart_user_link && cart_lect_link=$cart_lect_link";
    
        $delete = $mysqli -> query($sql_delete) or die("query error=>".$mysqli->error);
    
        echo $delete;
    }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }
?>