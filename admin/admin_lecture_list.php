<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    if(isset($_GET['page'])){
        $current_page = $_GET['page'];
    }else{
        $current_page = 1;
    }

    $pagesql = "SELECT COUNT(*) as cnt from lms_lecture";
    $page_result = $mysqli -> query($pagesql);
    $page_row = $page_result -> fetch_assoc();

    
    $onePage = 10;
    $oneBlock = 10;
    
    $article_legnth = $page_row['cnt'];
    $page_length = ceil($article_legnth / $onePage);
    
    $current_block = ceil($current_page / $oneBlock);

    $block_start = ($current_block - 1) * $oneBlock + 1;
    $block_end = $block_start + $oneBlock - 1; 
    if($block_end > $block_length) $block_end = $page_length;

    $page_start = ($current_page - 1) * $onePage;



    $sql="SELECT * from lms_lecture order by lect_key desc limit $page_start, $onePage";
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);
    while($i = $result->fetch_object()){$iarray[]=$i;}

?>
    <link rel="stylesheet" href="/kdt_lms/css/admin_common.css">
    <link rel="stylesheet" href="/kdt_lms/css/admin_lecture.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="/kdt_lms/js/admin_lecture.js"></script>
    <title>관리_강의목록 - NOW</title>
</head>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_header.php"; ?>
    <main class="flex-grow-1">
        <section>
            <h2 class="f_mainTitle m-5">강의 목록</h2>
            <div class="d-flex justify-content-between">
                <form action="admin_lecture_list_search.php" method="get" id="searchUiForm" class="input-group w-50" onsubmit="return searchValImport()">
                    <select name="search_category" id="searchCategory" class="form-select">
                        <option value="lect_key">강의번호</option>
                        <option value="lect_cate_sec">카테고리</option>
                        <option value="lect_name" selected>강의명</option>
                        <option value="lect_price">수강료</option>
                        <option value="lect_regdate">등록일</option>
                        <option value="lect_expdate">만료일</option>
                        <option value="lect_status">상태</option>
                        <option value="lect_opt">노출옵션</option>
                    </select>
                    <div id="searchUi" class="w-75">
                        <input type="text" class="form-control search_val">
                    </div>
                    <input type="hidden" class="search_content" name="search_val">
                    <button type="submit" class="btn btn-dark btn">검색</button>
                </form>
                <div class="d-flex justify-content-end gap-3">
                    <a href="admin_lecture_reg.php" class="btn btn-dark px-5">등록</a>
                    <button type="button" class="btn btn-dark px-5 btn_lect_modify">선택수정</button>
                    <button type="button" class="btn btn-dark px-5 btn_lect_delete">삭제</button>
                </div>
            </div>
            
            <table class="table table-hover __shadow mt-3">
                <thead>
                    <tr>
                        <th class="py-4"><label for="check_all"></label><input type="checkbox" id="check_all" class="form-check-input"></th>
                        <th>번호</th>
                        <th class="mb-3">대분류</th>
                        <th>소분류</th>
                        <th>강의명</th>
                        <th>수강료</th>
                        <th>등록일</th>
                        <th>만료일</th>
                        <th>노출옵션</th>
                        <th>상태</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if(isset($iarray)){
                        foreach($iarray as $p){
                    ?>
                <tr>
                    <td class="td_checkbox"><label for="tr_check_<?php echo $p->lect_key ?>"></label><input type="checkbox" id="tr_check_<?php echo $p->lect_key ?>" class="form-check-input" value=<?php echo $p->lect_key ?>></td>
                    <td><?php echo $p->lect_key ?></td>
                    <td><?php 
                        $cateP = "SELECT cate_prim_name from lms_cate_primary where cate_prim_key=".$p->lect_cate_pri;
                        $reP = $mysqli -> query($cateP) or die("query error=>".$mysqli->error);
                        $i = $reP -> fetch_object();
                        echo $i -> cate_prim_name;
                    ?></td>
                    <td><?php 
                        $cateS = "SELECT cate_sec_name from lms_cate_secondary where cate_sec_key=".$p->lect_cate_sec;
                        $reS = $mysqli -> query($cateS) or die("query error=>".$mysqli->error);
                        $i = $reS -> fetch_object();
                        echo $i -> cate_sec_name;
                    ?></td>
                    <td class="td_Zindex"><a href="admin_lecture_detail.php?page=<?php echo $p->lect_key ?>"><?php echo $p->lect_name ?></a></td>
                    <td><?php if($p->lect_price == 0){echo "무료강의";}else{echo number_format($p->lect_price); }?></td>
                    <td><?php echo $p->lect_regdate ?></td>
                    <td><?php if(empty($p->lect_expdate)){echo "상시강의";}else{echo $p->lect_expdate;}?></td>
                    <td>
                        <div class="d-flex justify-content-evenly">
                            <div class="form-check">
                                <input type="checkbox" name="opt_pri" <?php if($p->lect_opt_prem == 1){echo "checked";}; ?> disabled class="opt_prem form-check-input">프리미엄
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="opt_repre"   <?php if($p->lect_opt_repre == 1){echo "checked";}; ?>  disabled class="opt_repre form-check-input">
                                대표강의
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="opt_begin"  <?php if($p->lect_opt_begin == 1){echo "checked";}; ?> disabled class="opt_begin form-check-input">
                                초보추천
                            </div>
                        </div>
                    </td>
                    <td>
                        <select class="form-select" id="lect_status<?php echo $p->lect_key; ?>" name="lect_status" disabled>
                            <option value="0">진행중</option>
                            <option value="1">종료</option>
                            <option value="2">준비중</option>
                        </select>
                        <script>
                            document.querySelector("#lect_status<?php echo $p->lect_key;?> option[value='<?php echo $p->lect_status;?>']").selected = true;
                        </script>
                    </td>
                    <td class="td_Zindex">
                        <a href="admin_lecture_mod.php?page=<?php echo $p->lect_key; ?>" class="btn smallBtn btn_lect_modify"><i class="fa-solid fa-pencil"></i></a>
                        <button type="button" class="btn smallBtn btn_lect_delete_d" data-lectkey="<?php echo $p->lect_key; ?>"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>
                <?php }
                    echo "<script>
                        checkboxAllcheck();
                        deleteDirect();
                        deleteBtn();
                    </script>";
                }else{?>
                    <td colspan=11>결과가 없습니다</td>
                <?php } ?>
                </tbody>
            </table>
            <ul class="pagination justify-content-center mt-5">
                <li class="page-item <?php if($current_block < 2) echo "disabled"; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page-10; ?>" aria-label="Previous 10 pages">
                        <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                    </a>
                </li>
                <li class="page-item <?php if($current_page < 2) echo "disabled"; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page-1; ?>" aria-label="Previous 1 page">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                    </a>
                </li>
                <?php 
                    for($i = $block_start; $i <= $block_end; $i++){
                        if($current_page == $i){
                            echo "<li class='page-item active'><a href='?page=$i' class='page-link'>$i</a></li>";
                        }else{
                            echo "<li class='page-item'><a href='?page=$i' class='page-link'>$i</a></li>";
                        };
                    };
                ?>
                <li class="page-item <?php if($current_page >= $page_length) echo "disabled"; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page+1; ?>" aria-label="Next 1 page">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                    </a>
                </li>
                <li class="page-item <?php if($current_block >= $block_length) echo "disabled"; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page+1; ?>" aria-label="Nexts 10 pages">
                        <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                    </a>
                </li>
            </ul> 
        </section>
    </main>
    <script src="../js/common.js"></script>
    
    <script>
        modifyBtn();
        searchUiSetting();
        
    </script>
   
</body>
</html>