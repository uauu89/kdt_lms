<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
    session_start();
    
    $checkCode = $_POST["checkcode"];

    if(empty($checkCode)){
        echo "<script>
        alert('잘못된 경로로 접근하셨습니다.');
        history.back();</script>";
    }else if($checkCode != $_SESSION['CODE']){
        echo "<script>
        alert('본인인증에 실패하였습니다.');
        history.back();</script>";
    }

?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>비밀번호 재발급</title>
</head>
<body>
    <form action="/kdt_lms/inc/user_login_findPw_done.php" method="POST" class="formBg d-flex flex-column">
        <input type="hidden" name="user_id" value="<?php echo $_POST["user_id"];?>">
        <input type="hidden" name="user_name" value="<?php echo $_POST["user_name"];?>">
        <input type="hidden" name="user_email" value="<?php echo $_POST["user_email"];?>">
        <header>
            <h1 class="logo d-flex justify-content-center">
               <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
                <h2>비밀번호 재발급</h2>
                <p>
                    비밀번호를 재발급합니다.
                </p>
            </h1>
        </header>
        <div class="inputGroup">
        <div>
            <label for="user_pw" class="d-flex justify-content-between">비밀번호 <small class="inputTip">대소문자를 구별합니다.</small></label>
            <input type="password" id="user_pw" name="user_pw" class="form-control inputStyle" required>
            <div></div>
        </div>
        <div>
            <label for="user_pw_check" class="d-flex justify-content-between">비밀번호 확인 <small class="inputTip">비밀번호를 동일하게 입력해주세요.</small></label>
            <input type="password" id="user_pw_check" name="user_pw_check" class="form-control inputStyle" required>
            <div></div>
        </div>
        </div>
        <input type="hidden" name="conn_check" value="true">
        <button class="btn btn_custom btn_large btn_accent w-100 btn_submit" disabled>비밀번호 재발급</button>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login.php">로그인 하기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php">회원가입</a></li>
        </ul>

    </form>
    <script src="/kdt_lms/js/user_login.js"></script>
    <script>
        validation_pw();
        submit_check();
    </script>
</body>
</html>