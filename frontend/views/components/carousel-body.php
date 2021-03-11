<?php use common\models\ProductModel;

?>

<?php if ($products) : ?>
            <div class="carouselBody">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <?php foreach ($products as $product) : ?>
                  <div class="swiper-slide">
                    <div class="card card--good">
                      <?php if ($product->thumbnail_path) : ?>
                      <a href="<?php echo $product->get_url(); ?>" class="card__photo">
                        <img src="<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/265x265" srcset="<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/530x530 2x" alt="<?php echo $product->name; ?>">
                      </a>
                      <?php endif; ?>
                      <div class="card__body">
                        <a href="<?php echo $product->get_url(); ?>" class="card__title"> <?php echo $product->name; ?> </a>
                        <div class="card__bottom">
                          <div class="card__price">
                            <span class="price price--ruble"><?php echo $product->price; ?></span>
                          </div>
                          <div class="card__buttons">
                            <?php if (!Yii::$app->user->isGuest) : ?>
                            <a href="/favorites/action/<?php echo $product->id ?>" class="btn btn--favorite js-favorite-add-item
                              <?php if (ProductModel::is_in_recomended(Yii::$app->user->id ,$product->id)) echo ' is-active' ; ?>">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
                            <?php endif; ?>
                            <form class="form form--addGood" action="/cart/add-item" method="post">
                              <?php if ($product->is_in_cart()) : ?>
                                 <button type="submit" data-title-item="<?php echo $product->name?>" class="btn btn--toCart js-cart-add-item">
                                    <svg class="icon icon-checked">
                                     <use xlink:href="/img/sprite.svg#icon-checked"></use>
                                   </svg>
                                 </button>
                              <?php else : ?>
                                <button type="submit" class="btn btn--toCart js-cart-add-item">
                                  <svg class="icon icon-cart">
                                    <use xlink:href="/img/sprite.svg#icon-cart"></use>
                                  </svg>
                                </button>
                              <?php endif; ?>

                              <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>" class="js-good-value-target">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                 <?php endforeach; ?>

                </div>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-button swiper-button-next"></div>
              </div>
            </div>
<?php endif ?>
