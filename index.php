<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<link rel="stylesheet" href="/kdt_lms/css/user_common.css">
<link rel="stylesheet" href="/kdt_lms/css/user_index.css">


<title>now!</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>




    <div class="swiper swiper_banner" id="pageTop" >
        <div class="swiper-wrapper">
        <?php 
            $sql_banner = "SELECT * FROM lms_banner_main where option_show=1";
            $banner = $mysqli -> query($sql_banner)or die("query error=>".$mysqli->error);

            while($bResult = $banner -> fetch_object()){
                $bArray[]=$bResult;
            }
            if(isset($bArray)){
                foreach($bArray as $b){?>

            <section class="banner_main_wrap swiper-slide">
                <h2 class="__hidden">프로모션</h2>
                <div class="banner_bg">
                    <img src="/kdt_lms/bannerImg/<?php echo $b->imgsrc; ?>" alt="">
                    <div class="banner_desc_wrap">
                        <p><?php echo $b->text1; ?></p>
                        <p><?php echo $b->text2; ?></p>
                    </div>
                </div>
            </section>



        <?php }
            }
        ?>
        </div>
    </div>

    <main class="inner_medium">

        <section>
            <h2 class="sectionTitle">프리미엄</h2>
            <div class="swiper_container">
                <div class="swiper swiper_premium">
                    <div class="swiper-wrapper">
                    <?php
                        $sql_premium = "SELECT lec.*, pic.pic_name, pri.cate_prim_name, sec.cate_sec_name FROM lms_lecture lec
                            join lms_cate_primary pri on lec.lect_cate_pri = pri.cate_prim_key
                            join lms_cate_secondary sec on lec.lect_cate_sec = sec.cate_sec_key
                            join lms_pic pic on lec.pic_link = pic.pic_key
                            where lec.lect_opt_prem=1 order by lec.lect_regdate desc limit 0, 12";
                        $premium = $mysqli -> query($sql_premium) or die("query error=>".$mysqli->error);
                        while($pResult = $premium -> fetch_object()){
                            $pArray[]=$pResult;
                        }
                        if(isset($pArray)){
                            foreach($pArray as $p){?>
                        <div class="swiper-slide">
                            <figure class="lectureStyle item_lecture medium">
                                <div class="imgSection">
                                    <img src="/kdt_lms/lectThumb/<?php echo $p->pic_name; ?>" alt=''>
                                    <div class="buttons">
                        <?php 
                            $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$p->lect_key'";
                            $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);

                            $h = $haveclass -> fetch_object();

                        
                            if($h){?>
                                <a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $p->lect_key; ?>" class="btn_payment_one">강의 시청하기</a>        
                            <?php }else{ ?>
                                <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                                    <input type="hidden" name="items" value="<?php echo $p->lect_key; ?>">
                                    <button class="btn_payment_one">결제하기</button>
                                </form>
                                <button type="button" class="btn_cart_one" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$p->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i></button>
                            <?php } ?>
                    </div>
                                </div>
                                <figcaption>
                                    <div class="df">
                                        <div class="tag">
                                        <?php 
                                            if($p->lect_price == 0) echo "<span class='free'></span>";
                                            if(empty($p->lect_expdate)) echo "<span class='always'></span>";
                                            if($p->lect_opt_prem) echo "<span class='prem'></span>";
                                            if($p->lect_opt_repre) echo "<span class='repre'></span>";
                                            if($p->lect_opt_begin) echo "<span class='begin'></span>";
                                        ?>
                                        </div>
                                        <h3><a href="user_detail.php?no=<?php echo $p->lect_key?>"><?php echo $p->lect_name; ?></a></h3>
                                        <p class="category">
                                           <span><?php echo $p->cate_prim_name; ?></span>
                                           <span><?php echo $p->cate_sec_name; ?></span>
                                        </p>
                                    </div>
                                    <div class="df info">
                                        <p class="date">
                                            <?php echo empty($p->lect_expdate)? "상시공개": $p->lect_expdate." 까지";?>
                                        </p>
                                        <p class="price">
                                            <?php echo $p->lect_price == 0? "무료강의": number_format($p->lect_price)." 원"; ?>
                                        </p>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <div class="swiper-pagination swiper-pagination_premium"></div>
                <button type="button" class="btn_slideNavi btn_slideNavi_premium slidePrev"></button>
                <button type="button" class="btn_slideNavi btn_slideNavi_premium slideNext"></button>
            </div>
        </section>

        <section>
            <h2 class="sectionTitle">최고 인기강의</h2>
            <div class="swiper_container">
                <div class="swiper swiper_best">
                    <div class="swiper-wrapper">
                    <?php
                        $sql_repre = "SELECT lec.*, pic.pic_name, pri.cate_prim_name, sec.cate_sec_name FROM lms_lecture lec
                            join lms_cate_primary pri on lec.lect_cate_pri = pri.cate_prim_key
                            join lms_cate_secondary sec on lec.lect_cate_sec = sec.cate_sec_key
                            join lms_pic pic on lec.pic_link = pic.pic_key
                            where lec.lect_opt_repre=1 order by lec.lect_regdate desc limit 0, 12";
                        $repre = $mysqli -> query($sql_repre) or die("query error=>".$mysqli->error);
                        while($rResult = $repre -> fetch_object()){
                            $rArray[]=$rResult;
                        }
                        if(isset($rArray)){
                            foreach($rArray as $r){?>
                        <div class="swiper-slide">
                            <figure class="lectureStyle item_lecture medium">
                                <div class="imgSection">
                                    <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name; ?>" alt=''>
                                    <div class="buttons">
                        <?php 
                            $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$r->lect_key'";
                            $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);
                            
                            $h = $haveclass -> fetch_object();
                            
                            if($h){?>
                                <a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $r->lect_key; ?>" class="btn_payment_one">강의 시청하기</a>        
                            <?php }else{ ?>
                                <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                                    <input type="hidden" name="items" value="<?php echo $r->lect_key; ?>">
                                    <button class="btn_payment_one">결제하기</button>
                                </form>
                                <button type="button" class="btn_cart_one" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$r->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i></button>
                            <?php } ?>
                    </div>
                            </div>
                                <figcaption>
                                    <div class="df">
                                        <div class="tag">
                                        <?php 
                                            if($r->lect_price == 0) echo "<span class='free'></span>";
                                            if(empty($r->lect_expdate)) echo "<span class='always'></span>";
                                            if($r->lect_opt_prem) echo "<span class='prem'></span>";
                                            if($r->lect_opt_repre) echo "<span class='repre'></span>";
                                            if($r->lect_opt_begin) echo "<span class='begin'></span>";
                                        ?>
                                        </div>
                                        <h3><a href="user_detail.php?no=<?php echo $r->lect_key?>"><?php echo $r->lect_name; ?></a></h3>
                                        <p class="category">
                                            <span><?php echo $r->cate_prim_name; ?></span>
                                            <span><?php echo $r->cate_sec_name; ?></span>
                                        </p>
                                    </div>
                                    <div class="df info">
                                        <p class="date">
                                            <?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?>
                                        </p>
                                        <p class="price">
                                            <?php echo $r->lect_price == 0? "무료강의": number_format($r->lect_price)." 원"; ?>
                                        </p>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <div class="swiper-pagination swiper-pagination_best"></div>
                <button type="button" class="btn_slideNavi btn_slideNavi_best slidePrev"></button>
                <button type="button" class="btn_slideNavi btn_slideNavi_best slideNext"></button>
            </div>
        </section>


        <section class="recommend">
            <h3>의미 있게 시간을 버리는 방법!</h3>
            <h2 class="sectionTitle">이런 강의는 어떠신가요?</h2>
<?php

    $lectRecommend = "SELECT lect.*, pic.pic_name, prim.cate_prim_name, sec.cate_sec_name FROM lms_lecture lect 
        join lms_pic pic on lect.pic_link = pic.pic_key
        join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
        join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
        ORDER BY RAND() LIMIT 1";
    $queryLectRecommend = $mysqli -> query($lectRecommend) or die("query error=>".$mysqli->error);
    $r = $queryLectRecommend->fetch_object();

?>
            <figure class="lectureStyle item_lecture large">
                <div class="imgSection">
                    
                    <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name; ?>" alt=''>
                    <div class="buttons">
                        <?php 
                            $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$r->lect_key'";
                            $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);
                            
                            $h = $haveclass -> fetch_object();
                            
                            if($h){?>
                                <a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $r->lect_key; ?>" class="btn_payment_one">강의 시청하기</a>        
                            <?php }else{ ?>
                                <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                                    <input type="hidden" name="items" value="<?php echo $r->lect_key; ?>">
                                    <button class="btn_payment_one">결제하기</button>
                                </form>
                                <button type="button" class="btn_cart_one" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$r->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i></button>
                            <?php } ?>
                    </div>
                </div>
                <figcaption>
                    <div class="df">
                        <div class="tag">
                            <?php 
                                if($r->lect_price == 0) echo "<span class='free'></span>";
                                if(empty($r->lect_expdate)) echo "<span class='always'></span>";
                                if($r->lect_opt_prem) echo "<span class='prem'></span>";
                                if($r->lect_opt_repre) echo "<span class='repre'></span>";
                                if($r->lect_opt_begin) echo "<span class='begin'></span>";
                            ?>
                        </div>
                        <h3><a href="user_detail.php?no=<?php echo $r->lect_key?>"><?php echo $r->lect_name?></a></h3>
                        <p class="category">
                            <span><?php echo $r->cate_prim_name; ?></span>
                            <span><?php echo $r->cate_sec_name; ?></span>
                        </p>
                    </div>
                    <div class="df info">
                        <p class="date">
                            <?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?>
                        </p>
                        <p class="price">
                            <?php echo $r->lect_price == 0? "무료강의": number_format($r->lect_price)." 원"; ?>
                        </p>
                    </div>
                    
                </figcaption>
            </figure>
            <div class="rerender">
                <button type="button" onclick="nextRecommend()">다른 강의도 보여주세요 <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </section>





    <?php

        $sql_preview = "SELECT * FROM lms_cate_primary ORDER BY RAND() LIMIT 2";

        $preview = $mysqli -> query($sql_preview);

        while($previewResult = $preview -> fetch_array()){
            $previewList[]=$previewResult;
        }

        $previewOne = $previewList[0];
        $previewTwo = $previewList[1];


        $key_one = $previewOne['cate_prim_key'];


        $sql_preview_first = "SELECT * FROM lms_lecture lect 
            join lms_pic pic on lect.pic_link = pic.pic_key
            join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
            join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
            where lect_cate_pri=$key_one";
        
        $categoryOne_list = $mysqli->query($sql_preview_first);

        

        while($one = $categoryOne_list -> fetch_object()){
            $cateOne[]=$one;
        }
        
        ?>
        <section class="preview">
            <div class="d-flex justify-content-between flex-row">
                <h2 class="sectionTitle categories">
                    <span class="category_pri">
                        <a href="/kdt_lms/user_classlist.php?prim=<?php echo $previewOne['cate_prim_key']; ?>" class="__dis_link"><?php echo $previewOne['cate_prim_name']; ?></a>
                    </span>

                </h2>
                <a href="/kdt_lms/user_classlist.php?prim=<?php echo $previewOne['cate_prim_key']; ?>" class="more">자세히 보기 <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="d-flex gap-5 flex-wrap">

            <?php
                if(isset($cateOne)){
                    foreach($cateOne as $f){?>
                <figure class="lectureStyle item_lecture small">
                    <div class="imgSection">
                        <img src="/kdt_lms/lectThumb/<?php echo $f->pic_name; ?>" alt="">
                        <div class="buttons">
                        <?php 
                            $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$f->lect_key'";
                            $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);
                            
                            $h = $haveclass -> fetch_object();

                            if($h){?>
                                <a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $f->lect_key; ?>" class="btn_payment_one">강의 시청하기</a>        
                            <?php }else{ ?>
                                <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                                    <input type="hidden" name="items" value="<?php echo $f->lect_key; ?>">
                                    <button class="btn_payment_one">결제하기</button>
                                </form>
                                <button type="button" class="btn_cart_one" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$f->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i></button>
                            <?php } ?>
                    </div>
                    </div>
                    <figcaption>
                        <div class="df">
                            <div class="tag">
                                <?php 
                                    if($f->lect_price == 0) echo "<span class='free'></span>";
                                    if(empty($f->lect_expdate)) echo "<span class='always'></span>";
                                    if($f->lect_opt_prem) echo "<span class='prem'></span>";
                                    if($f->lect_opt_repre) echo "<span class='repre'></span>";
                                    if($f->lect_opt_begin) echo "<span class='begin'></span>";
                                ?>
                            </div>
                            <h3><a href="user_detail.php?no=<?php echo $f->lect_key?>"><?php echo $f->lect_name; ?></a></h3>
                            <p class="category">
                                <span><?php echo $f->cate_prim_name; ?></span>
                                <span><?php echo $f->cate_sec_name; ?></span>
                            </p>
                        </div>
                        <div class="df info">
                            <p><?php echo empty($f->lect_expdate)? "상시공개": $f->lect_expdate." 까지";?></p>
                            <p class="price"><?php echo $f->lect_price == 0? "무료강의": number_format($f->lect_price)." 원"; ?></p>
                        </div>

                    </figcaption>
                </figure>
            <?php }}else{echo "등록된 강의가 없습니다";}?>
            </div>
        </section>





        <?php 
        $key_two = $previewTwo['cate_prim_key'];

        $sql_preview_second = "SELECT * FROM lms_lecture lect 
            join lms_pic pic on lect.pic_link = pic.pic_key
            join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
            join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
            where lect_cate_pri=$key_two";
        
        $categoryTwo_list = $mysqli->query($sql_preview_second);

        

        while($two = $categoryTwo_list -> fetch_object()){
            $cateTwo[]=$two;
        }
        
        ?>
        <section class="preview">
            <div class="d-flex justify-content-between flex-row">
                <h2 class="sectionTitle categories">
                    <span class="category_pri">
                        <a href="/kdt_lms/user_classlist.php?prim=<?php echo $previewTwo['cate_prim_key']; ?>" class="__dis_link"><?php echo $previewTwo['cate_prim_name']; ?></a>
                    </span>

                </h2>
                <a href="/kdt_lms/user_classlist.php?prim=<?php echo $previewTwo['cate_prim_key']; ?>" class="more">자세히 보기 <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="d-flex gap-5 flex-wrap">

            <?php
                if(isset($cateTwo)){
                    foreach($cateTwo as $s){?>
                <figure class="lectureStyle item_lecture small">
                    <div class="imgSection">
                        <img src="/kdt_lms/lectThumb/<?php echo $s->pic_name; ?>" alt=''>
                        <div class="buttons">
                        <?php 
                            $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$s->lect_key'";
                            $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);
                            
                            $h = $haveclass -> fetch_object();

                            if($h){?>
                                <a href="/kdt_lms/user_my_takeclass.php?no=<?php echo $s->lect_key; ?>" class="btn_payment_one">강의 시청하기</a>        
                            <?php }else{ ?>
                                <form action="/kdt_lms/user_payment.php" method="POST" class="form_payment_one">
                                    <input type="hidden" name="items" value="<?php echo $s->lect_key; ?>">
                                    <button class="btn_payment_one">결제하기</button>
                                </form>
                                <button type="button" class="btn_cart_one" onclick="insertCart(<?php echo empty($_SESSION['SSIDX'])?'true':'false'; echo ','.$s->lect_key; ?>)" ><i class="fa-solid fa-cart-shopping"></i></button>
                            <?php } ?>
                    </div>
                    </div>
                    <figcaption>
                        <div class="df">
                            <div class="tag">
                                <?php 
                                    if($s->lect_price == 0) echo "<span class='free'></span>";
                                    if(empty($s->lect_expdate)) echo "<span class='always'></span>";
                                    if($s->lect_opt_prem) echo "<span class='prem'></span>";
                                    if($s->lect_opt_repre) echo "<span class='repre'></span>";
                                    if($s->lect_opt_begin) echo "<span class='begin'></span>";
                                ?>
                            </div>
                            <h3><a href="user_detail.php?no=<?php echo $s->lect_key?>"><?php echo $s->lect_name; ?></a></h3>
                            <p class="category">
                                <span><?php echo $s->cate_prim_name; ?></span>
                                <span><?php echo $s->cate_sec_name; ?></span>
                            </p>
                        </div>
                        <div class="df info">
                            <p><?php echo empty($s->lect_expdate)? "상시공개": $s->lect_expdate." 까지";?></p>
                            <p class="price"><?php echo $s->lect_price == 0? "무료강의": number_format($s->lect_price)." 원"; ?></p>
                        </div>

                    </figcaption>
                </figure>
            <?php }}else{echo "등록된 강의가 없습니다";}?>
            </div>
        </section>

    </main>


<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_index.js"></script>
    <script src="/kdt_lms/js/user_slide.js"></script>
   

</body>
</html>