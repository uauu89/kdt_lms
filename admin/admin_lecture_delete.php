<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $lect_key_array = $_POST['lect_key'];

    foreach($lect_key_array as $lect_key){
        
        $sqlThumb = "UPDATE lms_lecture L join lms_pic P on L.pic_link = P.pic_key
            SET pic_deldate = now(), pic_status = 0
            where L.lect_key=".$lect_key;

        $resultPic = $mysqli->query($sqlThumb) or die("query error=>".$mysqli_error);
        
        $sqlPic = "SELECT * from lms_lecture le 
            join lms_pic pi on le.pic_link = pi.pic_key
            where le.lect_key=".$lect_key;

        $resultP = $mysqli->query($sqlPic) or die("query error=>".$mysqli_error);
        $p = $resultP -> fetch_object();
        $filename = $p->pic_name;
        $picName = $_SERVER['DOCUMENT_ROOT']."/kdt_lms/lectThumb/".$filename;
        
        unlink($picName);
        // $_SERVER['DOCUMENT_ROOT'].
        $sql = "DELETE from lms_lecture where lect_key=".$lect_key;
        $result = $mysqli->query($sql) or die("query error=>".$mysqli_error);


        if($result){
            $data = array('result' => "ok");
        }else{
            $data = array('result' => "fail");
            break;
        }
    }
    echo json_encode($data);
?>