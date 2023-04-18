<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>로그인</title>
</head>
<body>
    <form action="/kdt_lms/inc/user_login_check.php" method="post" class="formBg d-flex flex-column">
        <header>
            <h1 class="logo d-flex justify-content-center">
                <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
            </h1>
        </header>
        <div class="inputGroup">
            <div>
                <label for="user_id">아이디</label>
                <input type="text" id="user_id" name="user_id" class="form-control inputStyle" required placeholder="시연 아이디 : user">
                <div></div>
            </div>
            <div>
                <label for="user_pw">비밀번호</label>
                <input type="password" id="user_pw" name="user_pw" class="form-control inputStyle" required placeholder="시연 비밀번호 : 1111">
                <div></div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn_custom btn_large btn_accent w-100">로그인</button>
            <a href="/kdt_lms/admin/admin_login.php" class="btn admin_link">관리자 로그인 페이지로 이동</a>
        </div>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findPw.php">비밀번호 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php">회원가입</a></li>
        </ul>
        
    </form>
</body>
</html>