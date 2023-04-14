<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>회원가입</title>
</head>
<body>
    <form action="/kdt_lms/inc/user_login_create_insert_check.php" method ="POST" class="formBg d-flex flex-column">
        <header>
            <h1 class="logo d-flex justify-content-center">
                <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
            </h1>
            <h2 class="mt-3">회원가입</h2>
            <p>회원정보를 정확하게 입력해주세요</p>
        </header>
        <div class="inputGroup">
            <div>
                <label for="user_id" class="d-flex justify-content-between">아이디 <small class="inputTip">최대 20글자의 영어, 숫자만 가능합니다.</small></label>
                <div class="input-group">
                    <div class="customInputGroup">
                        <input type="text" id="user_id" name="user_id" maxlength="20" class="form-control inputStyle" required>
                        <div></div>
                    </div>
                    <button type="button" class="btn btn_custom idcheck">중복검사</button>
                </div>
            </div>
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


        <button class="btn btn_custom btn_large btn_accent w-100 btn_submit" disabled>회원가입</button>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login.php">로그인 하기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li><a href="/kdt_lms/user_login_findPw.php">비밀번호 찾기</a></li>
        </ul>
    </form>
    <script src="/kdt_lms/js/user_login.js"></script>
    <script>
        inputClear();
        validation_id_create();
        validation_pw();
        validation_name();
        validation_mail();
        submit_check();
    </script>
</body>
</html>