<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $lect_cate_pri = $_POST["lect_cate_pri"];
    $lect_cate_sec = $_POST["lect_cate_sec"];
    $lect_name = $_POST["lect_name"];
    $lect_video = $_POST["lect_video"];
    $pic_link = $_POST["lect_pic_link"];
    $lect_price = $_POST["lect_price"];
    $lect_regdate = $_POST["lect_regdate"];
    $lect_expdate = $_POST["lect_expdate"];
    $lect_status = $_POST["lect_status"];
    $lect_opt_prem = $_POST["lect_opt_prem"] ?? 0;
    $lect_opt_repre = $_POST["lect_opt_repre"] ?? 0;
    $lect_opt_begin = $_POST["lect_opt_begin"] ?? 0;
    $lect_desc = $_POST["lect_desc"];

    $sql = "INSERT INTO lms_lecture (lect_cate_pri, lect_cate_sec, lect_name, lect_video, pic_link, lect_price, lect_regdate, lect_expdate, lect_status, lect_opt_prem, lect_opt_repre, lect_opt_begin, lect_desc) 
            VALUES ('$lect_cate_pri', '$lect_cate_sec', '$lect_name', '$lect_video', '$pic_link', '$lect_price', '$lect_regdate', '$lect_expdate', '$lect_status', '$lect_opt_prem', '$lect_opt_repre', '$lect_opt_begin', '$lect_desc')";

    if($mysqli -> query($sql) === true){
        
        echo "<script>
            alert('등록되었습니다.');
            location.href = 'admin_lecture_list.php';</script>";
    }else{
        echo "<script>
            alert('등록 에러');
            history.back();</script>";
    };
    ?>
