<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/head.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";
    
    $cateP = "SELECT * from lms_cate_primary";
    $reP = $mysqli -> query($cateP) or die("query error=>".$mysqli->error);
    while($i = $reP->fetch_object()){$iarray[]=$i;}
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/admin_lecture.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/admin_lecture.js"></script>
    <title>관리_강의등록 - NOW</title>
</head>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/header.php"; ?>
    <main class="flex-grow-1">
        <h2 class="f_mainTitle m-5">강의 등록하기</h2>
        <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-dark px-5 btn_back">뒤로</button>
        </div>

        <form action="admin_lecture_reg_check.php" method="post" onsubmit="return lectDescImport()" class="wrap d-flex gap-5 justify-content-center px-3" enctype="multipart/form-data">
            <div class="wrap_left">
                <div class="item1 d-flex gap-3">
                    <div class="w-100">
                        <label for="formFile" class="form-label">대표이미지</label>
                        <input class="form-control" type="file" id="formFile" required>
                        <input type="hidden" name="lect_pic_link" id="lect_pic_link">
                    </div>
                </div>
                <div class="item2 my-2 __marginAuto">
                    <div class="ratio ratio-16x9">
                      <div class="text-bg-secondary rounded d-flex flex-column justify-content-center text-center">
                            <p>강의 대표이미지를 등록해주세요.</p>
                            <p>2MB 이하의 jpg / gif / png 파일만 업로드 가능합니다.</p>
                            <p>16:9 비율의 이미지를 권장합니다.</p>
                        </div>
                    </div>
                </div>
                <div class="item3 d-flex gap-3">
                    <div class="w-50">
                        <label for="lect_cate_pri" class="form-label">대분류</label>
                        <select class="form-select" id="lect_cate_pri" name="lect_cate_pri">
                            <option selected disabled class="__hidden" value="">대분류</option>
                            <?php 
                                foreach($iarray as $p){?>
                                <option value="<?php echo $p->cate_prim_key?>"><?php echo $p->cate_prim_name?></option>
                            <?php } ?>
                          </select>
                    </div>
                    <div class="w-50">
                        <label for="lect_cate_sec" class="form-label">소분류</label>
                        <select class="form-select" id="lect_cate_sec" name="lect_cate_sec" required>
                            <option disabled class="__hidden" value="">소분류</option>

                          </select>
                    </div>
                </div>
                <div class="item4 d-flex my-2">
                    <div class="w-50">
                        <label for="lect_status" class="form-label">상태</label>
                        <select class="form-select" id="lect_status" name="lect_status">
                            <option selected value="0">진행중</option>
                            <option value="1">종료</option>
                            <option value="2">준비중</option>
                        </select>
                    </div>
                </div>
                <div class="item5 my-2">
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
                <div class="item6 d-flex gap-3 my-2">
                    <div class="w-50">
                        <label for="lect_regdate" class="form-label">등록일</label>
                        <input type="date" id="lect_regdate" name="lect_regdate" class="form-control" required>
                    </div>
                    <div class="w-50">
                        <label for="lect_expdate" class="form-label">만료일</label>
                        <input type="date" id="lect_expdate" name="lect_expdate" class="form-control">
                    </div>
                </div>
                <div class="item7 d-flex ">
                    <div>
                        <label for="lect_price" class="form-label">수강료</label>
                        <input type="number" id="lect_price" name="lect_price" class="form-control" value="0" min="0" required>
                    </div>
                </div>
            </div>
            <div class="wrap_right flex-grow-1">
                <div class="item1">
                    <div>
                        <label for="lect_name" class="form-label">강의명</label>
                        <input type="text" id="lect_name" name="lect_name" class="form-control" required>
                    </div>
                </div>
                <div class="item2 my-2 d-flex align-items-end">
                    <div class="flex-grow-1">
                        <label for="lect_video_url" class="form-label">강의영상</label>
                        <input type="text" id="lect_video_url" class="form-control" placeholder="예시) https://www.youtube.com/watch?v=iObGpqXKBdY">
                        <input type="hidden" id="lect_video" name="lect_video">
                    </div>
                        <button type="button" class="btn btn-light border h-50 btn_lect_upload">등록</button>
                </div>
                <div class="item3 w-50 __marginAuto">
                    <div class="ratio ratio-16x9 __marginAuto lect_video_demosection">
                        <div class="text-bg-secondary rounded d-flex flex-column justify-content-center text-center">
                            <p>주소창의 주소를 복사해서 등록해주세요.</p>
                            <p>강의영상을 등록하면 이곳에서 미리 확인할 수 있습니다.</p>
                        </div>
                    </div>
                </div>
                <div class="item4 my-2">
                    <p class="form-label">강의설명</p>
                    <textarea name="lect_desc" id="lect_desc" style="display:none;"></textarea>
                    <div id="summernote">
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <button type="submit" class="btn btn-dark px-5">등록</button>
                    <button type="button" class="btn btn-dark px-5 btn_back">취소</button>
                </div>
            </div>
        </form>
        

    </main>
    
    
    <script src="../js/common.js"></script>

    <script>
        $('#summernote').summernote({height: 200, placeholder: "입력된 내용이 없습니다."});
        secCate_listUp();
        lectVideo_upload();
        historyBack();
        lectThumbsNew();
    </script>
</body>
</html>