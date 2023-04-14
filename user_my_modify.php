<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";

    session_start();

    if($_SESSION['MODIFY']){
        $_SESSION['MODIFY'] = false;
    }else{
        echo "<script>
        alert('잘못된 경로로 접근하셨습니다.');
        location.href='/kdt_lms/index.php';
    </script>";
    }
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my_modify.css">

    <title>회원정보 수정</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <div class="inner_large d-flex">
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_my_aside.php"; ?>
        <main>
            <div class="header">
                <h2>회원정보 수정</h2>
            </div>

            <form action="/kdt_lms/inc/user_my_modify_ok.php" method="POST" class="formBg d-flex flex-column">

                <div class="inputGroup">
                    
                    <div>
                    <label for="user_name" class="d-flex justify-content-between">이름 <small class="inputTip">최대 7글자의 한글, 영어, 숫자만 가능합니다.</small></label>
                        <input type="text" id="user_name" name="user_name" class="form-control inputStyle">
                        <div></div>
                    </div>
                    <div>
                    <label for="user_email" class="d-flex justify-content-between">이메일 주소 <small class="inputTip">이메일 주소 형식을 지켜주세요.</small></label>
                        <input type="email" id="user_email" name="user_email" class="form-control inputStyle">
                        <div></div>
                    </div>
                    <div>
                    <label for="user_pw" class="d-flex justify-content-between">비밀번호 <small class="inputTip">대소문자를 구별합니다.</small></label>
                        <input type="password" id="user_pw" name="user_pw" class="form-control inputStyle">
                        <div></div>
                    </div>
                    <div>
                    <label for="user_pw_check" class="d-flex justify-content-between">비밀번호 확인 <small class="inputTip">비밀번호를 동일하게 입력해주세요.</small></label>
                        <input type="password" id="user_pw_check" name="user_pw_check" class="form-control inputStyle">
                        <div></div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="hidden" name="conn_check" value="true">
                    <button class="btn btn_custom btn_large btn_accent w-100">수정완료</button>
                    <button type='button' class="btn_quit" onclick="modalQuit()">회원 탈퇴</a>
                </div>
            </form>

        </main>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>

    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script>
        document.querySelector("aside nav a[href='user_my_modify_conn.php']").classList.add("active");
    </script>
</body>
</html>