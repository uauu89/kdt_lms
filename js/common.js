let __dis_link = document.querySelectorAll(".__dis_link");
for(let i of __dis_link){
    i.addEventListener("click", e=> e.preventDefault());
}


let mainMenu = document.querySelectorAll("nav > ul > li"),
    subMenu = document.querySelectorAll(".submenu a");


for(let i of mainMenu){
    i.addEventListener("click", e=>{
        for(j of mainMenu){j.classList.remove("active");}
        e.currentTarget.classList.add("active");
    })
}
for(let i of subMenu){
    i.addEventListener("click", e=>{
        for(j of subMenu){j.classList.remove("active");}
        e.currentTarget.classList.add("active");
    })
}

// 접속한 페이지 하이라이트

function check_currentPage(){
    let currentPage = ((document.location.href).split("/").pop()).split(".")[0],
        mainmenuUrl = (currentPage.replace("admin_", "")).split("_")[0];
    let targetMainmenu = document.querySelector(`nav li.${mainmenuUrl}`);
        targetSubmenu = document.querySelector(`nav a[href*="${currentPage}"]`);

    if(targetMainmenu){targetMainmenu.classList.add("active");}
    if(targetSubmenu){
        targetSubmenu.classList.add("active");
    }else{
        if(mainmenuUrl=="lecture"){
            document.querySelector("nav a[href='admin_lecture_list.php']").classList.add("active");
        }
    }
}
check_currentPage();

// 메뉴 확장/축소
function setCookie(name, value, day) {
    let date = new Date();
    date.setDate(date.getDate() + day);
    document.cookie = `${name}=${value};expires=${date.toUTCString()}`;
}
function checkCookie(name) {
    let cookieArr = document.cookie.split(";");
    let _mini = false;
    for (let cookie of cookieArr) {
          if (cookie.search(name) > -1) {
            _mini = true;
            break;
          }
      }
    _mini ?_header.classList.add("mini"):_header.classList.remove("mini");
}

let _header = document.querySelector("header");
let btn_asideonoff = document.querySelector("nav button");

btn_asideonoff.addEventListener("click", e=>{
    _header.classList.toggle("miniTrigger");
    _header.classList.contains("miniTrigger")?
        setCookie("header_close", "now header close", 1):
        setCookie("header_close", "now header close", -1);
    checkCookie("header_close");
});
checkCookie("header_close");

for(let i of document.cookie.split(";")){
    if(i.search("header_close") > -1){
        _header.classList.add("miniTrigger");
    }
}
