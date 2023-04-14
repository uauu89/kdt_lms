<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();


    $idx = $_GET["no"];
    $sql_takeClass = "SELECT 
        lect.lect_key, lect.lect_name, lect.lect_video, lect.lect_desc, prim.cate_prim_name, sec.cate_sec_name
        from lms_myclass my
        join lms_lecture lect on my.myclass_lect = lect.lect_key
        join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
        join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
        where my.myclass_lect=$idx && my.myclass_user=".$_SESSION["SSIDX"];

    $takeClass = $mysqli -> query($sql_takeClass) or die("query error=>".$mysqli->error);
    $r = $takeClass -> fetch_object();
?>

    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_index.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_takeClass.css">

    <title>수강하기</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_remote.php"; ?>
    <header class="d-flex">
        <h2><?php echo $r->lect_name; ?></h2>
        <a href="/kdt_lms/user_my_class.php" class="btn_small __shadow"><i class="fa-solid fa-arrow-left"></i>강의실로 돌아가기</a>
    </header>
    
    <main class="section_takeClass inner_large">
            <section class=iframeWrap>
                <h3 class="__hidden">강의 영상</h3>
                <div class="iframeInner">
                    <iframe src="https://www.youtube.com/embed/<?php echo $r->lect_video; ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </section>
            <section class="desc">
                <h3 class="sectionTitle">강의 설명</h3>
                <p>
                    <?php echo !empty(trim($r->lect_desc)) ? $r->lect_desc: "등록된 설명이 없습니다."; ?>
                </p>
            </section>
    </main>

    <script src="/kdt_lms/js/user_remote.js"></script>

</body>
</html>
