<?php 
	$delivery  = 300; 
  $products = $cart->getItems();
 ?>
      <main class="pageWrapper">
        <div class="js-cartPage__content <?php if (!$products) echo ' hidden ' ; ?>">
          <div class="section section--cart section--paddingTopDefault">
            <div class="containerFluid section__inner">
              <div class="page__title">Корзина</div>
              <div class="cart">
                <div class="cart__center">
                    <?php echo \Yii::$app->view->renderFile('@app/views/cart/items.php', [
                      'cart' => $cart,
                      'products' => $products

                    ]); ?>
                  <div class="cartBottom">
                    <a href="/order" class="btn btn--primary btn--lg">Перейти к оформлению</a>
                  </div>
                </div>
                <div class="cart__right">
                    <?php echo \Yii::$app->view->renderFile('@app/views/cart/sidebar.php', [
                      'cart' => $cart,
                      'delivery' => 300
                    ]); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="js-cartPage__empty <?php if ($products) echo ' hidden ' ; ?>">
          <div class="section section--cart section--paddingTopDefault">
            <div class="containerFluid section__inner">
              <div class="completed completed--empty">
                <div class="completed__inner">
                  <div class="completed__icon">
                    <img src="img/completed.svg" alt="" />
                  </div>
                  <div class="completed__title page__title"> К сожалению, ваша корзина пуста </div>
                  <div class="completed__subtitle"> Посмотрите товары в каталоге или воспользуйтесь поиском </div>
                  <div class="completed__bottom">
                    <a href="/catalog" class="btn btn--primary btn--lg">
                      <span>перейти в каталог</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>







<!--         <div class="section section--carousel">
          <div class="containerFluid section__inner">
            <div class="page__title"> С этими товарами покупают </div>
            <div class="carouselBody">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Foxxx HANDPOKE Pen Steel </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Foxxx HANDPOKE Pen Steel </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Блок питания Foxxx Irons Жук White Storm </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Foxxx HANDPOKE Pen Steel </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <a href="#" class="card__photo">
                        <img src="img/carousel/good_item1.jpg" srcset="img/carousel/good_item1@2x.jpg 2x" alt="ALT DESCRIPTION">
                      </a>
                      <div class="card__body">
                        <a href="#" class="card__title"> Foxxx HANDPOKE Pen Steel </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble">4 500</span>
                          </div>
                          <div class="card__buttons">
                            <a href="http://www.mocky.io/v2/5d153ad32f00005200c4f6ad" class="btn btn--favorite js-favorite-add-item">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <form class="form form--addGood" action="http://www.mocky.io/v2/5d1535b32f00004da5c4f699" method="post">
                              <button type="submit" class="btn btn--toCart js-cart-add-item">
                                <svg class="icon icon-cart">
                                  <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                </svg>
                              </button>
                              <input type="hidden" name="product_id" value="2986" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-button swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div> -->
      </main>