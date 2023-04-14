<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    // session_start();

    $userIdx = $_SESSION["SSIDX"];

    $sql_history = "SELECT * FROM lms_payment_history where payment_user=$userIdx order by payment_date desc limit 0, 12";
    


    $history = $mysqli -> query($sql_history) or die("query error=>".$mysqli->error);
    while($h = $history -> fetch_object()){$hArray[]=$h;}

?>

    <link rel="stylesheet" href="/kdt_lms/css/user_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/user_my.css">

    <title>구매내역</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <div class="inner_large d-flex">
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_my_aside.php"; ?>
        <main class="flex-grow-1 section_history">
            <div class="header">
                <h2>구매내역</h2>
            </div>
            <div class="d-flex">
                <table class="flex-grow-1">
                    <thead>
                        <tr>
                            <th class="text-center">구매날짜</th>
                            <th class="text-center mHidden">구매강의</th>
                            <th class="text-center mHidden">상품금액</th>
                            <th class="text-center">사용포인트</th>
                            <th class="text-center">결제금액</th>
                            <th class="text-center">적립포인트</th>
                            <th class="text-center">결제수단</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($hArray)){
                                foreach($hArray as $r){ ?>
                        <tr>
                            <td class="text-center">
                                <span><?php echo date("Y-m-d", strtotime($r->payment_date)); ?> </span>
                                <span class="time mHidden"> <?php echo date("H시  i분", strtotime($r->payment_date)); ?></span>
                            </td>


                            <td class="mHidden text-center">
                                <ul class="d-flex flex-column gap-3">
                                <?php
                                    $payment_list = explode(",", $r->payment_item);
                                    foreach($payment_list as $key){
                                        $print = $mysqli -> query("SELECT lect_key, lect_name FROM lms_lecture where lect_key=$key") or die("query error=>".$mysqli_error);
                                        $printitem = $print -> fetch_object();
                                    ?>
                                    <li>
                                        <a href="/kdt_lms/user_detail.php?no=<?php echo $printitem->lect_key; ?>" title='강의 상세보기 페이지로 이동'><?php echo $printitem->lect_name; ?></a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </td>


                            <td class="mHidden text-center"><?php echo number_format($r->payment_price)." 원"; ?></td>
                            <td class="text-center"><?php echo number_format($r->point_use)." 원"; ?></td>
                            <td class="text-center"><?php echo number_format($r->payment_price_actual)." 원"; ?></td>
                            <td class="text-center"><?php echo number_format($r->point_acc)." 원"; ?></td>
                            <td class="text-center">
                                    <?php
                                        switch ($r->payment_method){
                                            case "credit":
                                                echo "체크/신용카드";
                                                break;
                                            case "account":
                                                echo "계좌이체";
                                                break;
                                            case "phone":
                                                echo "휴대전화";
                                                break;
                                            case "npay":
                                                echo "네이버페이";
                                                break;
                                            case "kpay":
                                                echo "카카오페이";
                                                break;
                                        };
                                    ?>
       
                            </td>
                        </tr>
                                <?php }
                            }else{
                                echo "<tr><td colspan=6 class='text-center'>구매내역이 없습니다.</td></tr>";
                            }?>
                        
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
    <!-- <script src="/kdt_lms/js/user_index.js"></script> -->
   

</body>
</html>
