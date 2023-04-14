<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my.css">
    <!-- <link rel="stylesheet" href="/kdt_lms/css/user_login.css"> -->
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

            <form action="/kdt_lms/inc/user_my_modify_conn_check.php" method="POST" class="formBg d-flex flex-column">
                <header>
                    <h2>비밀번호 입력</h2>
                    <p>회원정보를 수정하기 위해 비밀번호를 다시 한 번 입력해주세요.</p>
                </header>

                <div class="inputGroup">
                    
                    <div>
                        <label for="user_pw">비밀번호</label>
                        <input type="password" id="user_pw" name="user_pw" class="form-control inputStyle" required>
                        <div></div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn_custom btn_large btn_accent w-100">확인</button>
                </div>
                
            </form>
        </main>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>
    
    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script>
        check_myCurrentPage();
    </script>
</body>
</html>