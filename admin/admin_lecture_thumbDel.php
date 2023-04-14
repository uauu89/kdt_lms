<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $pic_key = $_POST['pic_key'];

    $sql = "UPDATE lms_pic SET 
    pic_deldate = now(),
    pic_status = 0 
    WHERE pic_key=".$pic_key;

    $sqlPic = "SELECT pic_name from lms_pic pic
        join lms_lecture lec on pic.pic_key = lec.pic_link
        where pic.pic_key=".$pic_key;


    $result = $mysqli->query($sql) or die("query error=>".$mysqli_error);
    if($result){
        $data = array('result' => "ok");
        $resultP = $mysqli->query($sqlPic) or die("query error=>".$mysqli_error);
        $picName = $_SERVER['DOCUMENT_ROOT'].'/lecThumb/'.$resultP->pic_name;
        unlink($picName);
    }else{
        $data = array('result' => "fail");
    }

?>