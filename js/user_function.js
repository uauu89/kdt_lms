function insertCart(tf, lect){
    if(tf){
        if(confirm('로그인이 필요한 페이지입니다.\n로그인 페이지로 이동하시겠습니까?')){
            location.href='/kdt_lms/user_login.php';
        }
    }else{
        $.ajax({
            async: false,
            type: "POST",
            data: {
                lect : lect,
                conn_check: true
            },
            url: "/kdt_lms/inc/user_cart_insert.php",
            dataType: "json",
            success: function(result){
                if(result){
                    if(confirm("장바구니에 담았습니다.\n장바구니로 이동하시겠습니까?")){
                        location.href="/kdt_lms/user_my_cart.php";
                    }
                }else if(!result){
                    if(confirm("이미 장바구니에 보관한 강의입니다.\n장바구니로 이동하시겠습니까?")){
                        location.href="/kdt_lms/user_my_cart.php";
                    }
                }else{
                    alert("장바구니 등록에 실패했습니다. 관리자에게 문의해주세요.");
                }
             
            }
        })
    }

}


function del_item(target){
    let targetName = document.querySelector(`#checkbox${target}`).closest("tr").querySelector("h3 a").innerText;
    if(confirm(`선택강의 : ${targetName}\n장바구니에서 삭제할까요?`)){
        $.ajax({
            async: false,
            type: "POST",
            data: {
                lect : target,
                conn_check: true
            },
            url: "/kdt_lms/inc/user_cart_delete.php",
            dataType: "json",
            success: function(result){
                if(result){
                    alert("강의를 목록에서 삭제하였습니다.");
                    document.querySelector(`#tr${target}`).remove();
                    del_lastStep();
                }else{
                    alert("강의 삭제에 실패했습니다. 관리자에게 문의해주세요");
                }
            }
        })
    }
}

function del_itemList(){
    let target_list = new Array();
    for(i of document.querySelectorAll("tbody input:checked")){
        target_list.push(i.getAttribute("id").replace("checkbox", ""));
    }
    if(target_list.length == 0){
        alert("선택된 강의가 없습니다.");
    }else{
    if(confirm(`선택된 강의를 삭제할까요?`)){
        $.ajax({
            async: false,
            type: "POST",
            data: {
                lect : target_list,
                conn_check: true
            },
            url: "/kdt_lms/inc/user_cart_deleteList.php",
            dataType: "json",
            success: function(result){
                for(i of target_list){
                    
                    document.querySelector(`#tr${i}`).remove();
                }
                del_lastStep();
                alert('선택된 강의를 삭제하였습니다.');
            }
        })
    }
    }
}

function del_lastStep(){
    if(!document.querySelector("tbody tr")){
        document.querySelector("tbody").innerHTML = `<tr><td colspan=3 class='text-center'>장바구니에 보관중인 강의가 없습니다.</td></tr>`;
    }
    cal_bill();
}






function usePoint(){
    let havePoint = Number(document.querySelector(".method .havePoint").value);
    let totalPrice = Number(document.querySelector(".bill .totalPrice").value);
    let usePointInput = document.querySelector(".method .input_usePoint"),
        usePoint = Number(usePointInput.value);
    if(usePoint < 0){
        alert("잘못된 값이 입력되었습니다.");
        usePoint = 0;
    }else if(usePoint > havePoint){
        alert("보유한 포인트가 부족합니다.");
        let calHavePoint = (Math.floor(havePoint/10)*10);
        usePoint = calHavePoint > totalPrice ? (Math.floor(totalPrice/10)*10): calHavePoint;
    }else if(usePoint > totalPrice){
        alert("입력하신 포인트가 결제금액을 초과하였습니다.");
        let calUsePoint = (Math.floor(totalPrice/10)*10);
        usePoint = calUsePoint > havePoint ? (Math.floor(havePoint/10)*10): calUsePoint;
    }else{
        usePoint = (Math.floor(usePoint/10)*10);
    }
    usePointInput.value = usePoint;
    
    document.querySelector(".bill .point_input").innerText = Number(usePoint) > 0 ? Number(usePoint).toLocaleString() + " 원": "-";

    let resultPrice = totalPrice - usePoint,
        resultPoint = Math.floor(resultPrice/10);

    document.querySelector(".step2 input[name='actualPrice']").value = resultPrice;
    document.querySelector(".step2 .resultPrice").innerText = resultPrice.toLocaleString() + " 원";

    document.querySelector(".step2 input[name='point_acc']").value = resultPoint;
    document.querySelector(".step2 .resultPoint").innerText = resultPoint.toLocaleString() + " 원";

}



/* 결제수단 선택 시 결제버튼 disabled 제거 */
function methodSelect(){
    document.querySelector(".methodGroup ul").addEventListener("click", e=>{
        document.querySelector(".btn_payment").disabled = false;
    })
}
/* 결제 모달창 종료버튼 */
function modalPayment_close(){
    document.querySelector(".modal_payment_wrap").remove();
    document.querySelector("body").classList.remove("overflow");
}






function modalPayment(){
    document.querySelector("body").classList.add("overflow");

    let actualPrice = document.querySelector(".step2 .resultPrice").innerText;
    let method = document.querySelector(".methodGroup input:checked").value;
    let content;
    switch(method){
        case "credit":
            content = {
                methodh2:"신용/체크카드",
                methodh3:"카드 번호",
                methodContent:"카드 일련번호를 입력해주세요",
            }        
            break;
        case "account":
            content = {
                methodh2:"계좌이체",
                methodh3:"계좌번호",
                methodContent:"계좌번호를 입력해주세요.",
            }        
            break;
        case "phone":
            content = {
                methodh2:"휴대전화",
                methodh3:"핸드폰 번호",
                methodContent:"핸드폰 번호를 입력해주세요.",
            }        
            break;
        case "npay":
            content = {
                methodh2:"네이버페이",
                methodh3:"네이버 로그인",
                methodContent:"네이버 로그인을 해주세요.",
            }        
            break;
        case "kpay":
            content = {
                methodh2:"카카오페이",
                methodh3:"카카오 로그인",
                methodContent:"카카오 로그인을 해주세요.",
            }        
            break;
    }

    document.querySelector(".form").insertAdjacentHTML("beforeend", `<div class="modal_payment_wrap">
    <div class="modal_payment d-flex flex-column gap-5">
        <h2>${content.methodh2}</h2>
        <div>
            <h3>${content.methodh3}</h3>
            <p>${content.methodContent}</p>
            <p>
                <input type="text" name="methodInfo" required>
            </p>
        </div>
        <div>
            <h3>결제 금액</h3>
            <p class="paymentPrice">${actualPrice}</p>
        </div>
        <div class="buttons">
            <input type='hidden' name='conn_check' value='true'>
            <button class="btn btn_payment submit">결제</button>
            <button type="button" class="btn cancel" onclick="modalPayment_close()">취소</button>
        </div>
    </div>
</div>`);
}

/*
function paymentCheck(){
    console.log("ajax");
    $.ajax({
        async: false,
        type: "POST",
        data: {
            payment_item: document.querySelector("input[name='payment_item']").value,
            totalPrice: document.querySelector("input[name='totalPrice']").value,
            actualPrice: document.querySelector("input[name='actualPrice']").value,
            point_use: document.querySelector("input[name='point_use']").value,
            point_acc: document.querySelector("input[name='point_acc']").value,
            payment_method: document.querySelector("input[name='payment_method']:checked").value,
            methodInfo: document.querySelector("input[name='methodInfo']").value
        },
        url: "/kdt_lms/inc/user_payment_check.php",
        dataType: "json",
        
        success: function(result){
            alert("결제되었습니다.");
            location.href="/kdt_lms/user_payment_result.php";
        }
    })
}
*/


function nextRecommend(){
    $.ajax({
        async: false,
        type: "POST",
        data: {data : "null"},
        url: "/kdt_lms/inc/index_nextrecommend.php",
        dataType: "html",
        error: function(){
            console.log("error");
        },
        success: function(nextItem){
            document.querySelector(".recommend figure").innerHTML = nextItem;
        }
    })
}


/* aside */

function check_myCurrentPage(){
    let currentPage = (document.location.href).split("/").pop();
    document.querySelector(`aside nav a[href*="${currentPage}"]`).classList.add("active");
}










/* 결제 모달창 종료버튼 */
function modalQuit_close(){
    document.querySelector(".modal_quit_wrap").remove();
    document.querySelector("body").classList.remove("overflow");
}

function modalQuit(){
    document.querySelector("body").classList.add("overflow");

    document.querySelector("main").insertAdjacentHTML("beforeend", `
    <div class="modal_quit_wrap">
        <div class="modal_quit d-flex flex-column gap-5">
            <h2>회원 탈퇴</h2>
            <form action="/kdt_lms/inc/user_my_modify_quit.php" method="POST" class="buttons">
                <div class='d-flex flex-column gap-3'>
                    <p>회원 탈퇴 시 포인트와 개인 정보가 삭제되며 복구가 불가능합니다.</p>
                    <p>회원 탈퇴를 원하신다면 아래에 <strong>'회원탈퇴'</strong>를 입력해주세요.</p>
                    <p><input type="text" name="quitCheck" required></p>
                </div>
                <div class="buttons">
                    <button class="btn btn_payment submit">회원 탈퇴</button>
                    <button type="button" class="btn cancel" onclick="modalQuit_close()">취소</button>
                </div>
            </form>
        </div>
    </div>`
    );
}


function findPw_check(){
    $.ajax({
        async: false,
        type: "POST",
        data: {
            user_id : document.querySelector("#user_id").value,
            user_name : document.querySelector("#user_name").value,
            user_email : document.querySelector("#user_email").value,
            conn_check : true
        },
        url: "/kdt_lms/inc/user_login_findPw_check.php",
        dataType: "html",
        success: function(result){
            if(!result.trim()){
                location.href='user_login_findPw_noresult.php';   
            }else{
                document.querySelector("form").insertAdjacentHTML("beforeend",`<div class="modal_findPw_wrap">
                <div class="modal_findPw d-flex flex-column gap-5">
                    <h2>비밀번호 확인코드 입력</h2>
                    <div class='d-flex flex-column gap-3'>
                        <p>본인 확인을 위해 확인코드를 입력해주세요.</p>
                        <p>확인코드 : <strong>${result}</strong></p>
                        <p><input type="text" name="checkcode" required></p>
                    </div>
                    <div class="buttons">
                        <button class="btn btn_payment submit">코드 입력</button>
                        <button type="button" class="btn cancel" onclick="modalfindPw_close()">닫기</button>
                    </div>
                </div>
            </div>`);
            }
        }
    })
}

function modalfindPw_close(){
    document.querySelector(".modal_findPw_wrap").remove();
    document.querySelector("body").classList.remove("overflow");
}


function myclassDel(target){
    if(confirm('삭제한 강의를 재수강하고자 할 경우, 다시 결제가 필요합니다.\n내 강의실에서 이 강의를 정말 삭제하시겠습니까?')){
        $.ajax({
            async: false,
            type: "POST",
            data: {
                idx : target,
                conn_check: true
            },
            url: "/kdt_lms/inc/user_my_class_delItem.php",
            dataType: "html",
            success: function(result){
                if(result){
                    alert("강의를 삭제하였습니다.");
                    document.querySelector(`#tr${target}`).remove();
                    if(document.querySelectorAll("tbody > tr").length < 1){
                        document.querySelector("tbody").innerHTML = "<tr><td colspan=2 class='text-center'>수강중인 강의가 없습니다.</td></tr>";
                    }
                }else{
                    alert("강의 삭제에 실패하였습니다.");
                }
            }
        })
    }
}