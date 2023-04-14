<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();
    

    $user_id = $_POST["user_id"];
    $user_pw = hash("sha512", $_POST["user_pw"]);

    $sql = "SELECT * from lms_info_user where user_id = '{$user_id}' and user_pw = '{$user_pw}'";
    
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);

    $i = $result -> fetch_object();

    if($i){
        
        $_SESSION['SSIDX'] = $i -> idx;
        $_SESSION['SSID'] = $i ->user_id;
        $_SESSION['SSNAME'] = $i -> user_name;
        $_SESSION['SSTIME'] = date("Y-m-d H:i:s");
        $_SESSION['SSIP'] = rand(1000, 9999);


        if($i->user_connstatus == 0){
            // session_id();
            $sql_lastLogin = "UPDATE lms_info_user SET 
                user_connstatus=1,
                user_lastconn_date='".$_SESSION['SSTIME']."',
                user_lastconn_ip='".$_SESSION['SSIP']."'
                WHERE idx =".$_SESSION['SSIDX'];

            if($mysqli -> query($sql_lastLogin) === true){
                echo "<script>
                    alert('".$i -> user_name."님 어서오세요');
                    location.href='/kdt_lms/user_my_class.php';
                </script>";
            }else{
                echo "<script>
                    alert('로그인에 실패했습니다. 관리자에게 문의해주세요.');
                </script>";
            }

            

        }else{
        ?>
            <script>
                let data_idx = <?php echo $_SESSION['SSIDX']; ?>,
                    data_ip = <?php echo $_SESSION['SSIP']; ?>;
                if(confirm('현재 회원님의 계정이 다른 곳에서 접속되어있습니다.\n 마지막으로 로그인 한 시간 : <?php echo $i->user_lastconn_date ;?> \n 마지막으로 로그인 한 장소 : <?php echo $i->user_lastconn_ip; ?> \n 현재 로그인 한 장소 : <?php echo $_SESSION['SSIP']; ?>\n 접속중인 계정을 종료하시겠습니까?')){
                    $.ajax({
                        async: false,
                        type: "POST",
                        data: {idx : data_idx, ip :data_ip},
                        url: "/kdt_lms/inc/user_login_check_reconnect.php",
                        dataType: "json",
                        success: function(result){
                            if(result){
                                <?php session_destroy(); ?>
                                alert("계정이 로그아웃되었습니다. 다시 로그인해주세요.");
                                location.href='/kdt_lms/index.php';
                            }else{
                                alert("계정 로그아웃에 실패했습니다. 관리자에게 문의해주세요.");
                                location.href='/kdt_lms/index.php';
                            }
                        }
                    })
                }
            </script>
    <?php }
        
    }else{
        echo "<script>
                alert('아이디 또는 비밀번호가 일치하지 않습니다');
                history.back();
            </script>;";
    }
?>

