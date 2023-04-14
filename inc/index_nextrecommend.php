<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();

    $tf = empty($_SESSION['SSIDX'])?'true':'false';

    $lectRecommend = "SELECT lect.*, pic.pic_name, prim.cate_prim_name, sec.cate_sec_name FROM lms_lecture lect 
        join lms_pic pic on lect.pic_link = pic.pic_key
        join lms_cate_primary prim on lect.lect_cate_pri = prim.cate_prim_key
        join lms_cate_secondary sec on lect.lect_cate_sec = sec.cate_sec_key
        ORDER BY RAND() LIMIT 1";

    $queryLectRecommend = $mysqli -> query($lectRecommend) or die("query error=>".$mysqli->error);
    $r = $queryLectRecommend->fetch_object();


    
    if($r->lect_price == 0) $tagGroup.="<span class='free'></span>";
    if(empty($r->lect_expdate)) $tagGroup.="<span class='always'></span>";
    if($r->lect_opt_prem) $tagGroup.="<span class='prem'></span>";
    if($r->lect_opt_repre) $tagGroup.="<span class='repre'></span>";
    if($r->lect_opt_begin) $tagGroup.="<span class='begin'></span>";


    empty($r->lect_expdate)? $expdate = "상시공개": $expdate = $r->lect_expdate." 까지";
    $r->lect_price == 0? $price ="무료강의": $price = number_format($r->lect_price)." 원";


    $sql_haveclass = "SELECT * FROM lms_myclass where myclass_user='".$_SESSION['SSIDX']."' and myclass_lect='$r->lect_key'";
    $haveclass = $mysqli -> query($sql_haveclass) or die("query error=>".$mysqli->error);
    $h = $haveclass -> fetch_object();

    

    if($h){
        $buttons = "<a href='/kdt_lms/user_my_takeclass.php?no=$r->lect_key' class='btn_payment_one'>강의 시청하기</a>";
    }else{
        $buttons =  "<form action='/kdt_lms/user_payment.php' method='POST' class='form_payment_one'>
            <input type='hidden' name='items' value='$r->lect_key'>
            <button class='btn_payment_one'>결제하기</button>
            </form>
        <button type='button' class='btn_cart_one' onclick='insertCart($tf, $r->lect_key)' ><i class='fa-solid fa-cart-shopping'></i></button>";
    }
            
    // print_r($buttons);


    $nextItemInfo = "<div class='imgSection'>
                    <img src='/kdt_lms/lectThumb/$r->pic_name' alt=''>
                    <div class='buttons'>
                        $buttons
                    </div>
                </div>
                <figcaption>
                    <div class='df'>
                        <div class='tag'>
                            $tagGroup
                        </div>
                        <h3><a href='user_detail.php?no=$r->lect_key'>$r->lect_name</a></h3>
                        <p class='category'>
                            <span>$r->cate_prim_name</span>
                            <span>$r->cate_sec_name</span>
                        </p>
                    </div>
                    <div class='df info'>
                        <p class='date'>
                            $expdate
                        </p>
                        <p class='price'>
                            $price
                        </p>
                    </div>
                </figcaption>";

    echo $nextItemInfo;

?>


