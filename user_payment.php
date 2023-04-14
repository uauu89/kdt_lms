<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php";
    $userIdx = $_SESSION["SSIDX"];

    if(empty($userIdx)){
        echo "<script>
            alert('로그인이 필요한 페이지입니다.');
            history.back();
        </script>";
    }else{

    $sql_userPoint = "SELECT user_point from lms_info_user where idx=".$userIdx;

    $userPoint = $mysqli -> query($sql_userPoint) or die("query error=>".$mysqli->error);
    $point = $userPoint -> fetch_object();

    $item = $_POST["items"];
    $item_array = explode(",",  $_POST["items"]);
    $item_array2 = join(",",  $item_array);


    $sql_cartList = "SELECT 
    lect.lect_key, lect.lect_name, lect.lect_expdate, lect.lect_price, pic.pic_name, prim.*, sec.*
        from lms_lecture lect
        join lms_pic pic on lect.pic_link = pic.pic_key
        join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
        join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
        where lect.lect_key in ($item_array2)";

    $cartList = $mysqli -> query($sql_cartList) or die("query error=>".$mysqli->error);
    while($c = $cartList -> fetch_object()){$cArray[]=$c;}
}
?>

<link rel="stylesheet" href="/kdt_lms/css/user_common.css">
<link rel="stylesheet" href="/kdt_lms/css/user_payment.css">

    <title>결제하기</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <main class="inner_medium section_payment">
        <header>
            <h2 class="sectionTitle">결제하기</h2>
        </header>
        <table>
            <thead>
                <tr>
                    <th>강의명</th>
                    <th>강의 금액</th>
                    <th>할인 금액</th>
                    <th>결제 금액</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($cArray as $r){ 
                    $price_total += $r->lect_price;
            ?>
                <tr>
                    <td class="itemInfo d-flex align-items-center">
                        <img src="/kdt_lms/lectThumb/<?php echo $r->pic_name ?>" alt="">
                        <div>
                            <h3><?php echo $r->lect_name?></h3>
                            <p class="date"><?php echo empty($r->lect_expdate)? "상시공개": $r->lect_expdate." 까지";?></p>
                        </div>
                    </td>
                    <td class="price_item"><?php echo number_format($r->lect_price)." 원"; ?></td>
                    <td class="discount">-</td>
                    <td class="price_total"><?php echo number_format($r->lect_price)." 원"; ?></td>
                </tr>
                <?php } ?>

            </tbody>
            
        </table>
        <form action="/kdt_lms/inc/user_payment_check.php" method="POST" class="form">
            <input type="hidden" name="payment_item" value="<?php echo $item?>">
            <div class="d-flex">
                <section class="method">
                    <h2 class="sectionTitle">포인트 및 결제수단</h2>
                    <div class="d-flex gap-3 flex-column pointGroup">
                        <label for="point" class="myPoint d-flex justify-content-between">
                            <span>보유중인 포인트 :</span>
                            <input type="hidden" name="havePoint" class="havePoint" value="<?php echo $point->user_point?>">
                            <span><?php echo number_format($point->user_point); ?>원</span>
                        </label>

                        <div class="input-group align-items-center pe-5">
                            <label for="point" class="flex-shrink-0">포인트 사용</label>
                            <input type="number" id="point" name="point_use" class="form-control inputStyle input_usePoint" value="">
                            <button type="button" class="my_btn btn_usePoint" onclick="usePoint()">포인트 사용</button>
                        </div>
                        <div class="tip flex-shrink-0">
                            <section class="tipModal">
                                <h3>포인트 안내</h3>
                                <h4>적립</h4>
                                <p>포인트는 최종 결제금액의 10%가 적립됩니다.</p>
                                <p>(포인트 사용, 쿠폰 사용 및 이벤트로 차감된 가격은 적립되지 않습니다.)</p>
                                <h4>사용</h4>
                                <p>포인트는 현금과 동일하게 사용 가능하며 10원 단위로 사용 가능합니다.</p>
                            </section>
                        </div>
                        
                        
                    </div>
                    <div class="methodGroup d-flex align-items-start gap-5">
                        <h4>결제수단</h4>
                        <ul class="d-flex flex-column gap-4">
                            <li>
                                <input type="radio" name="payment_method" id="method_credit" value="credit" required >
                                <label for="method_credit"><i class="fa-solid fa-credit-card"></i> 신용/체크카드</label>
                            </li>
                            <li>
                                <input type="radio" name="payment_method" id="method_account" value="account">
                                <label for="method_account"><i class="fa-solid fa-hand-holding-dollar"></i> 계좌이체</label>
                            </li>
                            <li>
                                <input type="radio" name="payment_method" id="method_phone" value="phone">
                                <label for="method_phone"><i class="fa-solid fa-mobile-screen-button"></i> 휴대전화</label>
                            </li>
                            <li>
                                <input type="radio" name="payment_method" id="method_npay" value="npay">
                                <label for="method_npay"><img src="/kdt_lms/img/payment_icon_npay.png" alt=""> 네이버페이</label>
                            </li>
                            <li>
                                <input type="radio" name="payment_method" id="method_kpay" value="kpay">
                                <label for="method_kpay"><img src="/kdt_lms/img/payment_icon_kpay.png" alt=""> 카카오페이</label>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="bill">
                    <h2 class="sectionTitle">결제 상세정보</h2>
                    <ul class="step1 d-flex flex-column">
                        <li>
                            <span class="pTitle">선택된 강의</span>
                            <span><?php echo count($cArray); ?> 개</span>
                        </li>
                        <li>
                            <span class="pTitle">선택강의 금액</span>
                            <input type="hidden" name="totalPrice" class="totalPrice" value="<?php echo $price_total; ?>">
                            <span><?php echo number_format($price_total); ?> 원</span>
                        </li>
                        <li>
                            <span class="pTitle">포인트사용</span>
                            <span class="point_input">-</span>
                        </li>
                    </ul>
                    
                    <ul class="step2">
                        <li>
                            <input type="hidden" name="actualPrice">
                            <span class="total pTitle">최종 결제금액</span>
                            <span class="resultPrice"></span>
                        </li>
                        <li>
                            <input type="hidden" name="point_acc">
                            <span class="point pTitle">포인트 적립</span>
                            <span class="resultPoint"></span>
                        </li>
                    </ul>
                        
                </form>
            </div>
            <div class="buttons">
                <button type="button" class="btn_payment" onclick="modalPayment()" disabled>결제하기</button>
            </div>

        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>

    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_index.js"></script>
    <script>
        usePoint();
        methodSelect();
    </script>
   

</body>
</html>
