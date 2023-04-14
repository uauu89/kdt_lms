<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";
    
    $cateP = "SELECT * from lms_cate_primary";
    $reP = $mysqli -> query($cateP) or die("query error=>".$mysqli->error);
    while($p = $reP->fetch_object()){$Parray[]=$p;}
    
    $pageId = $_GET["page"];
    $lect_key_array = explode(",",  $pageId);
?>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/admin_lecture.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="../js/admin_lecture.js"></script>
    <title>관리_일괄수정 - NOW</title>
</head>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/header.php"; ?>
    <main class="flex-grow-1">
        <h2 class="f_mainTitle m-5">강의 일괄수정하기</h2>
        <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-dark px-5 btn_back">뒤로</button>
        </div>

        <form action="admin_lecture_modAll_check.php" method="post" class="wrap d-flex gap-5 justify-content-center px-3">
            <input type="hidden" name="pageId" value="<?php echo $pageId?>">
            <div class="wrap_left">
                <div class="item1 d-flex gap-3">
                    <div class="w-50">
                        <label for="lect_cate_pri" class="form-label">대분류</label>
                        <select class="form-select" id="lect_cate_pri" name="lect_cate_pri">
                            <option selected disabled class="__hidden">대분류</option>
                            <?php 
                                foreach($Parray as $p){?>
                                <option value="<?php echo $p->cate_prim_key; ?>"><?php echo $p->cate_prim_name; ?></option>
                            <?php } ?>
                          </select>
                    </div>
                    <div class="w-50">
                        <label for="lect_cate_sec" class="form-label">소분류</label>
                        <select class="form-select" id="lect_cate_sec" name="lect_cate_sec" required>
                            <option value="" disabled class="__hidden">소분류</option>
                        </select>
                    </div>
                </div>
                <div class="item2 d-flex my-2">
                    <div class="w-50">
                        <label for="lect_status" class="form-label">상태</label>
                        <select class="form-select" id="lect_status" name="lect_status">
                            <option selected value="0">진행중</option>
                            <option value="1">종료</option>
                            <option value="2">준비중</option>
                        </select>
                    </div>
                </div>
                <div class="item3 my-2">
                    <div>노출옵션</div>
                    <div class="d-flex justify-content-start gap-3 py-2">
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_prem" name="lect_opt_prem" class="lect_opt form-check-input" value="1">
                            <label for="lect_opt_prem" class="form-check-label">프리미엄</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_repre" name="lect_opt_repre" class="lect_opt form-check-input" value="1">
                            <label for="lect_opt_repre" class="form-check-label">대표강의</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_begin" name="lect_opt_begin" class="lect_opt form-check-input" value="1">
                            <label for="lect_opt_begin" class="form-check-label">초보추천</label>
                        </div>
                    </div>
                </div>

                <div class="item5 d-flex ">
                    <div>
                        <label for="lect_price" class="form-label">수강료</label>
                        <input type="number" id="lect_price" name="lect_price" class="form-control" value="0" min="0" required>
                    </div>
                </div>

            </div>
            <div class="wrap_right flex-grow-1">
                <table class="table __shadow mt-3">
                    <thead>
                        <tr>
                            <th>강의번호</th>
                            <th>강의명</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($lect_key_array as $p){ 
                                $sql_c = "SELECT lect_name from lms_lecture where lect_key=".$p;
                                $result_c = $mysqli -> query($sql_c) or die("query error=>".$mysqli->error);
                                $c = $result_c->fetch_object();
                        ?>
                            <tr>
                                <td><?php echo $p; ?></td>
                                <td><?php echo $c->lect_name; ?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="submit" class="btn btn-dark px-5">수정</button>
                    <button type="button" class="btn btn-dark px-5 btn_back">취소</button>
                </div>
            </div>
        </form>
    </main>
    <script src="../js/common.js"></script>
    <script>
        secCate_listUp();
        historyBack();
    </script>
</body>
</html>