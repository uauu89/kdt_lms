<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $pageId = $_GET["page"];
    
    $sql = "SELECT * from lms_lecture L 
                    join lms_pic P on L.pic_link = P.pic_key 
                    join lms_cate_primary cP on L.lect_cate_pri = cP.cate_prim_key
                    join lms_cate_secondary cS on L.lect_cate_sec = cS.cate_sec_key
                    where L.lect_key=".$pageId;
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);
    $i = $result->fetch_object();
    
?>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/admin_lecture.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="../js/admin_lecture.js"></script>
    <title>관리_상세보기 - NOW</title>
</head>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/header.php"; ?>
    <main class="flex-grow-1">
        <h2 class="f_mainTitle m-5">강의 상세보기</h2>
        <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-dark px-5 btn_list">뒤로</button>
            <a href="admin_lecture_mod.php?page=<?php echo $pageId; ?>" class="btn btn-dark px-5">수정</a>
            <button type="button" class="btn btn-dark px-5 btn_lect_delete_d" data-lectkey="<?php echo $i->lect_key; ?>">삭제</button>
        </div>
        <div class="wrap d-flex gap-5 justify-content-center px-3">
            <div class="wrap_left">
                <div class="item1 d-flex gap-3">
                    <div>
                        <label for="lect_no" class="form-label">강의번호</label>
                        <input type="text" id="lect_no" name="lect_no" class="form-control" value="<?php echo $i->lect_key; ?>" readonly>
                    </div>
                    <div>
                        <label for="lect_view" class="form-label">조회수</label>
                        <input type="text" id="lect_view" name="lect_view" class="form-control" value="<?php echo $i->lect_view; ?>" readonly>
                    </div>
                </div>
                <div class="item2 my-2 __marginAuto">
                    <div class="ratio ratio-16x9">
                        <div class="text-bg-secondary rounded">
                            <img src="../lectThumb/<?php echo $i->pic_name; ?>" alt="강의 대표 이미지" class="thumbnail">
                        </div>
                    </div>
                </div>
                <div class="item3 d-flex gap-3">
                    <div class="w-50">
                        <label for="lect_cate_pri" class="form-label">대분류</label>
                        <select class="form-select" id="lect_cate_pri" name="lect_cate_pri" disabled>
                            <option value="<?php echo $i->cate_prim_key; ?>" selected ><?php echo $i->cate_prim_name; ?></option>
                          </select>
                    </div>
                    <div class="w-50">
                        <label for="lect_cate_sec" class="form-label">소분류</label>
                        <select class="form-select" id="lect_cate_sec" name="lect_cate_sec" disabled>
                            <option value="<?php echo $i->cate_sec_key; ?>" selected><?php echo $i->cate_sec_name; ?></option>
                        </select>
                    </div>
                </div>
                <div class="item4 d-flex my-2">
                    <div class="w-50">
                        <label for="lect_status" class="form-label">상태</label>
                        <select class="form-select" id="lect_status" name="lect_status" disabled>
                            <option value="0" <?php if($i->lect_status == 0){echo "selected";}; ?>>진행중</option>
                            <option value="1" <?php if($i->lect_status == 1){echo "selected";}; ?>>종료</option>
                            <option value="2" <?php if($i->lect_status == 2){echo "selected";}; ?>>준비중</option>
                        </select>
                    </div>
                </div>
                <div class="item5 my-2">
                    <div>노출옵션</div>
                    <div class="d-flex justify-content-start gap-3 py-2">
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_prem" name="lect_opt_prem" <?php if($i->lect_opt_prem == 1){echo "checked";}; ?> disabled class="lect_opt form-check-input">
                            <label for="lect_opt_prem" class="form-check-label">프리미엄</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_repre" name="lect_opt_repre" <?php if($i->lect_opt_repre == 1){echo "checked";}; ?> disabled class="lect_opt form-check-input">
                            <label for="lect_opt_repre" class="form-check-label">대표강의</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_begin" name="lect_opt_begin" <?php if($i->lect_opt_begin == 1){echo "checked";}; ?> disabled class="lect_opt form-check-input">
                            <label for="lect_opt_begin" class="form-check-label">초보추천</label>
                        </div>
                    </div>
                </div>
                <div class="item6 d-flex gap-3 my-2">
                    <div class="w-50">
                        <label for="lect_regdate" class="form-label">등록일</label>
                        <input type="date" id="lect_regdate" name="lect_regdate" class="form-control" value="<?php echo $i->lect_regdate; ?>" readonly>
                    </div>
                    <div class="d-flex flex-column w-50">
                        <label for="lect_expdate" class="form-label">만료일</label>
                        <input id="lect_expdate" name="lect_expdate" class="form-control"
                            <?php if(empty($i->lect_expdate)){
                                echo "type='text' value='상시공개'";
                            }else{
                                echo "type='date' value='".$i->lect_expdate."'";
                            }?> readonly>
                    </div>
                </div>
                <div class="item7 d-flex ">
                    <div>
                        <label for="lect_price" class="form-label">수강료</label>
                        <input type="text" id="lect_price" name="lect_price" class="form-control" value="<?php echo number_format($i->lect_price); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="wrap_right flex-grow-1">
                <div class="item1">
                    <div>
                        <label for="lect_name" class="form-label">강의명</label>
                        <input type="text" id="lect_name" name="lect_name" class="form-control" value="<?php echo $i->lect_name; ?>" readonly>
                    </div>
                </div>
                <div class="item2 my-2 w-50 __marginAuto">
                    <div class="ratio ratio-16x9 __marginAuto lect_video_demosection">
                        <iframe src="https://www.youtube.com/embed/<?php echo $i->lect_video; ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item3">
                    <div>
                        <p class="form-label">강의설명</p>
                        <div id="lect_desc" class="rounded bg-white p-3"></div>
                    </div>
                </div>
            </div>
        </div>
        

    </main>
    <script src="../js/common.js"></script>

    <script>
        listBack();
        deleteDirect();
        <?php echo "lectDescExport('".trim($i->lect_desc)."');";?>
    </script>
</body>
</html>