<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();

    $conn_check = $_POST["conn_check"];

    if($conn_check){
        $conn_check = false;

        $user_id = $_POST["user_id"];
        $user_name = $_POST["user_name"];
        $user_email = $_POST["user_email"];
        
    
        $user_pw = hash("sha512", $_POST["user_pw"]);
        $user_pw_check = hash("sha512", $_POST["user_pw_check"]);
    
        if($user_pw == $user_pw_check){
            $sql_pw = "UPDATE lms_info_user SET user_pw='$user_pw' 
                WHERE user_id='$user_id' and user_name='$user_name' and user_email='$user_email'";
            $result = $mysqli -> query($sql_pw) or die("query error=>".$mysqli->error);
            if($result){
                echo "<script>
                alert('비밀번호를 변경하였습니다.');
                location.href='/kdt_lms/user_login.php';
                </script>";
                
            }else{
                echo "<script>
                alert('비밀번호 변경에 실패하였습니다.');
                history.back();
                </script>";
            }
        }else{
            echo "<script>
            alert('잘못된 정보를 입력하셨습니다.');
            history.back();</script>";
        }

    }else{
        echo "<script>
                alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
                location.href='/kdt_lms/index.php';
            </script>";
    }

?>

