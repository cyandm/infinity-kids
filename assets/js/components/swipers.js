import Swiper from 'swiper/bundle';

export const homeHeadSlider = new Swiper('#home-head-slider', {
  effect: "fade",
  loop: true,
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true
  }
});
