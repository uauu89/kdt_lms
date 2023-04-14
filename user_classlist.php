<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_head.php"; 
    
    isset($_GET['prim'])?
        $prim_key = $_GET['prim']:
        $prim_key = 0;

    isset($_GET['sec'])?
        $sec_key = $_GET['sec']:
        $sec_key = 0;
    
?>

<link rel="stylesheet" href="/kdt_lms/css/user_common.css">
<link rel="stylesheet" href="/kdt_lms/css/user_index.css">
<link rel="stylesheet" href="/kdt_lms/css/user_classlist.css">

<title>클래스</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_mainmenu.php"; ?>
    <main class="inner_medium section_classlist">
        <h2 class="sectionTitle">클래스</h2>
        <section>
            <header class="d-flex">
                <h3 class="__hidden">카테고리 별 개설강의 리스트</h3>
                <div class="hiddenInputGroup __hidden">
                    <input type="hidden" id="prim_key" name="prim_key" value="<?php echo $prim_key;?>">
                    <input type="hidden" id="sec_key" name="sec_key" value="<?php echo $sec_key;?>">
                    <input type="hidden" id="sort_opt" name="sort_opt" value="0">
                    <input type="hidden" id="pagenation" name="pagenation" value="0">
                </div>
                <div class="d-flex cateGroup">

                    <div class="selectBoxWrap">
                        <div class="style_selectBox cate_pri">
                            <span>대분류</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <?php
                            $cateP = $mysqli -> query("SELECT * FROM lms_cate_primary");
                            while($cateP_result = $cateP -> fetch_object()){
                                $pArray[] = $cateP_result;
                            }
                        ?>
                        <ul class="selectOption">
                            <li>
                                <input type="radio" id="catP_0" name="cate_pri" value="0" onclick="func_subcategory(this)">
                                <label for="catP_0">전체</label>
                            </li>
                            <?php 
                        foreach($pArray as $p){?>
                            <li>
                                <input type="radio" id="catP_<?php echo $p->cate_prim_key; ?>" name="cate_pri" value="<?php echo $p->cate_prim_key; ?>" onclick="func_subcategory(this)">
                                <label for="catP_<?php echo $p->cate_prim_key; ?>"><?php echo $p->cate_prim_name; ?></label>
                            </li>
                        <?php }?>
                        </ul>
                    </div>


                    <div class="selectBoxWrap">
                        <div class="style_selectBox cate_sec">
                            <span>소분류</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="selectOption">
                            <li>
                                <label>
                                    대분류를 먼저 선택해주세요.
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="optionList d-flex">
                    <li>
                        <input type="checkbox" id="opt_prem" value=0>
                        <label for="opt_prem">프리미엄</label>
                    </li>
                    <li>
                        <input type="checkbox" id="opt_repre" value=0>
                        <label for="opt_repre">대표강의</label>
                    </li>
                    <li>
                        <input type="checkbox" id="opt_begin" value=0>
                        <label for="opt_begin">초보추천</label>
                    </li>
                    <li>
                        <input type="checkbox" id="opt_free" value=0>
                        <label for="opt_free">무료강의</label>
                    </li>
                </ul>

                <div class="d-flex">
                    <div class="selectBoxWrap sortingWrap">
                        <div class="style_selectBox sorting">
                            <span>정렬기준</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="selectOption sortingList">
                            <li>
                                <input type="radio" id="order_regdate" name="sortOption" value="order_regdate" checked>
                                <label for="order_regdate">등록일</label>
                            </li>
                            <li>
                                <input type="radio" id="order_expdate" name="sortOption" value="order_expdate">
                                <label for="order_expdate">만료일</label>
                            </li>
                            <li>
                                <input type="radio" id="order_view" name="sortOption" value="order_view">
                                <label for="order_view">조회수</label>
                            </li>
                            <li>
                                <input type="radio" id="order_price" name="sortOption" value="order_price">
                                <label for="order_price">가격</label>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="btn_adOrderWrap">
                        <input type="checkbox" id="adOrder" value=0 class="__hidden">
                        <label for="adOrder" class="btn_adOrder"><i class="fa-solid fa-arrow-down"></i></label>
                    </div>
                </div>

                
            </header>
            <div class="d-flex flex-wrap gap-5 sorted_list">
           
            </div>

        </section>



    </main>



<?php include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/user_footer.php"; ?>

    <script src="/kdt_lms/js/user_remote.js"></script>
    <script src="/kdt_lms/js/user_common.js"></script>
    <script src="/kdt_lms/js/user_index.js"></script>
    <script>
        func_category();
        ajax_lectureRender();
        func_optionList();
        func_orderOption();
        func_adOrder();
    </script>
   

</body>
</html>
