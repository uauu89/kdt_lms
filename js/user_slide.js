/* slide */
  
if(window.innerWidth > (320*4 + 40 + 200)){ // 1520
    slides = 4;
}else if(window.innerWidth > (320*3 + 40 + 200)){ // 1200
    slides = 3;
}else if(window.innerWidth > (320*2 + 40 + 200)){ // 880
    slides = 2;
}else{
    slides = 1;
}

const swiperMain = new Swiper(".swiper_banner", {
    autoplay:{
        delay: 4000
    },
    loop: true,
    speed: 1000
});

const swiperPremium = new Swiper('.swiper_premium', {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
    loop: true,
    speed: 600,
    slidesPerView: slides,
    pagination: {
        el: ".swiper-pagination_premium",
    },
    navigation: {
        nextEl: ".btn_slideNavi_premium.slideNext",
        prevEl: ".btn_slideNavi_premium.slidePrev",
    },
});

const swiperBest = new Swiper('.swiper_best', {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
    loop: true,
    speed: 600,
    slidesPerView: slides,
    pagination: {
        el: ".swiper-pagination_best",
    },
    navigation: {
        nextEl: ".btn_slideNavi_best.slideNext",
        prevEl: ".btn_slideNavi_best.slidePrev",
    },
});

window.addEventListener("resize", ()=>{
    let ww = window.innerWidth;
    if(ww > (320*4 + 40 + 200)){
        swiperPremium.params.slidesPerView = 4;
        swiperBest.params.slidesPerView = 4;
    }else if(ww > (320*3 + 40 + 200)){
        swiperPremium.params.slidesPerView = 3;
        swiperBest.params.slidesPerView = 3;
    }else if(ww > (320*2 + 40 + 200)){
        swiperPremium.params.slidesPerView = 2;
        swiperBest.params.slidesPerView = 2;
    }else{
        swiperPremium.params.slidesPerView = 1;
        swiperBest.params.slidesPerView = 1;
    }
})

