<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    // session_start();
?>
<div class="userRemote">
    <div class="handler">
        <i class="fa-solid fa-up-down-left-right"></i>
        <button type="button">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
    </div>
    <ul class="mainNav">
        <li>
            <p>최근 본 강의</p>
            <ul class="sub_content">
            <?php
                if($_COOKIE['recently_products']){//쿠키에 값이 있으면
                    $prs = json_decode($_COOKIE['recently_products']);//배열로 바꾼다.
                    krsort($prs);//키값 기준으로 역순으로 정렬한다. 최근에 본걸 맨위에 올리기 위해서다.
                    $t=0;
                    foreach($prs as $ps){
                        $sql_recent = "SELECT lect.lect_key, lect.lect_name, pic.pic_name from lms_lecture lect
                            join lms_pic pic on lect.pic_link = pic.pic_key
                            where lect.lect_key=$ps";
                        $recentResult = $mysqli -> query($sql_recent) or die("query error=>".$mysqli->error);
                        $rescent = $recentResult -> fetch_object();
                ?>
                <li class="d-flex gap-3 align-items-center">
                    <img src="/kdt_lms/lectThumb/<?php echo $rescent->pic_name; ?>" alt="">
                    <a href="user_detail.php?no=<?php echo $rescent->lect_key;?>"><?php echo $rescent->lect_name; ?></a>
                </li>
            <?php
                $t++;
                    }
                }else{
                    echo "<li class='nostyle'>최근 본 상품이 없습니다<li>";
                }
                ?>
            </ul>
        </li>

        <li>
            <p>내 강의목록</p>
            <ul class="sub_content">
                <?php
                    $sql_remote_myclass = "SELECT lect.lect_key, lect.lect_name, pic.pic_name from lms_myclass my 
                        join lms_lecture lect on my.myclass_lect = lect.lect_key
                        join lms_pic pic on lect.pic_link = pic.pic_key
                        where my.myclass_user='".$_SESSION['SSIDX']."' limit 0, 5";

                    $remote_myclass = $mysqli -> query($sql_remote_myclass) or die("query error=>".$mysqli->error);

                    while($rResult = $remote_myclass -> fetch_object()){
                        $rArray[]=$rResult;
                    }
                    if(isset($rArray)){
                        foreach($rArray as $re){?>
                    <li class="d-flex gap-3 align-items-center">
                        <img src="/kdt_lms/lectThumb/<?php echo $re->pic_name; ?>" alt="">
                        <a href="user_my_takeclass.php?no=<?php echo $re->lect_key;?>"><?php echo $re->lect_name; ?></a>
                    </li>
                        <?php }?>
                    <li class="lastBtn"><a href="/kdt_lms/user_my_class.php" class="lastBtn">내 강의실로 이동</a></li>
                    <?php }else{
                        echo "<li class='nostyle'>강의목록이 없습니다<li>";
                    }?>
            </ul>
        </li>
        <!-- <li>
            <p>고객센터</p>
            <ul class="sub_content">
                <li class="nostyle">준비중입니다.</li>
            </ul>
        </li> -->
    </ul>
    <div class="btnTopWrap">
        <a href="#mainheader" class="btn_top __dis_link">Top</a>
    </div>
</div>