
// document.querySelector(".swiper1").addEventListener("mouseover", function(){
//     swiper1.autoplay.stop();
// });
// document.querySelector(".swiper1").addEventListener("mouseleave", function(){
//     swiper1.autoplay.start();
// })

// document.querySelector("swiper-pagination1").addEventListener("click", function(){
//     swiper1.autoplay.start();
// })







// 

function func_category(){
    let selectBoxes = document.querySelectorAll(".style_selectBox");
    for(i of selectBoxes){
        i.addEventListener("click", e=>{
            if(e.currentTarget.classList.contains("click")){
                e.currentTarget.classList.remove("click");
            }else{
                for(j of selectBoxes){
                    j.classList.remove("click");
                }
                e.currentTarget.classList.add("click");
            }
        })
    }
}

function func_subcategory(__this){
    let targetValue = __this.closest("li").querySelector("label").innerText;
    __this.closest(".selectBoxWrap").querySelector(".style_selectBox span").innerText = targetValue;
    render_subcategory(__this.value);
        document.querySelector("#prim_key").value=__this.value;
        document.querySelector("#sec_key").value=0;
        
        ajax_lectureRender();
    // }
    document.querySelector(".style_selectBox.click").classList.remove("click");
}

function render_subcategory(key){
    $.ajax({
        async: false,
        type: "POST",
        data: {prim_key : key},
        url: "/kdt_lms/inc/user_classlist_secCate.php",
        dataType: "html",
        success: function(result){
            document.querySelector(".style_selectBox.cate_sec + .selectOption").innerHTML = result;
            document.querySelector(".style_selectBox.cate_sec span").innerText = "전체";
            
        }
    })

}

function func_sec_subcategory(__this){
    let targetValue = __this.closest("li").querySelector("label").innerText;
    __this.closest(".selectBoxWrap").querySelector(".style_selectBox span").innerText = targetValue;
    document.querySelector(".style_selectBox.click").classList.remove("click");
        document.querySelector("#sec_key").value=__this.value;
        // document.querySelector("#pagenation").value=0;
        ajax_lectureRender();
}



function ajax_lectureRender(){
    document.querySelector("#pagenation").value=0;
    $.ajax({
        async: false,
        type: "POST",
        data: {
            prim_key : document.querySelector("#prim_key").value,
            sec_key : document.querySelector("#sec_key").value,
            opt_prem : document.querySelector("#opt_prem").value,
            opt_repre : document.querySelector("#opt_repre").value,
            opt_begin : document.querySelector("#opt_begin").value,
            opt_free : document.querySelector("#opt_free").value,
            sort_option : document.querySelector("input[name='sortOption']:checked").value,
            adOrder : document.querySelector("#adOrder").value,
            pagenation : document.querySelector("#pagenation").value,
        },
        url: "/kdt_lms/inc/user_classlist_lectureRender.php",
        dataType: "html",
        success: function(result){
            document.querySelector("div.sorted_list").innerHTML = result;
        }
    })
}

function func_optionList(){
    for(i of document.querySelectorAll(".optionList input")){
        i.addEventListener("change", e=>{
            e.currentTarget.value = (Number(e.currentTarget.value)+1)%2;
            ajax_lectureRender();
        })
    }
}
function func_orderOption(){
    let selectOption = document.querySelector(".sortingList");
    for(i of selectOption.querySelectorAll("input[name='sortOption']")){
        i.addEventListener("change", e=>{
            let TargetText = e.currentTarget.closest("li").querySelector("label").innerText;
            e.currentTarget.closest(".selectBoxWrap").querySelector(".sorting").classList.remove("click");
            e.currentTarget.closest(".selectBoxWrap").querySelector(".sorting span").innerText = TargetText;
            ajax_lectureRender();
            // console.log(document.querySelector("input[name='sortOption']:checked").value);
        })
    }
}
function func_adOrder(){
    let sortBtnWrap = document.querySelector(".btn_adOrderWrap");
    sortBtnWrap.querySelector(".btn_adOrder").addEventListener("click", e=>{
        document.querySelector(".selectOption").classList.remove("click");
        e.currentTarget.classList.toggle("asc");
        sortBtnWrap.querySelector("#adOrder").value = (Number(sortBtnWrap.querySelector("#adOrder").value)+1)%2;
        ajax_lectureRender();
    })
}

function func_more(__this){
    document.querySelector("#pagenation").value++;
    __this.closest(".moreWrap").remove();
    $.ajax({
        async: false,
        type: "POST",
        data: {
            prim_key : document.querySelector("#prim_key").value,
            sec_key : document.querySelector("#sec_key").value,
            opt_prem : document.querySelector("#opt_prem").value,
            opt_repre : document.querySelector("#opt_repre").value,
            opt_begin : document.querySelector("#opt_begin").value,
            opt_free : document.querySelector("#opt_free").value,
            sort_option : document.querySelector("input[name='sortOption']:checked").value,
            adOrder : document.querySelector("#adOrder").value,
            pagenation : document.querySelector("#pagenation").value,
        },
        url: "/kdt_lms/inc/user_classlist_lectureRender.php",
        dataType: "html",
        success: function(result){
            // console.log(result);
            document.querySelector("div.sorted_list").insertAdjacentHTML("beforeend", result);
        }
    })
}