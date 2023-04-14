<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_require.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_sessionCheck_dupl.php";
    // session_start();
    
    if($_POST['conn_check']){
        
        $payment_date = date("Y-m-d H:i:s");
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

        $sql_insertHistory = "INSERT INTO lms_payment_history 
            (payment_date, payment_item, payment_price, payment_price_actual, point_use, point_acc, payment_user, payment_method, payment_methodInfo)
            VALUES ('$payment_date', '$payment_item', '$payment_price', '$payment_price_actual', '$point_use', '$point_acc', '$payment_user', '$payment_method', '$payment_methodInfo')";

        $insertHistory = $mysqli -> query($sql_insertHistory) or die("query error=>".$mysqli->error);

        $itemList = explode(",", $payment_item);

        foreach($itemList as $i){
            $sql_delete = "DELETE from lms_cart where cart_user_link=$payment_user && cart_lect_link=$i";
            $delete = $mysqli -> query($sql_delete) or die("query error=>".$mysqli->error);

            $sql_myclassInsert = "INSERT INTO lms_myclass (myclass_user, myclass_lect, myclass_regdate)
                VALUES ('$payment_user', '$i', '$payment_date')";
            $myclassInsert = $mysqli ->query($sql_myclassInsert) or die("query error=>".$mysqli->error);
        }

        $sql_pointUpdate = "UPDATE lms_info_user SET user_point = user_point + $point_acc - $point_use WHERE idx=$payment_user";
        $pointUpdate = $mysqli -> query($sql_pointUpdate) or die("query error=>".$mysqli->error);

    ?>

    <body>
        <form action="/kdt_lms/user_payment_result.php" method="POST">
            <input type="hidden" name="conn_check" value="true">
            <input type="hidden" name="date" value="<?php echo $payment_date; ?>">
            <input type="hidden" name="payment_item" value="<?php echo $payment_item; ?>">
            <input type="hidden" name="totalPrice" value="<?php echo $payment_price; ?>">
            <input type="hidden" name="actualPrice" value="<?php echo $payment_price_actual; ?>">
            <input type="hidden" name="point_use" value="<?php echo $point_use; ?>">
            <input type="hidden" name="point_acc" value="<?php echo $point_acc; ?>">
            <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
            <input type="hidden" name="methodInfo" value="<?php echo $payment_method_text; ?>">
        </form>

        <?php 
        if($insertHistory == 1){
            echo "<script>
                alert('결제되었습니다.');
                document.querySelector('form').submit();
            </script>";
        }
    }else{
        echo "<script>
            alert('잘못된 접근입니다.\\n첫 페이지로 돌아갑니다.'); 
            location.href='/kdt_lms/index.php';
        </script>";
    }

    
    ?>
</body>
