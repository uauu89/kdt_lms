<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>비밀번호 찾기</title>
</head>
<body>
    <section class="formBg d-flex flex-column">
        <header>
            <h1 class="logo d-flex justify-content-center">
                <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span>now!</span>
                </a>
            </h1>
            <h2>비밀번호 조회 결과</h2>
            <p>입력하신 정보로 조회된 결과가 없습니다.</p>
        </header>
                
        <a href="/kdt_lms/user_login_findPw.php" class="btn btn_custom btn_large btn_accent w-100">이전 페이지로 돌아가기</a>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findPw.php">비밀번호 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php" class="">회원가입</a></li>
        </ul>
    </section>
</body>
</html>