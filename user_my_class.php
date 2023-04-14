<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";

$sql_myclass = "SELECT 
    lect.lect_key, lect.lect_name, lect.lect_expdate, pic.pic_name, prim.cate_prim_name, sec.cate_sec_name
    from lms_myclass my
    join lms_lecture lect on my.myclass_lect = lect.lect_key
    join lms_pic pic on lect.pic_link = pic.pic_key
    join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
    join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
    where my.myclass_user=".$_SESSION['SSIDX'];

    $myclass = $mysqli -> query($sql_myclass) or die("query error=>".$mysqli->error);
    while($m = $myclass -> fetch_object()){$mArray[]=$m;}
?>

    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my.css">

    <title>내 강의실</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <div class="inner_large d-flex">
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_my_aside.php"; ?>
        <main class="flex-grow-1">
            <div class="header">
                <h2>내 강의실</h2>
            </div>
            <div class="d-flex">
                <table class="flex-grow-1">
                    <thead>
                        <tr>
                            <th>
                            </th>
                            <th class="td_button">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(isset($mArray)){
                            foreach($mArray as $r){ ?>
                        <tr id="tr<?php echo $r->lect_key; ?>">
                            <td class="td_lecture w-100">
                                <figure class="lectureStyle list_lecture d-flex gap-4 px-4">
                                    <div class="imgSection flex-shrink-0">
                                        <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name?>" alt="">
                                    </div>
                                    <figcaption class="df gap-3 flex-grow-1">
                                        <h3><a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $r->lect_key; ?>" title="수강 페이지로 이동"><?php echo $r->lect_name?></a></h3>
                                        <p class="category">
                                            <span><?php echo $r->cate_prim_name; ?></span>
                                            <span><?php echo $r->cate_sec_name; ?></span>
                                        </p>
                                        <p class="date"><?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?></p>
                                    </figcaption>
                                </figure>
                            </td>
                            <td>
                                <div class="td_button">
                                    <button class="my_btn" onclick="myclassDel(<?php echo $r->lect_key; ?>)"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php }}else{
                            echo "<tr><td colspan=2 class='text-center'>수강중인 강의가 없습니다.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
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
