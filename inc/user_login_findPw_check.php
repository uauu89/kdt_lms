<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();

    
    $conn_check = $_POST["conn_check"];

    if($conn_check){
        $conn_check = false;

        $user_id = $_POST["user_id"];
        $user_name = $_POST["user_name"];
        $user_email = $_POST["user_email"];
    
        $sql_findPw = "SELECT * from lms_info_user where user_id='$user_id' and user_name='$user_name' and user_email='$user_email'";
        
        $result = $mysqli -> query($sql_findPw) or die("query error=>".$mysqli->error);
    
    
        $i = $result -> fetch_object();
        if($i){
            $_SESSION['CODE'] = rand(1000, 9999);
            echo $_SESSION['CODE'];
        }else{
            echo $i;
            
        }
    }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }

?>

