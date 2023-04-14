
<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();
    
    $user_idx = $_SESSION['SSIDX'];
    $user_id = $_SESSION['SSID'];

    $quitCheck = $_POST['quitCheck'];

    if($quitCheck==="회원탈퇴"){

        $sql_delete = "DELETE i.*, class.*, cart.* FROM lms_info_user i
            join lms_myclass class on i.idx = class.myclass_user
            join lms_cart cart on i.idx = cart.cart_user_link
            where i.idx='$user_idx' and i.user_id='$user_id'";
        $delete = $mysqli -> query($sql_delete) or die("query error=>".$mysqli->error);

        if($delete){
            session_destroy();
            echo "<script>
                alert('회원정보가 삭제되었습니다.');
                location.href='/kdt_lms/index.php';
            </script>";
        }else{
            echo "<script>
                alert('회원 탈퇴에 실패하였습니다.');
                history.back();
            </script>";
        }
    }else{
        echo "<script>
            alert('확인문자가 정확하게 입력되지 않았습니다.');
            history.back();
            </script>";
            
    }


?>

