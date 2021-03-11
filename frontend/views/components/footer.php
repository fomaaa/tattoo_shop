<footer class="footer">
        <div class="containerFluid footer__inner">
          <div class="footer__column footer__column--left">
            <div class="footer__top">
              <div class="copyright">
                <p>© 2017-2019 Tattoopro.ru</p>
                <p>Все права защищены.</p>
              </div>
            </div>
            <div class="footer__bottom">
              <a href="#" class="btn btn--arrowRight">
                <span>написать нам</span>
                <svg class="icon icon-arrow_right">
                  <use xlink:href="img/sprite.svg#icon-arrow_right"></use>
                </svg>
              </a>
            </div>
          </div>
          <div class="footer__column footer__column--center">
            <nav class="nav nav--primary">
              <ul class="menu js-splitter" data-columns="2">
                <li class="menu__item">
                  <a href="#">о нас</a>
                </li>
                <li class="menu__item">
                  <a href="#">обратная связь</a>
                </li>
                <li class="menu__item">
                  <a href="#">политика конфиденциальности</a>
                </li>
                <li class="menu__item">
                  <a href="#">возрат товара</a>
                </li>
                <li class="menu__item">
                  <a href="#">доставка</a>
                </li>
                <li class="menu__item">
                  <a href="#">карта сайта</a>
                </li>
                <li class="menu__item">
                  <a href="#">сертификаты</a>
                </li>
                <li class="menu__item">
                  <a href="#">закладки</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="footer__column footer__column--right">
            <ul class="socialsList">
              <li class="socialsList__item">
                <a href="#" class="btn btn--arrowRight btn--arrowRightIcon">
                  <svg class="icon icon-inst">
                    <use xlink:href="img/sprite.svg#icon-inst"></use>
                  </svg>
                  <span>мы в инстаграме</span>
                  <svg class="icon icon-arrow_right">
                    <use xlink:href="img/sprite.svg#icon-arrow_right"></use>
                  </svg>
                </a>
              </li>
              <li class="socialsList__item">
                <a href="#" class="btn btn--arrowRight btn--arrowRightIcon">
                  <svg class="icon icon-vk">
                    <use xlink:href="img/sprite.svg#icon-vk"></use>
                  </svg>
                  <span>мы вконтакте</span>
                  <svg class="icon icon-arrow_right">
                    <use xlink:href="img/sprite.svg#icon-arrow_right"></use>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
    <!-- END content -->
    <script>
      var locationCoords = {
        zoom: 14,
        placemarks: [
        {
          lat: 55.792073,
          lng: 37.575953,
          caption: 'Проспект Мира, 19с1, офис 38 ',
          text: 'TATTOOPRO, <br>Проспект Мира, 19с1, офис 38 <br>тел. 8 800 707-16-40',
        }]
      };

    </script>
    <!-- BEGIN scripts -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>" type="text/javascript"></script>
    <script src="/js/build/vendor.js"></script>
    <script src="/js/build/app.js"></script>
    <script src="/custom/app.js"></script>
    <!-- END scripts -->
  </body>
</html>
<?php $this->endContent() ?>
