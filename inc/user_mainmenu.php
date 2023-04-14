<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php"; ?>


<header id="mainheader">
    <?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_remote.php"; ?>
    <div class="inner_medium">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="logo d-flex">
                <a href="/kdt_lms/index.php" title="메인페이지로 이동">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now">
                    <span class="mHidden">now!</span>
                </a>
            </h1>
            <ul class="user_ui d-flex align-items-center">
                <?php
                    if(empty($_SESSION["SSNAME"])){
                        echo "<li><a href='/kdt_lms/user_login.php'>로그인</a></li>
                            <li class='mHidden'><a href='/kdt_lms/user_login_create.php'>회원가입</a></li>";
                    }else{
                        echo
                        "<li class='username'><a href='/kdt_lms/user_my_class.php' title='".$_SESSION["SSNAME"]."님 마이페이지로 이동합니다.'>".$_SESSION["SSNAME"]."</a><span class='mHidden'>님</span></li>
                        <li class='mHidden'><a href='/kdt_lms/user_my_class.php'>마이페이지</a></li>
                        <li><a href='/kdt_lms/inc/user_logout.php'>로그아웃</a></li>";
                    }
                ?>
            </ul>
        </div>
        <nav>
            <button type="button">
                <i class="fa-solid fa-bars"></i>
                <span class="mHidden">클래스</span>
            </button>
            <ul class="mainmenu">
                <li><a href="/kdt_lms/user_classlist.php">전체</a></li>

                <?php 
                    $priMenu = $mysqli -> query("SELECT * from lms_cate_primary") or die("query error=>".$mysqli->error);
                    while($i = $priMenu->fetch_object()){$iarray[] = $i;}

                    if(isset($iarray)){
                        foreach($iarray as $p){
                ?>

                <li>
                    <a href="/kdt_lms/user_classlist.php?prim=<?php echo $p->cate_prim_key?>" class="__dis_link">
                        <?php echo $p->cate_prim_name; ?>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="/kdt_lms/user_classlist.php?prim=<?php echo $p->cate_prim_key?>" class="cateTitle">
                                <?php echo $p->cate_prim_name; ?> 전체
                            </a>
                        </li>

                        <?php 
                            $secMenu = $mysqli -> query("SELECT * from lms_cate_secondary where cate_prim_link=".$p->cate_prim_key) or die("query error=>".$mysqli->error);
                            unset($jarray);
                            while($j = $secMenu->fetch_object()){
                                $jarray[] = $j;
                            }
                            if(isset($jarray)){
                                foreach($jarray as $s){
                        ?>
                        <li>
                            <a href="/kdt_lms/user_classlist.php?prim=<?php echo $p->cate_prim_key; ?>&sec=<?php echo $s->cate_sec_key; ?>">
                                <?php echo $s->cate_sec_name; ?>
                            </a>
                        </li>
                        <?php }}?>
                    </ul>
                </li>        
                    <?php }}?>
            </ul>
        </nav>
    </div>



</header>