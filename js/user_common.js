let __dis_link = document.querySelectorAll(".__dis_link");

for(let i of __dis_link){
    i.addEventListener("click", e=> e.preventDefault());
}

let hNav = document.querySelector("header nav"),
    hBtn = hNav.querySelector("button"),
    mainMenu = hNav.querySelectorAll(".mainmenu > li");
let my_aside = document.querySelector("aside");


hBtn.addEventListener("click", e=>{
    // e.currentTarget.classList.toggle("active");
    document.querySelector("body").classList.toggle("mOverflow");
    hNav.classList.toggle("active");
    if(my_aside){my_aside.classList.remove("mActive");};
    
});

for(let i of mainMenu){
    i.addEventListener("click", e=>{
        for(let j of mainMenu){
            j.classList.remove("mActive");
        }
        e.currentTarget.classList.add("mActive");
    })
}



if(my_aside){
    my_aside.querySelector(".btn_mAside").addEventListener("click", e=>{
        my_aside.classList.toggle("mActive");
        hNav.classList.remove("active");
    });
};
