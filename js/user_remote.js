
/* -------- remote ----------- */

let screenWidth,
    screenHeight,

    pointerX,
    pointerY;

let remoteWidth,
    remoteHeight,
    remoteLeft,
    remoteTop;
    
function calScreenSize(){
    screenWidth = window.innerWidth;
    screenHeight = window.innerHeight;
    
}
window.dispatchEvent(new Event(calScreenSize()));
window.addEventListener("resize", e=>{
    calScreenSize();
})

let remoteContoller = document.querySelector(".userRemote"),
    handler = remoteContoller.querySelector(".handler"),
    remoteBtn = handler.querySelector("button");

let clickSwitch = false,
    m_clickSwitch = false,
    outCheck = false,
    outCheckTimer = true;

handler.addEventListener("mousedown", e=>{
    clickSwitch = true;
    pointerX = e.offsetX;
    pointerY = e.offsetY;
    remoteWidth = remoteContoller.offsetWidth;
    remoteHeight = remoteContoller.offsetHeight;
});

handler.addEventListener("mouseup", e=>{
    clickSwitch = false;
    let attrArray = remoteContoller.getAttribute("style").split(";");
    get_remotePosValue(attrArray);
});

window.addEventListener("mousemove", e=>{
    if(clickSwitch){
        remoteContoller.style.marginRight = `${pointerX}px`;
        remoteContoller.style.marginBottom = `${pointerY}px`;

        x = (screenWidth - event.clientX - remoteWidth) / screenWidth * 100;
        y = (screenHeight - event.clientY - remoteHeight) / screenHeight * 100;

        remoteContoller.style.right = x+"%";
        remoteContoller.style.bottom = y+"%";
    }
});

handler.addEventListener("mouseenter", e=>{
    outCheck = false;
});
handler.addEventListener("mouseout", e=>{
    outCheck = true;
    if(clickSwitch && outCheckTimer){
        outCheckTimer = false;
        setTimeout(function(){
            if(outCheck) clickSwitch = false;
            outCheckTimer = true;
        }, 2000)
    }
});


handler.addEventListener("touchstart", e=>{
    m_clickSwitch = true;

    pointerX = e.offsetX;
    pointerY = e.offsetY;
    remoteWidth = remoteContoller.offsetWidth;
    remoteHeight = remoteContoller.offsetHeight;

});

handler.addEventListener("touchend", e=>{
    m_clickSwitch = false;
    document.body.style.overflow = "";
});


window.addEventListener("touchmove", e=>{
    if(m_clickSwitch){
        document.body.style.overflow = "hidden";

        remoteContoller.style.marginRight = `50px`;
        remoteContoller.style.marginBottom = `25px`;
    
        x = (screenWidth - e.touches[0].clientX - remoteWidth) / screenWidth * 100;
        y = (screenHeight - e.touches[0].clientY - remoteHeight) / screenHeight * 100;

        remoteContoller.style.right = x+"%";
        remoteContoller.style.bottom = y+"%";

    }
});

remoteBtn.addEventListener("click", e=>{
    remoteContoller.classList.toggle("mini");

    remoteContoller.classList.contains("mini")?
        get_remoteMiniValue("remotemini", 1):
        get_remoteMiniValue("remotemini", -1);
})

    /* remote menu */

    let main_li = document.querySelectorAll(".userRemote .mainNav > li");
    for(i of main_li){

        i.addEventListener("click", e=>{
            if(e.currentTarget.classList.contains("active")){
                e.currentTarget.classList.remove("active");
            }else{
                for(d of main_li){
                    d.classList.remove("active");
                }
                e.currentTarget.classList.add("active");
            }

        })
    }

/* remote close */
    let btn_top = document.querySelector(".userRemote .btn_top");

    btn_top.addEventListener("click", e=>{
        window.scrollTo({left:0, top:0, behavior: "smooth"});
    })



/* remote cookie */

function get_remotePosValue(value) {
    let date = new Date();
    date.setDate(date.getDate() + 1);
    document.cookie = `remoteposition=${value};expires=${date.toUTCString()}`;
}

function set_remotePosValue(){ 
    let positionValue;
    for(i of document.cookie.split(";")){
        if(i.includes("remoteposition")){
            positionValue = i.replace("remoteposition=", "");
        }
    };

    if(positionValue){
        while(positionValue.indexOf(",") > 0){
            positionValue=positionValue.replace(",", ";");
        }
        remoteContoller.setAttribute("style", positionValue);
    }
}

function get_remoteMiniValue(name, day){
    let date = new Date();
    date.setDate(date.getDate() + day);
    document.cookie = `${name}=remoteMiniValue;expires=${date.toUTCString()}`;
}

function set_remoteMiniValue() {
    let cookieArr = document.cookie.split(";");
    let _mini = false;
    for (let cookie of cookieArr) {
          if (cookie.search("remotemini") > -1) {
            _mini = true;
            break;
          }
      }
    _mini ? remoteContoller.classList.add("mini"):remoteContoller.classList.remove("mini");
};

set_remotePosValue();
set_remoteMiniValue();
