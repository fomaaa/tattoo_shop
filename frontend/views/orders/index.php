<main class="pageWrapper">
    <div class="section section--cart section--paddingTopDefault">
        <div class="containerFluid section__inner">
            <div class="page__title">оформление заказа</div>
            <div class="cart">
                <div class="cart__center">
                    <div class="orderForm">
                        <form action="/orders/checkout" method="POST" class="form form--order">
                            <div class="form__inner">
                                <div class="form__groupWrapper">
                                    <div class="form__title"> получение </div>
                                    <div class="form__grid form__grid--3">
                                        <div class="radioButton">
                                            <input type="radio" name="delivery" value="1" checked>
                                            <div class="radioButton__body">
                                                <span>курьерская доставка по москве</span>
                                                <div class="textBottom">
                                                    <span class="price price--ruble"><?php echo $delivery; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radioButton">
                                            <input type="radio" name="delivery" value="2">
                                            <div class="radioButton__body">
                                                <span>самовывоз из магазина в москве</span>
                                                <div class="textBottom">
                                                    <b>бесплатно</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radioButton">
                                            <input type="radio" name="delivery" value="3">
                                            <div class="radioButton__body">
                                                <span>доставка по россии</span>
                                                <div class="textBottom">
                                                    <span class="price price--ruble">от 300</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form__groupWrapper">
                                        <div class="form__title">контакты</div>
                                        <div class="form__group">
                                            <div class="form__field is-required">
                                                <label class="label">
                                                    <span class="label__title">email</span>
                                                </label>
                                                <input type="text" required name="email" value="<?php echo $user['email'] ?>" class="input " />
                                            </div>
                                            <div class="form__field is-required">
                                                <label class="label">
                                                    <span class="label__title">Имя</span>
                                                </label>
                                                <input type="text" required name="firstname" value="<?php echo $user['firstname'] ?>" class="input " />
                                            </div>
                                            <div class="form__field is-required">
                                                <label class="label">
                                                    <span class="label__title">Фамилия</span>
                                                </label>
                                                <input type="text" required name="lastname" value="<?php echo $user['lastname'] ?>" class="input " />
                                            </div>
                                            <div class="form__field is-required">
                                                <label class="label">
                                                    <span class="label__title">Телефон</span>
                                                </label>
                                                <input type="text" required name="phone" value="<?php echo $user['phone'] ?>" class="input " />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__groupWrapper">
                                      <div class="form__title">адрес</div>
                                      <div class="form__group js-dadata-container">
                                        <div class="form__field is-required">
                                          <label class="label">
                                            <span class="label__title">страна</span>
                                          </label>
                                          <input type="text" name="country" value="<?php echo $user['country'] ?> required class="input js-dadata" data-type="country" />
                                        </div>
                                        <div class="form__field is-required">
                                          <label class="label">
                                            <span class="label__title">Город</span>
                                          </label>
                                          <input type="text" name="city" value="<?php echo $user['city'] ?>"  required class="input js-dadata" data-type="city-settlement" />
                                        </div>
                                        <div class="form__field is-required">
                                          <label class="label">
                                            <span class="label__title">адрес</span>
                                          </label>
                                          <input type="text" name="address" value="<?php echo $user['address'] ?>" required class="input js-dadata" data-type="address" />
                                        </div>
                                        <div class="form__field is-required">
                                          <label class="label">
                                            <span class="label__title">индекс</span>
                                          </label>
                                          <input type="text" name="post_index" value="<?php echo $user['post_index'] ?>" required class="input js-dadata" data-type="postal-code" />
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form__groupWrapper">
                                    <div class="form__title"> оплата </div>
                                    <div class="form__grid form__grid--2">
                                        <!--                           <div class="radioButton">
                            <input type="radio" name="payment" checked>
                            <div class="radioButton__body">
                              <span>онлайн</span>
                            </div>
                          </div> -->
                                        <div class="radioButton">
                                            <input type="radio" name="payment" value="1" checked>
                                            <div class="radioButton__body">
                                                <span>при получении</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form__bottom">
                                <div class="form__rules">
                                    <p> Нажимая на кнопку "Оформить заказ", Вы соглашаетесь с публичной офертой и даете согласие на обработку персональных данных. </p>
                                </div>
                                <div class="form__button">
                                    <button class="btn btn--primary btn--lg" type="submit">оформить заказ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="cart__right">
                    <?php echo \Yii::$app->view->renderFile('@app/views/cart/sidebar.php', [
                      'cart' => \Yii::$app->cart,
                      'delivery' => 300
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</main>
