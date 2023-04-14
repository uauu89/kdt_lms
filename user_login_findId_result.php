<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_norequire.php";
?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_login.css">

    <title>아이디 찾기</title>
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
            <h2>아이디 조회 결과</h2>
            <p>입력하신 정보로 조회한 결과입니다.</p>
        </header>
        <ul class="findId_result d-flex flex-column gap-4">
        <?php 
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];

            $sql_findId = "SELECT user_id FROM lms_info_user WHERE user_name='$user_name' and user_email='$user_email'";
            $findId = $mysqli -> query($sql_findId) or die("query error=>".$mysqli->error);

            while($find = $findId -> fetch_object()){
                $fArray[]=$find;
            }
            
            if(isset($fArray)){
                foreach($fArray as $f){
                    
                    $id = str_replace($f->user_id,mb_substr($f->user_id, 0, 3)."****",$f->user_id);
                ?>
        

            <li><?php echo $id; ?></li>
            
            <?php }}else{
                echo "<li class='noresult'>조회 결과가 없습니다.</li>";
            }?>
        </ul>
        
        <a href="/kdt_lms/user_login_findId.php" class="btn btn_custom btn_large btn_accent w-100">로그인 페이지로 이동</a>
        <ul class="d-flex justify-content-center">
            <li class="divisionLine"><a href="/kdt_lms/user_login_findId.php">아이디 찾기</a></li>
            <li class="divisionLine"><a href="/kdt_lms/user_login_findPw.php">비밀번호 찾기</a></li>
            <li><a href="/kdt_lms/user_login_create.php" class="">회원가입</a></li>
        </ul>
    </section>
</body>
</html>