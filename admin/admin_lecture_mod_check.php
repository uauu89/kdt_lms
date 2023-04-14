<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";
    ini_set("display_errors", "1");

    $lect_key = $_POST["lect_key"];
    $lect_cate_pri = $_POST["lect_cate_pri"];
    $lect_cate_sec = $_POST["lect_cate_sec"];
    $lect_name = $_POST["lect_name"];
    $lect_video = $_POST["lect_video"];
    $lect_price = $_POST["lect_price"];
    $lect_regdate = $_POST["lect_regdate"];
    $lect_expdate = $_POST["lect_expdate"];
    $lect_status = $_POST["lect_status"];
    $lect_opt_prem = $_POST["lect_opt_prem"] ?? 0;
    $lect_opt_repre = $_POST["lect_opt_repre"] ?? 0;
    $lect_opt_begin = $_POST["lect_opt_begin"] ?? 0;
    $lect_desc = $_POST["lect_desc"];

    $sql = "UPDATE lms_lecture SET
        lect_cate_pri='".$lect_cate_pri."',
        lect_cate_sec='".$lect_cate_sec."',
        lect_name='".$lect_name."',
        lect_video='".$lect_video."',
        lect_price='".$lect_price."',
        lect_regdate='".$lect_regdate."',
        lect_expdate='".$lect_expdate."',
        lect_status='".$lect_status."',
        lect_opt_prem='".$lect_opt_prem."',
        lect_opt_repre='".$lect_opt_repre."',
        lect_opt_begin='".$lect_opt_begin."',
        lect_desc='".$lect_desc."'
        WHERE lect_key=".$lect_key;
        
    if($mysqli -> query($sql) === true){
        echo "<script>
                alert('수정되었습니다.');
                location.href = 'admin_lecture_detail.php?page=$lect_key';
            </script>";
    }else{
        echo "<script>
                alert('등록 에러');
                history.back();
            </script>";
    };
?>
