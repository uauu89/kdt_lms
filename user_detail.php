<?php 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php";
    $idx = $_GET['no'];

    $sql_view = "UPDATE lms_lecture SET lect_view = lect_view + 1 WHERE lect_key=$idx";
    
    $view = $mysqli ->query($sql_view);

    $sql_detail = "SELECT * FROM lms_lecture lect 
                    join lms_pic pic on lect.pic_link = pic.pic_key
                    join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
                    join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
                    where lect.lect_key=".$idx;


    $detail = $mysqli->query($sql_detail) or die("query error=>".$mysqli->error);

    $r = $detail->fetch_object();


    // 최근 본 상품 세팅
        $j=0; // 쿠키에 상품 정보를 등록할 때 사용할 인덱스 번호 

        if($_COOKIE['recently_products']){//쿠키에 값이 있으면 시작
            $prs = json_decode($_COOKIE['recently_products']);//쿠키의 JSON값을 배열로 변경
            if(!in_array($r->lect_key, $prs)){//새로 등록할 상품이 기존 배열에 없으면 등록
                if(sizeof($prs)>=5){//배열에 3개만 등록할거니까 3개가 넘으면 하나를 삭제
                    unset($prs[0]);
                }
                ksort($prs);//키값을 기준으로 오름차순(알파벳순)정렬
                foreach($prs as $ps){//쿠키에 있는 값들을 가져와서 다시 담는다.
                    $cvalarray[$j] = $ps; //쿠기에 있는 값을 cvalarry 배열에 다시 할당
                    $j++;
                }

                $cvalarray[$j] = $r->lect_key;//배열에 마지막에 현재 상품을 배열에 담는다.
                $cval = json_encode($cvalarray);//json으로 바꾼다.
                setcookie("recently_products",$cval,time()+86400);//쿠키에 값을 담는다.
                //86400초는 24시간
            }
        }else{
            $cvalarray[$j] = $r->lect_key;//쿠키에 최근 본 상품이 없으면 담는다.
            $cval = json_encode($cvalarray); //문자열 형태로 인코딩
            setcookie("recently_products",$cval,time()+86400);
        }
?>


<link rel="stylesheet" href="/kdt_lms/css/user_common.css">
<link rel="stylesheet" href="/kdt_lms/css/user_index.css">

<title>상세보기</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <main class="inner_medium section_detail">
        <figure class="lectureStyle detail_lecture">
            <div class="imgSection">
                <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name; ?>" alt="">
            </div>
            <figcaption class="d-flex flex-column gap-3">
                <div class="d-flex flex-column gap-3">
                    <div class="tag">
                    <?php 
                        if($r->lect_price == 0) echo "<span class='free'></span>";
                        if(empty($r->lect_expdate)) echo "<span class='always'></span>";
                        if($r->lect_opt_prem) echo "<span class='prem'></span>";
                        if($r->lect_opt_repre) echo "<span class='repre'></span>";
                        if($r->lect_opt_begin) echo "<span class='begin'></span>";
                    ?>
                    </div>
                    <h3><?php echo $r->lect_name; ?></h3>
                    <p class="category">
                        <span><?php echo $r->cate_prim_name; ?></span>
                        <span><?php echo $r->cate_sec_name; ?></span>
                    </p>
                </div>
                <div class="info d-flex flex-column gap-3 align-items-end">
                    <p><?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?></p>
                    <p class="price"><?php echo $r->lect_price == 0? "무료강의": number_format($r->lect_price)." 원"; ?></p>
                </div>
            </figcaption>
        </figure>
        <div class="buttons d-flex gap-4">
            <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                <input type="hidden" name="items" value="<?php echo $r->lect_key; ?>">
                <button class="btn_payment_one">결제하기</button>
            </form>
            <button type="button" class="btn btn_cart" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$r->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i><span>장바구니</span></a>
            
        </div>
        <section class="section_detail_desc">
            <h2 class="__hidden">강의 내용 설명</h2>
            <?php echo $r->lect_desc; ?>
        </section>
    </main>


    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>
    
    <script src="/kdt_lms/js/user_remote.js"></script>

    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_index.js"></script>
    
   

</body>
</html>
''