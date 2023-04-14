
<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();

    if($_POST["conn_check"]){
        $idx = $_SESSION['SSIDX'];
        $user_id = $_SESSION['SSID'];
    
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
    
        if(empty($_POST['user_pw'])){
            $user_pw;
            $user_pw_check;
        }else{
            $user_pw = hash('sha512', $_POST['user_pw']);
            $user_pw_check = hash('sha512', $_POST['user_pw_check']);
        }
    
        
        if(
            empty($user_name) &&
            empty($user_email) &&
            empty($user_pw)
        ){
            echo "<script>alert('최소 한가지 항목을 입력해주세요.');history.back();</script>";
        }
    
        if(!empty($user_name)){
            if(mb_strlen($user_name) < 7){
                $updateState.=", user_name='$user_name'";
            }else{
                echo "<script>alert('입력된 정보가 잘못되었습니다.');history.back();</script>";
            }
        }
    
        if(!empty($user_email)){
            if(mb_strlen($user_email) < 51){
                $updateState.=", user_email='$user_email'";
            }else{
                echo "<script>alert('입력된 정보가 잘못되었습니다.');history.back();</script>";
            }
        }
    
        
        if(!empty($user_pw)){
            if($user_pw == $user_pw_check && mb_strlen($user_pw) < 256){
                $updateState.=", user_pw='$user_pw'";
            }else{
                echo "<script>alert('입력된 정보가 잘못되었습니다.');history.back();</script>";
            }
        }
        $updateState = mb_substr($updateState, 2);
        
        $sql_modify = "UPDATE lms_info_user SET $updateState WHERE idx = '$idx' and user_id='$user_id'";
        
        
        $result = $mysqli -> query($sql_modify) or die("query error=>".$mysqli->error);

        if($result){
            $sql_newname = "SELECT user_name FROM lms_info_user where idx='$idx'";
            $newname = $mysqli -> query($sql_newname) or die("query error=>".$mysqli->error);
            $n = $newname -> fetch_object();
            
            $_SESSION['SSNAME'] = $n->user_name;
            $_SESSION['MODIFY'] = "false";
            echo "<script>
                alert('회원정보 수정에 성공하였습니다.');
                location.href='/kdt_lms/user_my_class.php';
            </script>";
        }else{
            echo "<script>
            alert('회원정보 수정에 실패하였습니다.');
            history.back();
        </script>";
        }


    }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }

?>

