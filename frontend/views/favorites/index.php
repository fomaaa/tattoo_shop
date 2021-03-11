  <?php 
  use common\models\ProductModel;
  // echo '<pre>';
  // print_r($categories);

  ?>
      <main class="pageWrapper">
        <div class="section section--favorites section--paddingTopDefault">
          <div class="containerFluid section__inner">
            <div class="page__title">Избранное</div>
            <div class="filterGrid">
              <div class="filterGridNav">
                <div class="filterGridNav__item">
                  <a href="#" class="tab1 is-active" data-filter="*">все <span class="value"><?php echo count($products); ?></span></a>
                </div>
                <?php if ($categories) : ?>
                  <?php foreach ($categories as $key => $category) : ?>
                    <div class="filterGridNav__item">
                      <a href="#" class="tab2" data-filter=".<?php echo $category['slug'] ?>"><?php echo $category['name'] ?><span class="value"><?php echo $category['count'] ?></span> </a>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <?php if ($products) : ?>
              <div class="filterGridBody">
                <?php foreach ($products as $key => $product) : ?>
                <div class="filterGridBody__item <?php echo $product->get_parent_category_slug(); ?>">
                  <div class="card card--good">
                    <?php if ($product->thumbnail_path) : ?>
                      <a href="<?php echo $product->get_url(); ?>" class="card__photo">
                        <img src="<?php echo $product->thumbnail_base_url . $product->thumbnail_path ?>" srcset="" alt="<?php echo $product->name; ?>">
                      </a>
                    <?php endif; ?>
                    <div class="card__body">
                      <a href="<?php echo $product->get_url(); ?>" class="card__title"> <?php echo $product->name ?> </a>
                      <div class="card__bottom">
                        <div class="card__price">
                          <span class="price price--ruble"><?php echo $product->price ?></span>
                        </div>
                        <div class="card__buttons">
                            <a href="/favorites/action/<?php echo $product->id ?>" class="btn btn--favorite js-favorite-add-item 
                              <?php if (ProductModel::is_in_recomended(Yii::$app->user->id ,$product->id)) echo ' is-active' ; ?>">
                              <svg class="icon icon-heart">
                                <use xlink:href="/img/sprite.svg#icon-heart"></use>
                              </svg>
                            </a>
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
              <?php endif; ?>
            </div>
          </div>
        </div>
      </main>