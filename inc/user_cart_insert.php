<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();

    if($_POST["conn_check"]){
        $lect = $_POST["lect"];

        $sql_check = "SELECT * from lms_cart where cart_user_link='".$_SESSION['SSIDX']."' && cart_lect_link=".$lect;
        $check = $mysqli -> query($sql_check) or die("query error=>".$mysqli->error);
        $checkResult = $check->fetch_object();


        $sql_insert = "INSERT INTO lms_cart
        (cart_user_link, cart_lect_link, regdate)
        VALUES (".$_SESSION['SSIDX'].", $lect, ".date('Y-m-d H:i:s').")";

        if(empty($checkResult)){
            $sql_insert = "INSERT INTO lms_cart
                (cart_user_link, cart_lect_link, regdate)
                VALUES (".$_SESSION['SSIDX'].", $lect, '".date('Y-m-d H:i:s')."')";
            if($mysqli -> query($sql_insert) === true){
                echo "true";
            }else{
                echo "error";
            };
        }else{
            echo "false";
        };
    }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }

?>