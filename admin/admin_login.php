<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
    session_start();

    $time = $_SESSION['SSTIME'];
    if(isset($_SESSION['SSNAME'])){
        echo "<script>
                alert('이미 로그인하셨습니다.\\n 로그인 시간 : $time'); 
                location.href='admin_lecture_list.php';
            </script>";
    };
?>
    <link rel="stylesheet" href="/kdt_lms/css/common.css">
    <link rel="stylesheet" href="/kdt_lms/css/admin_login.css">
    <title>관리자 로그인 - NOW</title>
</head>
<body>
    <form action="admin_login_check.php" method="post" class="position-absolute top-50 start-50 translate-middle w-75 d-flex flex-column align-items-center py-5 __shadow">
        <h1 class="d-flex align-items-center justify-content-center gap-3">
            <img src="/kdt_lms/img/logo.svg" alt="now">
            <span>now!</span>
        </h1>
        <div class="my-3 w-75 __textupper">
            <label for="admin_id" class="form-label">id</label>
            <input type="text" id="admin_id" name="admin_id" class="form-control" placeholder="시연 아이디 : admin">
        </div>
        <div class="mb-5 w-75 __textupper">
            <label for="admin_pw" class="form-label">password</label>
            <input type="password" id="admin_pw" name="admin_pw" class="form-control" placeholder="시연 비밀번호 : 1111">
        </div>
        <button type="submit" class="btn btn-dark __textupper w-75 f_mainTitle">log in</button>
    </form>
</body>
</html>
