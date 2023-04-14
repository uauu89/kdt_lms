<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $lect_key_array = explode(",",  $_POST["pageId"]);

    $lect_cate_pri = $_POST["lect_cate_pri"];
    $lect_cate_sec = $_POST["lect_cate_sec"];
    $lect_price = $_POST["lect_price"];

    $lect_status = $_POST["lect_status"];
    $lect_opt_prem = $_POST["lect_opt_prem"] ?? 0;
    $lect_opt_repre = $_POST["lect_opt_repre"] ?? 0;
    $lect_opt_begin = $_POST["lect_opt_begin"] ?? 0;

    foreach($lect_key_array as $lect_key){
        $sql = "UPDATE lms_lecture SET
            lect_cate_pri='".$lect_cate_pri."',
            lect_cate_sec='".$lect_cate_sec."',
            lect_price='".$lect_price."',
            lect_status='".$lect_status."',
            lect_opt_prem='".$lect_opt_prem."',
            lect_opt_repre='".$lect_opt_repre."',
            lect_opt_begin='".$lect_opt_begin."'
            WHERE lect_key=".$lect_key;
        $result = $mysqli->query($sql) or die("query error=>".$mysqli_error);
        
        if(!$result){
            echo "<script>
                alert('수정 에러');
            </script>";
            break;
        };
    }

    echo "<script>
            alert('수정되었습니다.');
            location.href='admin_lecture_list.php';
        </script>";
    
?>