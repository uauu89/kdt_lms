<?php
    if($user_create_conn_check){
        $user_create_conn_check = false;
        $sql = "INSERT INTO lms_info_user (user_id, user_pw, user_name, user_email, user_regdate)  
        VALUES ('$user_id', '$user_pw', '$user_name', '$user_email', '".date('Y-m-d')."')";
    
        if($mysqli -> query($sql) === true){
            echo "<script>
                alert('가입되었습니다.');
                location.href = '/kdt_lms/user_login.php';
                </script>";
        }else{
            echo "<script>
                    alert('가입에 실패했습니다.\\n관리자에게 문의 바랍니다.');
                    location.href = '/kdt_lms/user_login_create.php';
                </script>";
        };
    }else{
        echo "<script>
                alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
                location.href='/kdt_lms/index.php';
            </script>";
    }
?>