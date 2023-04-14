// for(i of document.querySelectorAll(".td_button button")){
//     i.addEventListener("click", function(){
//         console.log("click test");
//     })
// }



// document.querySelector(".paymentWrap .btn_payment").addEventListener("click", e=>{
//     e.preventDefault();
//     location.href="/kdt_lms/user_payment.html";
// })


function fill_bill(){}
    let checkbox = document.querySelectorAll("tbody input");
    for(i of checkbox){
        i.addEventListener("change", e=>{
            cal_bill();
            checkbox.length == document.querySelectorAll("tbody input:checked").length?
                document.querySelector("#tdCheckbox").checked = true:
                document.querySelector("#tdCheckbox").checked = false;
        });
    }

function cal_bill(){
    let item_selected = document.querySelectorAll("tbody input:checked");
    let sumprice = 0,
        item_selected_value = new Array();

    // item_selected_value = item_selected.map(i=>i.getAttribute("id").replace("checkbox", ""));
    

    for(i of item_selected){
        sumprice += Number(i.closest("tr").querySelector("p.price").dataset.price);
        item_selected_value.push(i.getAttribute("id").replace("checkbox", ""));
    }
    document.querySelector(".paymentWrap .count .input").innerText = item_selected.length > 0 ? `${item_selected.length} 개`: "강의를";
    document.querySelector(".paymentWrap .price .input").innerText = item_selected.length > 0 ? `${sumprice.toLocaleString()} 원`: "선택해주세요.";

    document.querySelector(".paymentWrap input").value = item_selected_value;

    item_selected.length > 0?
        document.querySelector(".paymentWrap .btn_payment").disabled = false:
        document.querySelector(".paymentWrap .btn_payment").disabled = true;

}

function checkboxAllcheck(){
    document.querySelector("#tdCheckbox").addEventListener("click", e=>{
        for(i of document.querySelectorAll("tbody input")){
            i.checked = e.target.checked;
        }
        cal_bill();
    })
}