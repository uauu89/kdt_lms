<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    if($_FILES['savefile']['size'] > 2097152){
        $return_data = array("result" => "size");
        echo json_encode($return_data);
        exit;
    };
    if($_FILES['savefile']['type'] != 'image/png'
    and $_FILES['savefile']['type'] != 'image/gif'
    and $_FILES['savefile']['type'] != 'image/jpeg') {
        $return_data = array("result" => "image");
        echo json_encode($return_data);
        exit;
    };
    
    $save_dir = $_SERVER['DOCUMENT_ROOT']."/kdt_lms/lectThumb/";
    $filename = $_FILES['savefile']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $newfilename = date("YmdHis").substr(rand(), 0, 6);
    $savefile = $newfilename.'.'.$ext;

    if(move_uploaded_file($_FILES['savefile']['tmp_name'], $save_dir.$savefile)){
        $sql = "INSERT into lms_pic (pic_name) VALUES ('{$savefile}')";
        $result = $mysqli -> query($sql);
        $pic_key = $mysqli -> insert_id;

        $return_data = array("result" => "success", "pic_key" => $pic_key, "savename" => $savefile);
        echo json_encode($return_data);
    }else{
        $return_data = array("result" => "error");
        echo json_encode($return_data);
        exit;
    }
?>