<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/common.css">
    <link rel="stylesheet" href="/kdt_lms/css/admin_login.css">
    <title>NOW</title>
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle w-75 d-flex flex-column align-items-center py-5 __shadow bg-light rounded">
        <h1 class="d-flex align-items-center justify-content-center gap-3">
            <img src="/kdt_lms/img/logo.svg" alt="now">
            <span>now!</span>
        </h1>
        <h2>임시 페이지입니다.</h2>
        <div class="d-flex w-100 px-5">
            <div class="border w-100">
                <p>구현된 페이지 : </p>
                <ul class="d-flex flex-column gap-3">
                    <li>관리자 로그인</li>
                    <li>강의 목록 페이지</li>
                    <li>강의 상세보기 페이지</li>
                    <li>강의 등록 페이지</li>
                    <li>강의 수정 / 일괄 수정 페이지</li>
                    <li>강의 일괄수정 페이지</li>
                    <li>강의 삭제 페이지</li>
                </ul>
            </div>
            <div class="border w-100">
                <p>구현된 기능</p>
                <ul class="d-flex flex-column gap-3">
                    <li>로그인 기능 / 세션 체크</li>
                    <li>강의 목록 출력 / 페이지네이션</li>
                    <li>등록 강의 검색</li>
                    <li>강의 신규 등록</li>
                    <li>
                        <p>강의 수정 / 일괄 수정</p>
                        <p> - 두 개 이상의 강의 체크 후 목록 상단의 수정버튼 클릭</p>
                    </li>
                    <li>
                        <p>강의 삭제 / 일괄 삭제</p>
                        <p> - 두 개 이상의 강의 체크 후 목록 상단의 삭제버튼 클릭</p>
                    </li>
                </ul>
            </div>
        </div>
        <a href="/kdt_lms/admin/admin_login.php" class="btn btn-dark w-75 f_mainTitle mt-3">관리자 로그인 페이지로 이동</a>
        <div class="d-flex mt-3 w-50 justify-content-around">
            <a href="/kdt_lms/admin/admin_lecture_list.php" class="btn btn-dark ">세션 테스트용 링크 : 강의목록</a>
            <a href="/kdt_lms/admin/admin_lecture_reg.php" class="btn btn-dark ">세션 테스트용 링크 : 강의등록</a>
        </div>
    </div>
</body>
</html>
