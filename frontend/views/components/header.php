<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Главная страница</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="theme-color" content="#fff" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" media="all" href="/css/app.css" />
    <link rel="stylesheet" media="all" href="custom/style.css" />
    <meta name="instagram-user-id" content="1989375575" />
    <meta name="instagram-client-id" content="50516e77200b4ba2865e82161ff2ca83" />
    <meta name="instagram-access-token" content="1989375575.1677ed0.0e33dd249da14c8ebaf96d7cb178f5b2" />
    <meta name="instagram-photos-limit" content="5" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:creator" content="" />
    <meta name="twitter:image" content="" />
    <!-- Open Graph data -->
    <meta property="og:title" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <meta property="og:site_name" content="" />
    <meta property="fb:admins" content="" />
    <?php $this->head() ?>
    <?php $this->registerCsrfMetaTags() ?>
  </head>
  <body class="">
    <!-- BEGIN content -->
    <div class="out">
      <header class="header">
        <div class="topBar">
          <div class="containerFluid">
            <div class="topBar__inner">
              <div class="topBar__left">
                <div class="topBar__phone">
                  <a href="tel:8800707-16-40"> 8 800 707-16-40 </a>
                </div>
              </div>
              <div class="topBar__center">
                <ul class="topBar__links">
                  <li>
                    <a href="#">доставка</a>
                  </li>
                  <li>
                    <a href="#">оплата</a>
                  </li>
                </ul>
                <div class="topBar__timeTable">
                  <span>пн-вс</span>
                  <span>10:00-20:00</span>
                </div>
                <ul class="topBar__links">
                  <li>
                    <a href="#">мы на карте</a>
                  </li>
                  <li>
                    <a href="#">контакты</a>
                  </li>
                </ul>
              </div>
              <div class="topBar__right">
                <a href="#" class="btn btn--profile">
                  <svg class="icon icon-account">
                    <use xlink:href="img/sprite.svg#icon-account"></use>
                  </svg>
                  <span>личный кабинет</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="containerFluid">
          <div class="header__inner">
            <div class="header__top">
              <a href="/" class="logo">
                <img src="img/tatoopro_logo_2.png" alt="ТатуПро">
              </a>
            </div>
            <div class="header__bottom">
              <div class="header__left">
                <a href="#" class="btn btn--catalog">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.5px" height="45.5px">
                    <path fill-rule="evenodd" fill="rgb(252, 79, 47)" d="M22.500,0.000 C34.926,0.000 45.000,10.074 45.000,22.500 C45.000,34.926 34.926,45.000 22.500,45.000 C10.074,45.000 -0.000,34.926 -0.000,22.500 C-0.000,10.074 10.074,0.000 22.500,0.000 Z" />
                    <path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,22.000 L33.000,22.000 L33.000,23.000 L12.000,23.000 L12.000,22.000 Z" />
                    <path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,29.000 L33.000,29.000 L33.000,30.000 L12.000,30.000 L12.000,29.000 Z" />
                    <path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,15.000 L33.000,15.000 L33.000,16.000 L12.000,16.000 L12.000,15.000 Z" />
                  </svg>
                  <span>весь каталог</span>
                </a>
              </div>
              <div class="header__center">
                <div class="header__search">
                  <form action="/" class="form form--searchLine">
                    <input type="text" name="search" placeholder="поиск">
                    <button class="btn btn--glass" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="69px" height="69px">
                        <defs>
                          <filter filterUnits="userSpaceOnUse" id="Filter_0" x="0px" y="0px" width="69px" height="69px">
                            <feOffset in="SourceAlpha" dx="0" dy="2" />
                            <feGaussianBlur result="blurOut" stdDeviation="3.162" />
                            <feFlood flood-color="rgb(0, 0, 0)" result="floodOut" />
                            <feComposite operator="atop" in="floodOut" in2="blurOut" />
                            <feComponentTransfer>
                              <feFuncA type="linear" slope="0.16" />
                            </feComponentTransfer>
                            <feMerge>
                              <feMergeNode />
                              <feMergeNode in="SourceGraphic" />
                            </feMerge>
                          </filter>
                        </defs>
                        <g filter="url(#Filter_0)">
                          <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M34.500,10.000 C46.926,10.000 57.000,20.074 57.000,32.500 C57.000,44.926 46.926,55.000 34.500,55.000 C22.074,55.000 12.000,44.926 12.000,32.500 C12.000,20.074 22.074,10.000 34.500,10.000 Z" />
                        </g>
                        <path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M34.375,20.875 C40.726,20.875 45.875,26.080 45.875,32.500 C45.875,38.920 40.726,44.125 34.375,44.125 C28.024,44.125 22.875,38.920 22.875,32.500 C22.875,26.080 28.024,20.875 34.375,20.875 Z" />
                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M40.703,20.875 C43.698,20.875 46.125,23.302 46.125,26.297 C46.125,29.291 43.698,31.719 40.703,31.719 C37.709,31.719 35.281,29.291 35.281,26.297 C35.281,23.302 37.709,20.875 40.703,20.875 Z" />
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
              <div class="header__right">
                <div class="header__favorites">
                  <a href="#" class="btn btn--favorite btn--lg">
                    <span class="btn__icon">
                      <svg class="icon icon-heart">
                        <use xlink:href="img/sprite.svg#icon-heart"></use>
                      </svg>
                    </span>
                    <span class="badge">14</span>
                  </a>
                </div>
                <div class="header__cartMini">
                  <a href="javascript:void(0);" class="btn btn--cart js-toggleCartMini">
                    <span class="btn__title">корзина</span>
                    <span class="badge badge--circle" style="background-color: #4cd964;"> 15 </span>
                  </a>
                  <div class="cartMini">
                    <div class="cartMini__head">
                      <a href="#" class="cartMini__title"> Корзина <span>15</span>
                      </a>
                      <a href="javascript:void(0);" class="cartMini__close">
                        <svg class="icon icon-close">
                          <use xlink:href="img/sprite.svg#icon-close"></use>
                        </svg>
                      </a>
                    </div>
                    <div class="cartMini__body" data-simplebar>
                      <div class="cartMini__container">
                        <ul class="cartMini__list">
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="card card--goodMini">
                              <a href="#" class="card__link"></a>
                              <div class="card__left">
                                <div class="card__photo" style="background-image: url('img/carousel/good_item1.jpg');"></div>
                                <div class="card__quantity">
                                  <div class="quantity">
                                    <div class="quantity__control quantity__control--minus minus">
                                      <svg class="icon icon-minus">
                                        <use xlink:href="img/sprite.svg#icon-minus"></use>
                                      </svg>
                                    </div>
                                    <input type="text" class="quantity__value" value="1" />
                                    <div class="quantity__control quantity__control--plus plus">
                                      <svg class="icon icon-plus">
                                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card__right">
                                <div class="card__title">Foxxx HANDPOKE Pen Steel</div>
                                <div class="card__price">
                                  <span class="price price--ruble">2 500</span>
                                </div>
                                <a href="javascript:void(0);" class="card__remove">
                                  <svg class="icon icon-close">
                                    <use xlink:href="img/sprite.svg#icon-close"></use>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="cartMini__bottom">
                      <div class="cartMini__top">
                        <div class="cartMini__total">
                          <span class="price price--ruble">8 700</span>
                        </div>
                        <div class="cartMini__reset">
                          <a href="#" class="btn btn--link btn--linkGray"> Очистить корзину </a>
                        </div>
                      </div>
                      <div class="cartMini__bottom">
                        <a href="#" class="btn btn--primary"> Перейти к оформлению </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
