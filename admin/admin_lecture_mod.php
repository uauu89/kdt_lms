<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";
    
    $cateP = "SELECT * from lms_cate_primary";
    $reP = $mysqli -> query($cateP) or die("query error=>".$mysqli->error);
    while($p = $reP->fetch_object()){$Parray[]=$p;}
    
    
    $pageId = $_GET["page"];
    
    $sql = "SELECT * from lms_lecture L join lms_pic P on L.pic_link = P.pic_key where L.lect_key=".$pageId;
    $result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);
    $m = $result->fetch_object();

    $cateS = "SELECT * from lms_cate_secondary where cate_prim_link=".$m->lect_cate_pri;
    $reS = $mysqli -> query($cateS) or die("query error=>".$mysqli->error);
    while($s = $reS->fetch_object()){$Sarray[]=$s;}
?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/admin_lecture.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="../js/admin_lecture.js"></script>
    <title>관리_강의수정 - NOW</title>
</head>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/header.php"; ?>
    <main class="flex-grow-1">
        <h2 class="f_mainTitle m-5">강의 수정하기</h2>
        <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-dark px-5 btn_back">뒤로</button>
        </div>

        <form action="admin_lecture_mod_check.php" method="post" onsubmit="return lectDescImport()" class="wrap d-flex gap-5 justify-content-center px-3">
            <div class="wrap_left">
                <div class="item1 d-flex gap-3">
                    <div class="w-100">
                        <label for="formFile" class="form-label">대표이미지</label>
                        <input class="form-control" type="file" id="formFile">
                        <input type="hidden" name="lect_pic_link" id="lect_pic_link" value="<?php echo $m->pic_key; ?>">
                    </div>
                </div>
                <div class="item2 my-2 __marginAuto">
                    <div class="ratio ratio-16x9">
                        <div class="text-bg-secondary rounded">
                            <img src="../lectThumb/<?php echo $m->pic_name; ?>" alt="강의 대표 이미지" class="thumbnail">
                        </div>
                    </div>
                </div>
                <div class="item3 d-flex gap-3">
                    <div class="w-50">
                        <label for="lect_cate_pri" class="form-label">대분류</label>
                        <select class="form-select" id="lect_cate_pri" name="lect_cate_pri">
                            <?php 
                                foreach($Parray as $p){?>
                                <option value="<?php echo $p->cate_prim_key; ?>" <?php if($m->lect_cate_pri == $p->cate_prim_key) echo "selected"; ?>><?php echo $p->cate_prim_name; ?></option>
                            <?php } ?>
                          </select>
                    </div>
                    <div class="w-50">
                        <label for="lect_cate_sec" class="form-label">소분류</label>
                        <select class="form-select" id="lect_cate_sec" name="lect_cate_sec">
                            <?php 
                                foreach($Sarray as $s){?>
                                <option value="<?php echo $s->cate_sec_key; ?>" <?php if($m->lect_cate_sec == $s->cate_sec_key) echo "selected"; ?>><?php echo $s->cate_sec_name; ?></option>
                            <?php } ?>    
                          </select>
                    </div>
                </div>
                <div class="item4 d-flex my-2">
                    <div class="w-50">
                        <label for="lect_status" class="form-label">상태</label>
                        <select class="form-select" id="lect_status" name="lect_status">
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
                            <input type="checkbox" id="lect_opt_prem" name="lect_opt_prem" class="lect_opt form-check-input" value="1" <?php if($m->lect_opt_prem == 1) echo "checked"; ?>>
                            <label for="lect_opt_prem" class="form-check-label">프리미엄</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_repre" name="lect_opt_repre" class="lect_opt form-check-input" value="1" <?php if($m->lect_opt_repre == 1) echo "checked"; ?>>
                            <label for="lect_opt_repre" class="form-check-label">대표강의</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lect_opt_begin" name="lect_opt_begin" class="lect_opt form-check-input" value="1" <?php if($m->lect_opt_begin == 1) echo "checked"; ?>>
                            <label for="lect_opt_begin" class="form-check-label">초보추천</label>
                        </div>
                    </div>
                </div>
                <div class="item6 d-flex gap-3 my-2">
                    <div class="w-50">
                        <label for="lect_regdate" class="form-label">등록일</label>
                        <input type="date" id="lect_regdate" name="lect_regdate" class="form-control" value="<?php echo $m->lect_regdate; ?>" required>
                    </div>
                    <div class="w-50">
                        <label for="lect_expdate" class="form-label">만료일</label>
                        <input type="date" id="lect_expdate" name="lect_expdate" class="form-control" <?php if (!empty($m->lect_expdate)) echo $m->lect_expdate; ?>>
                    </div>
                </div>
                <div class="item7 d-flex ">
                    <div>
                        <label for="lect_price" class="form-label">수강료</label>
                        <input type="number" id="lect_price" name="lect_price" class="form-control" value="<?php echo $m->lect_price; ?>" min="0" required>
                    </div>
                </div>
            </div>
            <div class="wrap_right flex-grow-1">
                <div class="item1 d-flex gap-3">
                    <div>
                        <label for="lect_key" class="form-label">강의번호</label>
                        <input type="text" id="lect_key" name="lect_key" class="form-control" value="<?php echo $m->lect_key; ?>" readonly>
                    </div>
                    <div class="flex-grow-1">
                        <label for="lect_name" class="form-label">강의명</label>
                        <input type="text" id="lect_name" name="lect_name" class="form-control" value="<?php echo $m->lect_name; ?>" required>
                    </div>
                </div>
                <div class="item2 my-2 d-flex align-items-end">
                    <div class="flex-grow-1">
                        <label for="lect_video_url" class="form-label">강의영상</label>
                        <input type="text" id="lect_video_url" class="form-control" placeholder="예시) https://www.youtube.com/watch?v=iObGpqXKBdY" value="https://www.youtube.com/watch?v=<?php echo $m->lect_video?>">
                        <input type="hidden" id="lect_video" name="lect_video" value="<?php echo $m->lect_video; ?>">
                    </div>
                        <button type="button" class="btn btn-light border h-50 btn_lect_upload">등록</button>
                </div>
                <div class="item3 w-50 __marginAuto">
                    <div class="ratio ratio-16x9 __marginAuto lect_video_demosection">
                        <iframe src="https://www.youtube.com/embed/<?php echo $m->lect_video; ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item4 my-2">
                    <p class="form-label">강의설명</p>
                    <textarea name="lect_desc" id="lect_desc" style="display:none;"></textarea>
                    <div id="summernote">
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <button type="submit" class="btn btn-dark px-5">수정</button>
                    <button type="button" class="btn btn-dark px-5 btn_back">취소</button>
                </div>
            </div>
        </form>
        

    </main>
    
    <script src="../js/common.js"></script>
    <script>
        $('#summernote').summernote({height: 200});
        secCate_listUp();
        lectVideo_upload();
        historyBack();

        <?php echo "lectDescExport('".trim($m->lect_desc)."');";?>


    </script>
</body>
</html>