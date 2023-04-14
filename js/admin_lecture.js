function historyBack(){
    for(let i of document.querySelectorAll(".btn_back")){
        i.addEventListener("click", e=>{
            history.back();
        });
    }
}
function listBack(){
    for(let i of document.querySelectorAll(".btn_list")){
        i.addEventListener("click", e=>{
            location.href='admin_lecture_list.php';
        });
    }
}


function secCate_listUp_process(prival){
    if(!prival){
        prival = document.querySelector("#lect_cate_pri").value;
    }
        let data = {prival : prival};
        $.ajax({
            async: false,
            type: "post",
            data: data,
            url: "admin_category.php",
            dataType: "html",
            success: function(returned){
                document.querySelector("#lect_cate_sec").innerHTML = returned;
            }
        })
}

function secCate_listUp(){
    document.querySelector("#lect_cate_pri").addEventListener("change", e=>{
        secCate_listUp_process();
    })
}

function lectVideo_upload(){
    document.querySelector(".btn_lect_upload").addEventListener("click", e=>{
        let val = (document.querySelector("#lect_video_url").value).split("=").pop();
        let insertVideo = `<iframe src="https://www.youtube.com/embed/${val}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`;
        document.querySelector(".lect_video_demosection").innerHTML = insertVideo;
        document.querySelector("#lect_video").value = val;
    })
}


function checkboxAllcheck(){
    let allbtn = document.querySelector("#check_all");
    allbtn.addEventListener("change", e=>{
        for(i of document.querySelectorAll(".td_checkbox .form-check-input")){
            i.checked = e.target.checked;
        }
    });
}


function deleteProcess(targetId){
    let data = {lect_key : targetId}
    $.ajax({
        async: false,
        type: "post",
        url: "admin_lecture_delete.php",
        data: data,
        dataType: "json",
        error: function(result){
            alert("삭제에 실패하였습니다.");
        },
        success: function(result){
            if(result.result == "ok"){
                alert("삭제되었습니다");
                let currentPage = ((document.location.href).split("/").pop()).split(".")[0];
                currentPage=="admin_lecture_list"?window.location.reload():location.href='admin_lecture_list.php';
                
            }
        }
    })
}
function deleteDirect(){
    for(i of document.querySelectorAll(".btn_lect_delete_d")){
        i.addEventListener("click", e=>{
            let targetId = [e.currentTarget.dataset.lectkey];
            let targetName;
            if(document.querySelector(`#tr_check_${targetId[0]}`)){
                targetName = document.querySelector(`#tr_check_${targetId[0]}`).closest("tr").querySelector("td:nth-of-type(5)").innerText;
            }else{
                targetName = document.querySelector("#lect_name").value;
            }
            
            if(confirm(`${targetId}번 [${targetName}]\n정말 삭제할까요?`)){
                deleteProcess(targetId);
            }
        })
    };
}
function deleteBtn(){
    document.querySelector(".btn_lect_delete").addEventListener("click", e=>{
        let targetId = [];
        for(c of document.querySelectorAll(".td_checkbox input[type=checkbox]:checked")){
            targetId.push(c.value);
        }
        if(targetId.length == 0){
            alert("선택된 강의가 없습니다.");
        }else if(targetId.length == 1){
            let targetName = document.querySelector(`#tr_check_${targetId}`).closest("tr").querySelector("td:nth-of-type(5)").innerText;
            if(confirm(`${targetId}번 [${targetName}]\n정말 삭제할까요?`)){
                deleteProcess(targetId);
            }
        }else{
            if(confirm(`선택된 강의번호 : ${targetId}\n전부 삭제할까요?`)){
                deleteProcess(targetId);
            }
        }
    })
}

function modifyBtn(){
    document.querySelector(".btn_lect_modify").addEventListener("click", e=>{
        let targetId = [];
        for(c of document.querySelectorAll(".td_checkbox input[type=checkbox]:checked")){
            targetId.push(c.value);
        }
        if(targetId.length == 0){
            alert("선택된 강의가 없습니다.");
        }else if(targetId.length == 1){
            location.href=`admin_lecture_mod.php?page=${targetId}`;
        }else{
            location.href=`admin_lecture_modAll.php?page=${targetId}`;
        }
    })
}

function lectThumbsNew(){
    let picDataInput = document.querySelector("#lect_pic_link");

    document.querySelector("#formFile").addEventListener("change", e=>{
        if(document.querySelector("#lect_pic_link").value != ""){
            lectThumbDel(document.querySelector("#lect_pic_link").value);
        }else{
            console.log("file form change test");
        }
        var thumbForm = new FormData();
        thumbForm.append('savefile', e.currentTarget.files[0]);

        // - contentType : false 로 선언 시 content-type 헤더가 multipart/form-data로 전송되게 함
        // - processData : false로 선언 시 formData를 string으로 변환하지 않음
        $.ajax({
            cache: false,
            type: "post",
            url: "admin_lecture_thumbNew.php",
            contentType: false,
            processData: false,
            data: thumbForm,
            dataType: "json",
            error: function(result){
                alert("이미지 업로드에 실패하였습니다.");
            },
            success: function(result){
                if(result.result == "size"){
                    alert('2MB 이하의 파일만 업로드 가능합니다.');
                }else if(result.result == "image"){
                    alert('jpg, gif, png 파일만 업로드 가능합니다.')
                }else{
                    let imgSrc = `../lectThumb/${result.savename}`;
                    document.querySelector(".item2 .text-bg-secondary").innerHTML = `<img src="${imgSrc}" alt="" class="rounded thumbnail">`;
                    document.querySelector("#lect_pic_link").value=result.pic_key;
                }

            }
        })
    });
}

function lectThumbDel(targetId){
    
    let data = {pic_key : targetId}
    $.ajax({
        async: false,
        type: "post",
        url: "admin_lecture_thumbDel.php",
        data: data,
        dataType: "json",
        error: function(result){
            alert("이미지 삭제에 실패했습니다.");
        },
        success: function(result){
            if(result.result == "ok"){
            console.log("이미지 삭제 성공");
            }
        }
    })
    
}


function lectDescImport(){
    $("#lect_desc").val($('#summernote').summernote('code'));
}

function lectDescExport(desc){
    document.querySelector("#summernote")?
        $('#summernote').summernote('pasteHTML', desc):
        document.querySelector("#lect_desc").innerHTML = desc;
}

function search(){
    document.querySelector("#searchUiForm button").addEventListener("click", e=>{
        let category = document.querySelector("#searchCategory").value,
            content = document.querySelector("#searchUiForm .search_val").value;

        let data = {
            category: category,
            content: content
        }
        $.ajax({
            async: false,
            type: "post",
            url: "admin_lecture_list_search.php",
            data: data, 
            dataType: "json",
            error: function(){
                alert("error");
            },
            success:function(result){
            }


        })

    })
}

function searchUiSettingInit(){
    let data = {selected: document.querySelector("#searchCategory").value};

    $.ajax({
        async: false,
        type: "post",
        data: data,
        url: "admin_lecture_list_searchUiSetting.php",
        dataType: "html",
        success: function(result){
            document.querySelector("#searchUi").innerHTML = result;
        }
    })
}

function searchUiSetting(){
    document.querySelector("#searchCategory").addEventListener("change", e=>{

        let data = {selected: e.currentTarget.value};

        $.ajax({
            async: false,
            type: "post",
            data: data,
            url: "admin_lecture_list_searchUiSetting.php",
            dataType: "html",
            success: function(result){
                document.querySelector("#searchUi").innerHTML = result;
            }
        })
        document.querySelector("#searchUiForm .search_content").value="";
    });
}
function searchValImport(){
        let v;
        switch(document.querySelector("#searchCategory").value) {
            case "lect_opt" :
                v = [];
                for(i of document.querySelectorAll("#searchUiForm .search_val")){
                    v.push(i.checked? 1: 0);
                }
                break;
            case "lect_cate_sec" :
                v = document.querySelector("#lect_cate_sec").value;
                break;
            default:
                v = document.querySelector("#searchUiForm .search_val").value;
                break;
        }

        document.querySelector("#searchUiForm .search_content").value = v;
}
function searchValExport(){
    switch(document.querySelector("#searchCategory").value){
        case "lect_opt":
            let valArray = (document.querySelector("#searchUiForm .search_content").value).split(","),
                targetArray = document.querySelectorAll("#searchUi input");
                for(let i = 0; i < valArray.length; i++){
                    if(valArray[i] == 1){
                        targetArray[i].checked = true;
                    }
                }
            break;
        case "lect_status":
            let op_idx = document.querySelector("#searchUiForm .search_content").value,
                optionArray = document.querySelectorAll("#searchUi option");
                optionArray[op_idx].selected = true;
            break;

            
        case "lect_cate_sec":
            let sec_key = document.querySelector("#searchUiForm .search_content").value,
                pri_key;
            let data = {sec_key: sec_key};
            $.ajax({
                async: false,
                type: "post",
                url: "admin_lecture_list_searchCateCheck.php",
                data: data,
                dataType: "json",
                success: function(result){
                    pri_key = result;
                    secCate_listUp_process(pri_key);
                }
            });
            document.querySelector(`#lect_cate_pri option[value='${pri_key}']`).selected = true;
            document.querySelector(`#lect_cate_sec option[value='${sec_key}']`).selected = true;
            break;

        default:
            document.querySelector("#searchUiForm .search_val").value = document.querySelector("#searchUiForm .search_content").value;
            break;
    }
}

