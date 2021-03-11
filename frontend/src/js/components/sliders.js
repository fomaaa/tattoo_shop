import Swiper from 'swiper';

/*eslint-disable*/

const goodCardSlider = new Swiper('.goodCardSlider .swiper-container', {
  slidesPerView: 'auto',
  watchOverflow: true,
  navigation: {
    nextEl: '.goodCardSlider .swiper-button-next',
    prevEl: '.goodCardSlider .swiper-button-prev'
  }
});


$('.sliderBox')
  .each(function() {
    const self = $(this);
    const $mainSlider = self.find('.sliderBox__main .swiper-container');
    const $thumbSlider = self.find('.sliderBox__thumbs .swiper-container');
    const $thumbsSlides = $thumbSlider.find('.swiper-slide');

    let goodThumbs;
    let goodMain;

    goodThumbs = new Swiper($thumbSlider, {
      observer: true,
      observeParents: true,
      slidesPerView: 'auto',
      slideToClickedSlide: true,
      centeredSlides: true,
      touchRatio: 0.2,
      watchOverflow: true,
      navigation: {
        nextEl: $thumbSlider.parent()
          .find('.swiper-button-next'),
        prevEl: $thumbSlider.parent()
          .find('.swiper-button-prev')
      },
      on: {
        slideChange() {
          goodMain.slideTo(goodThumbs.activeIndex);
        }
      }
    });

    goodMain = new Swiper($mainSlider, {
      observer: true,
      observeParents: true,
      on: {
        init() {
          $thumbsSlides.eq(this.activeIndex)
            .addClass('is-active');
        },
        slideChange() {
          goodThumbs.slideTo(goodMain.activeIndex);
          $goodThumbs.find('.swiper-slide')
            .removeClass('is-active');
          $thumbsSlides.eq(goodMain.activeIndex)
            .addClass('is-active');
        }
      }
    });

    $thumbsSlides.on('click', function() {
      goodMain.slideTo($(this)
        .index($thumbsSlide));
    });
  });

const bannerSlider = new Swiper('.bannerSlider .swiper-container', {
  slidesPerView: 1,
  spaceBetween: 35,
  loop: true,
  loopAdditionalSlides: 5,
  slideToClickedSlide: true,
  pagination: {
    el: '.bannerSlider .swiper-pagination',
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + '</span>';
    }
  }
});

$('.carouselBody')
  .each(function() {
    const self = $(this);

    const carouselSlider = new Swiper(self.find('.swiper-container'), {
      slidesPerView: 5,
      spaceBetween: 20,
      watchOverflow: true,
      navigation: {
        nextEl: self.find('.swiper-button-next'),
        prevEl: self.find('.swiper-button-prev')
      }
    });
  });

const blogSlider = new Swiper('.blogCards .swiper-container', {
  slidesPerView: 4,
  watchOverflow: true,
  navigation: {
    nextEl: $('.blogCards .swiper-button-next'),
    prevEl: $('.blogCards .swiper-button-prev')
  }
});
