<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";

    if($_POST["conn_check"]){
        
    
    $payment_date = $_POST["date"];
    $payment_item = $_POST["payment_item"];
    
    $payment_price = $_POST["totalPrice"];
    $payment_price_actual = $_POST["actualPrice"];
    $point_use = $_POST["point_use"];
    $point_acc = $_POST["point_acc"];

    $payment_user = $_SESSION["SSIDX"];
    $payment_method = $_POST["payment_method"];
    $payment_methodInfo = $_POST["methodInfo"];

    switch ($payment_method){
        case "credit":
            $payment_method_text = "체크/신용카드";
            break;
        case "account":
            $payment_method_text = "계좌이체";
            break;
        case "phone":
            $payment_method_text = "휴대전화";
            break;
        case "npay":
            $payment_method_text = "네이버페이";
            break;
        case "kpay":
            $payment_method_text = "카카오페이";
            break;
    }


?>

<link rel="stylesheet" href="/kdt_lms/css/user_common.css">
<link rel="stylesheet" href="/kdt_lms/css/user_payment.css">

    <title>결제완료</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <main class="inner_medium section_paymentResult">
        <div class="bill_wrap">
            <header>
                <h2 class="sectionTitle">결제가 완료되었습니다.</h2>
            </header>
            <div>
                <ul class="payment_receipt">
                    <li>
                        <h3>결제 내역</h3>
                    </li>
                    <li>
                        <span>결제 일시 : </span><span><?php echo $payment_date; ?></span>
                    </li>
                    <li>
                        <span>결제 수단 : </span><span><?php echo $payment_method_text; ?></span>
                    </li>
                    <li>
                        <span>결제 금액 : </span><span><?php echo number_format($payment_price_actual)." 원"; ?></span>
                        <ul class="payment_price_detail">
                            <li>
                                <span>상품 금액 : </span><span><?php echo number_format($payment_price)." 원"; ?></span>
                            </li>
                            <li>
                                <span>사용 포인트 : </span><span><?php echo number_format($point_use)." 원"; ?></span>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span>적립 포인트 : </span><span><?php echo number_format($point_acc)." 원"; ?></span>
                    </li>

                </ul>
            </div>
            <div>
                <a href="/kdt_lms/user_my_class.php"><i class="fa-solid fa-arrow-left"></i> 내 강의실로 돌아가기</a>
            </div>
        </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>

    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_index.js"></script>
    <script>

    </script>
   

</body>
</html>

<?php }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }?>