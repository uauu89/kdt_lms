function inputClear(){
    let targetInput = document.querySelectorAll("input");
    for(i of targetInput){
        i.addEventListener("click", e=>{
            e.currentTarget.value="";
            e.currentTarget.setAttribute("class", "form-control inputStyle");
        })
    } 
}


function validation_id_create(){
    let input_userId = document.querySelector("#user_id"),
        input_userId_checkBtn =  document.querySelector("button.idcheck");

        input_userId.addEventListener("blur", e=>{
            !e.currentTarget.value?
                e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty"):
                e.currentTarget.setAttribute("class", "form-control inputStyle needCheck");
        });
        
        input_userId_checkBtn.addEventListener("click", e=>{
            if(!input_userId.value){
                input_userId.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty");
            }else{
                $.ajax({
                    async: false,
                    type: "POST",
                    data: {id : input_userId.value},
                    url: "inc/user_login_create_dupcheck.php",
                    dataType: "json",
                    error: function(){
                        console.log("error");
                    },
                    success: function(exist){
                        exist?
                            input_userId.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_exist"):
                            input_userId.setAttribute("class", "form-control inputStyle inputDone");
                    }
                })
            }
        })
}

function validation_id_find(){
    let input_userId = document.querySelector("#user_id");
        input_userId.addEventListener("blur", e=>{
            !e.currentTarget.value?
                e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty"):
                e.currentTarget.setAttribute("class", "form-control inputStyle inputDone");
        });
}


function validation_pw(){
    let input_userPw = document.querySelector("#user_pw"),
        input_userPwCheck = document.querySelector("#user_pw_check");

    input_userPw.addEventListener("blur", e=>{
        if(!e.currentTarget.value){
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty");
        }else if(input_userPwCheck.value){
            pwMatchCheck();        
        }else{
            e.currentTarget.setAttribute("class", "form-control inputStyle");
        }
    })

    input_userPwCheck.addEventListener("blur", e=>{
        if(!input_userPw.value){
            input_userPw.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty");
        }else if(!e.currentTarget.value){
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty");
        }else{
            pwMatchCheck();
        }
    });

    function pwMatchCheck(){
        if(input_userPw.value == input_userPwCheck.value){
            input_userPw.setAttribute("class", "form-control inputStyle inputDone");
            input_userPwCheck.setAttribute("class", "form-control inputStyle inputDone");
        }else{
            input_userPw.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_match");
            input_userPwCheck.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_match");
        }
    }


}



function validation_name(){
    let input_userName = document.querySelector("#user_name");
    
    input_userName.addEventListener("blur", e=>{
        !e.currentTarget.value?
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty"):
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone");
    });
}




function validation_mail(){
    let input_userMail = document.querySelector("#user_email");
    let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    input_userMail.addEventListener("blur", e=>{
        if(!e.currentTarget.value){
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_empty");
        }else if(!regex.test(e.currentTarget.value)){
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone inputWrong inputWrong_format");
        }else{
            e.currentTarget.setAttribute("class", "form-control inputStyle inputDone");
        }
    })
}

function submit_check(){
    let btn_sign = document.querySelector("form .btn_submit");
    let inputCount = document.querySelectorAll("form .inputStyle").length;
    
    for(i of document.querySelectorAll(".inputStyle")){
        i.addEventListener("blur", e=>{
            if(document.querySelectorAll(".inputDone").length == inputCount && document.querySelectorAll(".inputWrong").length == 0){
                btn_sign.removeAttribute("disabled");
            }else{
                btn_sign.setAttribute("disabled", true);
            }
    
        })
    }
}


/*

var str = "...";

 ** test 내장함수 

//공백만 입력된 경우
var blank_pattern = /^\s+|\s+$/g;
if(str.replace(blank_pattern, '' ) == "" ){
    alert('공백만 입력되었습니다.');
}

//문자열에 공백이 있는 경우
var blank_pattern = /[\s]/g;
if( blank_pattern.test(str) == true){
    alert('공백이 입력되었습니다.');
}

//특수문자가 있는 경우
var special_pattern = /[`~!@#$%^&*|\\\'\";:\/?]/gi;
if(special_pattern.test(str) == true){
    alert('특수문자가 입력되었습니다.');
}

//공백 혹은 특수문자가 있는 경우
if(str.search(/\W|\s/g) > -1){
    alert( '특수문자 또는 공백이 입력되었습니다.');
}

*/