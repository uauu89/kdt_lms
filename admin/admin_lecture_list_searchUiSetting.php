<?php
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/c_dbcon.php";
    include $_SERVER['DOCUMENT_ROOT']."/kdt_lms/inc/admin_session.php";

    $selected = $_POST['selected'];

    switch ($selected) {
        case 'lect_cate_sec':
            $sqlCateP = "SELECT * from lms_cate_primary";
            $reP = $mysqli -> query($sqlCateP) or die("query error=>".$mysqli->error);
            while($i = $reP->fetch_object()){$iarray[]=$i;}

            foreach($iarray as $p){
                $catePHtml .= "<option value='$p->cate_prim_key'>$p->cate_prim_name</option>";
            }
            $searchHtml = "<div class='item3 d-flex gap-3'>
                <div class='w-50'>
                    <select class='form-select search_val' id='lect_cate_pri' onChange=secCate_listUp_process()>
                        <option selected disabled class='__hidden'>대분류</option>$catePHtml
                    </select>
                </div>
                <div class='w-50'>
                    <select class='form-select search_val' id='lect_cate_sec'>
                        <option disabled class='__hidden'>소분류</option>
                    </select>
                </div>
            </div>";
            break;
        case 'lect_status':
            $searchHtml = "<select class='form-select search_val' id='lect_status'>
                <option value='0'>진행중</option>
                <option value='1'>종료</option>
                <option value='2'>준비중</option>
            </select>";
            break;
        case 'lect_regdate':
            $searchHtml = "<input type='date' id='lect_regdate' class='form-control search_val'>";
            break;
        case 'lect_expdate':
            $searchHtml = "<input type='date' id='lect_expdate' class='form-control search_val'>";
            break;
        case 'lect_opt':
            $searchHtml = "<div class='d-flex justify-content-evenly form-control'>
                <div class='form-check'>
                    <input type='checkbox' id='lect_opt_prem' class='opt_prem form-check-input search_val' value='1'>
                    <label for='lect_opt_prem'>프리미엄</label>
                </div>
                <div class='form-check'>
                    <input id='lect_opt_repre' type='checkbox' class='opt_repre form-check-input search_val' value='1'>
                    <label for='lect_opt_repre'>대표강의</label>
                </div>
                <div class='form-check'>
                    <input id='lect_opt_begin' type='checkbox' class='opt_begin form-check-input search_val' value='1'>
                    <label for='lect_opt_begin'>초보추천</label>
                </div>
            </div>";
            break;
        default:
            $searchHtml = "<input type='text' class='form-control search_val'></input>";
            break;
    }
    echo $searchHtml;
?>