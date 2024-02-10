import Swiper from 'swiper/bundle';

const autoplay = {
  delay: 3250,
  disableOnInteraction: false,
  pauseOnMouseEnter: true
};

export const homeHeadSlider = new Swiper('#home-head-slider', {
  effect: "fade",
  loop: true,
  spaceBetween: 16,
  centeredSlides: true,
  autoplay
});

export const productsSwiper = new Swiper('.swiper-products', {
  slidesPerView: 1.25,
  spaceBetween: 16,
  /*
  loop: true,
  autoplay,
  */
  breakpoints: {
    576: {
      slidesPerView: 2.25,
    },
    768: {
      slidesPerView: 3.15,
    },
    1024: {
      slidesPerView: 3.25,
    },
    1240: {
      slidesPerView: 4.15,
    },
  },
  navigation: {
    nextEl: '.swiper-btn-next',
    prevEl: '.swiper-btn-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  }
});