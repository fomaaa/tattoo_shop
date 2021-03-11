      <main class="pageWrapper">
        <div class="section section--cart section--paddingTopDefault">
          <div class="containerFluid section__inner">
            <div class="page__title">оформление заказа</div>
            <div class="cart">
              <div class="cart__center">
                <div class="orderForm">
                  <form action="/" class="form form--order">
                    <div class="form__inner">
                      <div class="form__groupWrapper">
                        <div class="form__title"> получение </div>
                        <div class="form__grid form__grid--3">
                          <div class="radioButton">
                            <input type="radio" name="delivery" checked>
                            <div class="radioButton__body">
                              <span>курьерская доставка по москве</span>
                              <div class="textBottom">
                                <span class="price price--ruble"><?php echo $delivery; ?></span>
                              </div>
                            </div>
                          </div>
                          <div class="radioButton">
                            <input type="radio" name="delivery">
                            <div class="radioButton__body">
                              <span>самовывоз из магазина в москве</span>
                              <div class="textBottom">
                                <b>бесплатно</b>
                              </div>
                            </div>
                          </div>
                          <div class="radioButton">
                            <input type="radio" name="delivery">
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
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">Имя</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">Фамилия</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">Телефон</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                          </div>
                        </div>
                        <div class="form__groupWrapper">
                          <div class="form__title">адрес</div>
                          <div class="form__group">
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">страна</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">город</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">адрес</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                            <div class="form__field is-required">
                              <label class="label">
                                <span class="label__title">индекс</span>
                              </label>
                              <input type="text" class="input " />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form__groupWrapper">
                        <div class="form__title"> оплата </div>
                        <div class="form__grid form__grid--2">
                          <div class="radioButton">
                            <input type="radio" name="payment" checked>
                            <div class="radioButton__body">
                              <span>онлайн</span>
                            </div>
                          </div>
                          <div class="radioButton">
                            <input type="radio" name="payment">
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
                <div class="cartBox">
                  <form action="/" class="form form--cartBox cartBox__inner">
                    <div class="cartBox__row">
                      <div class="cartBox__title">корзина</div>
                      <div class="cartBox__right">
                        <span class="price price--ruble">8 700</span>
                      </div>
                    </div>
                    <div class="cartBox__row">
                      <div class="cartBox__title">доставка</div>
                      <div class="cartBox__right">
                        <span class="price price--ruble">300</span>
                      </div>
                    </div>
                    <div class="cartBox__row">
                      <div class="cartBox__title">сертификат</div>
                      <div class="cartBox__right">
                        <input type="text" class="input input--codeSale" placeholder="Введите код">
                      </div>
                    </div>
                    <div class="cartBox__row">
                      <div class="cartBox__total">
                        <span class="price price--ruble">9 000</span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>