<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    session_start();

    $tf = empty($_SESSION['SSIDX'])?'true':'false';

    $prim_key = $_POST['prim_key'];
    $sec_key = $_POST['sec_key'];
    $opt_prem = $_POST['opt_prem']; 
    $opt_repre = $_POST['opt_repre'];
    $opt_begin = $_POST['opt_begin'];
    $opt_free = $_POST['opt_free'];

    $sort_option = $_POST['sort_option'];

    $adOrder = $_POST['adOrder'];
    $pagenation = $_POST['pagenation'];
    

    if($prim_key){
        $sql_state .= " and pri.cate_prim_key=$prim_key";
    }
    if($sec_key){
        $sql_state .= " and sec.cate_sec_key=$sec_key";
    }
    if($opt_prem){
        $sql_state .= " and lec.lect_opt_prem=1";
    }
    if($opt_repre){
        $sql_state .= " and lec.lect_opt_repre=1";
    }
    if($opt_begin){
        $sql_state .= " and lec.lect_opt_begin=1";
    }
    if($opt_free){
        $sql_state .= " and lec.lect_price=0";
    }

    if(isset($sql_state)){
        $sql_state = " where ".mb_substr($sql_state, 5);
    }

    if(!$adOrder){
        $sql_adOrder = "desc";
    }

    $startPage = $pagenation * 12;
    $nextPage = $startPage + 12;
    $sql_limit = " limit $startPage, 12";
    

    switch ($sort_option){
        case "order_regdate":
            $sql_order = " order by lec.lect_regdate $sql_adOrder";
            break;
        case "order_expdate":
            $sql_order = " order by lec.lect_expdate $sql_adOrder";
            break;
        case "order_view":
            $sql_order = " order by lec.lect_view $sql_adOrder";
            break;
        case "order_price":
            $sql_order = " order by lec.lect_price $sql_adOrder";
            break;
    }

    $sql_check_nextPage = "SELECT lec.lect_key FROM lms_lecture lec
        join lms_cate_primary pri on lec.lect_cate_pri = pri.cate_prim_key
        join lms_cate_secondary sec on lec.lect_cate_sec = sec.cate_sec_key
        join lms_pic pic on lec.pic_link = pic.pic_key".$sql_state.$sql_order." limit $nextPage, 1";
    
    $checkpage_result = $mysqli -> query($sql_check_nextPage);
    $c = $checkpage_result -> fetch_object();

    if(isset($c->lect_key)){
        $tail_more =  "<div class='moreWrap'><button type='button' class='more' onclick='func_more(this)'><i class='fa-solid fa-circle-plus'></i>더 보기</button></div>";
    }

    $sql_lect_render = "SELECT lec.*, pic.pic_name, pri.cate_prim_name, sec.cate_sec_name FROM lms_lecture lec
        join lms_cate_primary pri on lec.lect_cate_pri = pri.cate_prim_key
        join lms_cate_secondary sec on lec.lect_cate_sec = sec.cate_sec_key
        join lms_pic pic on lec.pic_link = pic.pic_key".$sql_state.$sql_order.$sql_limit;
        

    $lect_render = $mysqli -> query($sql_lect_render) or die("query error=>".$mysqli->error);

    while($render = $lect_render -> fetch_object()){
        $rArray[]=$render;
    }

    if(isset($rArray)){
        foreach($rArray as $r){

    $tagGroup="";    

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

        $returned.="<figure class='lectureStyle item_lecture small'>
        <div class='imgSection'>
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
                <p class='date'>$expdate</p>
                <p class='price'>$price</p>
            </div>
        </figcaption>
    </figure>";
    }
    $returned.=$tail_more;
    }else{
        $returned = "<p>등록된 강의가 없습니다.</p>";
    }
    echo $returned;

?>
