<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();

    $lect = $_POST['idx'];
    $conn_check = $_POST['conn_check'];

    if($conn_check==true){
        $conn_check = false;
        $sql_delItem = "DELETE from lms_myclass where myclass_user=".$_SESSION['SSIDX']." and myclass_lect=$lect";
        $del = $mysqli->query($sql_delItem) or die("query error=>".$mysqli_error);
    
        echo $del;

    }else{
        echo "<script>
                alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
                location.href='/kdt_lms/index.php';
            </script>";
    }



?>