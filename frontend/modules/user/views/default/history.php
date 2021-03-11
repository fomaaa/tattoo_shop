<?php 
  use common\models\Orders; 
  use common\models\ProductModel; 

?>
      <main class="pageWrapper">
        <div class="section section--account section--paddingTopDefault">
          <div class="containerFluid section__inner">
            <div class="page__title">личный кабинет</div>
            <div class="page__subtitle">история заказов</div>
            <div class="account">
              <div class="account__left">
                <?php echo \Yii::$app->view->renderFile('@app/modules/user/views/default/account-nav.php', [
                  ]); ?>
              </div>
              <?php if ($orders) :  ?>
              <div class="account__right">
                <div class="tabs tabs--default tabs--alignLeft">
                  <?php if ($statuses && $orders) : ?>
                  <div class="tabsList">
                    <?php if (count($orders) > 1) : ?>
                    <div class="tabsList__item">
                      <a href="#" class="tab1 is-active">все <span class="value"><?php echo count($orders) ?></span></a>
                    </div>
                    <?php endif; ?>
                    <?php foreach ($statuses as $key => $status) : ?>
                    <div class="tabsList__item">
                      <a href="#" class="tab<?php echo $key+2 ?>"><?php echo Orders::getStatus($status['status']) ?> <span class="value"><?php echo $status['count'] ?></span></a>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                  <div class="tabsBox">
                    <?php if (count($orders) > 1) : ?>
                    <div class="tabs__con tabs__con_tab1 is-active">
                      <ul class="cardList">
                          <?php foreach ($orders as $key => $order) : ?>
                            <li class="cardList__item">
                              <div class="card card--historyOrder">
                                <div class="accordion">
                                  <div class="card__head accordion__head">
                                    <div class="card__left">
                                      <div class="card__code">№ <?php echo str_pad($order['id'], 9, '0', STR_PAD_LEFT); ?>  </div>
                                      <div class="card__date"><?= Yii::$app->formatter->asDate($order['created_at'], 'long')?>  </div>
                                    </div>
                                    <div class="card__right">
                                      <div class="card__status"><?php echo Orders::getStatus($order['status']) ?></div>
                                    </div>
                                  </div>
                                  <?php if ($products) : ?>
                                  <div class="card__body accordion__body">
                                    <div class="card__list">
                                      <?php foreach ($products as $product) : ?>   
                                      <?php if ($product['order_id'] ==  $order['id']) : ?> 
                                      <div class="card__row">
                                        <div class="card__left">
                                          <div class="card__photo" style="background-image: url('<?php echo ProductModel::get_the_image_url($product['product_id'], '165x165'); ?>');"></div>
                                          <div class="card__title">
                                            <a target="_blank" href="<?php echo ProductModel::get_the_url($product['product_id']) ?>"><?php echo $product['name'] ?></a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php endif; ?>
                                      <?php endforeach;  ?>
                                  </div>
                                </div>
                                <?php endif; ?>
                              </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php foreach ($statuses as $index => $status) : ?>
                      <div class="tabs__con tabs__con_tab<?php echo $index+2 ?> <?php if (!$index && count($orders) < 2) echo ' is-active ' ?>">
                        <ul class="cardList">
                          <?php foreach ($orders as $key => $order) : ?>
                            <?php if ($order['status'] == $status['status']) : ?>
                            <li class="cardList__item">
                              <div class="card card--historyOrder">
                                <div class="accordion">
                                  <div class="card__head accordion__head">
                                    <div class="card__left">
                                      <div class="card__code">№ <?php echo str_pad($order['id'], 9, '0', STR_PAD_LEFT); ?>  </div>
                                      <div class="card__date"><?= Yii::$app->formatter->asDate($order['created_at'], 'long')?>  </div>
                                    </div>
                                    <div class="card__right">
                                      <div class="card__status"><?php echo Orders::getStatus($order['status']) ?></div>
                                    </div>
                                  </div>
                                  <?php if ($products) : ?>
                                  <div class="card__body accordion__body">
                                    <div class="card__list">
                                      <?php foreach ($products as $product) : ?>   
                                      <?php if ($product['order_id'] ==  $order['id']) : ?> 
                                      <div class="card__row">
                                        <div class="card__left">
                                          <div class="card__photo" style="background-image: url('<?php echo ProductModel::get_the_image_url($product['product_id'], '165x165'); ?>');"></div>
                                          <div class="card__title">
                                            <a target="_blank" href="<?php echo ProductModel::get_the_url($product['product_id']); ?>"><?php echo $product['name'] ?></a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php endif; ?>
                                      <?php endforeach;  ?>
                                    </div>
                                  </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endforeach;  ?>
                  </div>
                </div>
              </div>
              <?php else :  ?>
              <div class="account__right">
                <div class="completed completed--empty">
                  <div class="completed__inner">
                    <div class="completed__icon">
                      <img src="img/completed.svg" alt="" />
                    </div>
                    <div class="completed__title page__title"> К сожалению, ваша история пуста </div>
                    <div class="completed__subtitle"> Посмотрите товары в <a href="/catalog">каталоге</a> или воспользуйтесь <a href="/search">поиском</a>
                    </div>
                    <div class="completed__bottom">
                      <a href="/catalog" class="btn btn--primary btn--lg">
                        <span>перейти в каталог</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>                
              <?php endif; ?>

            </div>
          </div>
        </div>
      </main>