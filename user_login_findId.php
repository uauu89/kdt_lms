<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>아이디 찾기</title>
</head>
<body>
    <form action="/kdt_lms/user_login_findId_result.php" method="POST" class="formBg d-flex flex-column">
        <header>
            <h1 class="logo d-flex justify-content-center">
                <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
            </h1>
            <h2>아이디 찾기</h2>
            <p>가입 시 입력하신 이름과 이메일 주소를 입력해주세요.</p>
        </header>
        <div class="inputGroup">
            <div>
                <label for="user_name" class="d-flex justify-content-between">이름 <small class="inputTip">최대 7글자의 한글, 영어, 숫자만 가능합니다.</small></label>
                <input type="text" id="user_name" name="user_name" maxlength="7" class="form-control inputStyle" required>
                <div></div>
            </div>
            <div>
                <label for="user_email" class="d-flex justify-content-between">이메일 주소 <small class="inputTip">이메일 주소 형식을 지켜주세요.</small></label>
                <input type="email" id="user_email" name="user_email" class="form-control inputStyle" required>
                <div></div>
            </div>
        </div>
        <button class="btn btn_custom btn_large btn_accent w-100 btn_submit" disabled>아이디 찾기</button>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login.php">로그인 하기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findPw.php">비밀번호 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php" class="">회원가입</a></li>
        </ul>
    </form>
    <script src="/kdt_lms/js/user_login.js"></script>
    <script>
        inputClear();
        validation_name();
        validation_mail();
        submit_check();
    </script>
</body>
</html>