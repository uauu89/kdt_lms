<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
    session_start();
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>비밀번호 찾기</title>
</head>
<body>
    <form action="/kdt_lms/user_login_findPw_result.php" method="POST" class="formBg d-flex flex-column">
    
        <header>
            <h1 class="logo d-flex justify-content-center">
               <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
                <h2>비밀번호 찾기</h2>
                <p>
                    가입 시 입력하신 아이디와 이름, 이메일 주소를 입력해주세요.<br>
                    회원정보가 일치하면 비밀번호를 재설정하실 수 있습니다.
                </p>
            </h1>
        </header>
        <div class="inputGroup">
            <div>
                <label for="user_id" class="d-flex justify-content-between">아이디 <small class="inputTip">최대 20글자의 영어, 숫자만 가능합니다.</small></label>
                <input type="text" id="user_id" name="user_id" maxlength="20" class="form-control inputStyle" required>
                <div></div>
            </div>
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
        <button type="button" class="btn btn_custom btn_large btn_accent w-100 btn_submit" onclick="findPw_check()" disabled>정보 조회하기</button>
        
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login.php">로그인 하기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php">회원가입</a></li>
        </ul>

    </form>
    <script src="/kdt_lms/js/user_login.js"></script>
    <script>
        inputClear();
        validation_id_find();
        validation_name();
        validation_mail();
        submit_check();
    </script>
</body>
</html>