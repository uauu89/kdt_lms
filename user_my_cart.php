<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    session_start();
    
    $sql_cartList = "SELECT 
    lect.lect_key, lect.lect_name, lect.lect_expdate, lect.lect_price, pic.pic_name, prim.*, sec.*
        from lms_cart cart 
        join lms_lecture lect on cart.cart_lect_link = lect.lect_key
        join lms_pic pic on lect.pic_link = pic.pic_key
        join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
        join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
        where cart.cart_user_link=".$_SESSION['SSIDX'];

    $cartList = $mysqli -> query($sql_cartList) or die("query error=>".$mysqli->error);
    
    while($c = $cartList -> fetch_object()){$cArray[]=$c;}

?>
    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my.css">

    <title>장바구니</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <div class="inner_large d-flex">
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_my_aside.php"; ?>
        <main class="flex-grow-1">
            <section>
                <div class="header">
                    <h2>장바구니</h2>
                </div>
                <div class="contents d-flex gap-5">
                    <table class="flex-grow-1">
                        <thead>
                            <tr>
                                <th class="td_checkbox td_button">
                                    <label for="tdCheckbox" class="my_btn d-flex justify-content-between">
                                        <input type="checkbox" id="tdCheckbox" <?php if(isset($cArray)){echo "checked";} ?>>전체 선택
                                    </label>
                                </th>
                                <th></th>
                                <th class="td_button">
                                    <button type="button" class="my_btn" onclick="del_itemList()">선택 삭제</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($cArray)){
                                foreach($cArray as $r){
                        ?>
                            <tr id="tr<?php echo $r->lect_key; ?>">
                                <td class="td_checkbox">
                                    <input type="checkbox" id="checkbox<?php echo $r->lect_key; ?>" checked>
                                    <label for="checkbox<?php echo $r->lect_key; ?>" class="checkLabel"></label>
                                </td>
                                <td class="td_lecture w-100">
                                    <figure class="lectureStyle list_lecture d-flex gap-4 px-4">
                                        <div class="imgSection flex-shrink-0">
                                            <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name?>" alt="">
                                        </div>
                                        <figcaption class="df gap-3 flex-grow-1">
                                            <h3><a href="/kdt_lms/user_detail.php?no=<?php echo $r->lect_key; ?>" title="강의정보 상세보기 페이지로 이동"><?php echo $r->lect_name?></a></h3>
                                            <p class="category">
                                                <span><?php echo $r->cate_prim_name; ?></span>
                                                <span><?php echo $r->cate_sec_name; ?></span>
                                            </p>
                                            <p class="date text-end"><?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?></p>
                                            <p class="price text-end" data-price="<?php echo $r->lect_price; ?>"><?php echo number_format($r->lect_price)." 원"; ?></p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td class="td_button">
                                    <button type="button" class="my_btn btn_itemDel" data-target="<?php echo $r->lect_key; ?>" onclick="del_item(this.dataset.target)">
                                        <span class="mHidden">개별삭제</span>
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    }else{
                        echo "<tr><td colspan=3 class='text-center'>장바구니에 보관중인 강의가 없습니다.</td></tr>";
                    }?>

                        </tbody>
                    </table>
    
                    <form class="paymentWrap" action="user_payment.php" method="POST">
                        <input type="hidden" name="items">
                        <div class="buttons d-flex flex-column gap-4">
                            <p class="count">
                                <span>선택된 강의</span>
                                <span class="input"></span>
                            </p>
                            <p class="price">
                                <span>총 주문금액</span>
                                <span class="input"></span>
                            </p>
                            <button class="btn_payment">선택강의 결제하기</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
        

    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>
    
    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_my.js"></script>
   
    <script>
        cal_bill();
        fill_bill();
        checkboxAllcheck();
        check_myCurrentPage();
    </script>

</body>
</html>
