<?php
/* @var $this yii\web\View */
  use common\models\ProductModel;
  use common\models\ProductCategoryModel;
  use yii\widgets\LinkPager;

  $count = count($categories['main']);
  $cart = \Yii::$app->cart;
?>
      <main class="pageWrapper">
        <div class="section section--catalog">
          <div class="containerFluid section__inner">
            <div class="catalog">
              <div class="catalog__left">
                 <?php echo \Yii::$app->view->renderFile('@app/views/components/main-nav.php', [
                    'categories' => $categories,
                    'currentCategory' => $currentCategory,
                  ]); ?>
              </div>
              <div class="catalog__right">
                <h1 class="catalog__title"> <?php echo $currentCategory['name'] ?> </h1>

                <?php if (isset($categories['sub'][$currentParent['id']])) :  ?>
                <ul class="catalogNav">
                  <?php if (count($categories['sub'][$currentParent['id']]) > 2) :

                  ?>
                  <?php if ($products) : ?>
                    <li class="catalogNav__item">
                      <a href="/catalog/<?php echo $currentParent['slug'] ?>" class="catalogNavCategory <?php if ($currentParent['slug'] == $currentCategory['slug']) echo ' is-active ' ?>">
                        <span class="catalogNavCategory__title">все</span>
                        <span class="catalogNavCategory__count"><?php echo $productsCount['count']; ?></span>
                      </a>
                    </li>
                  <?php endif; ?>

                  <?php endif; ?>
                  <?php foreach ($categories['sub'][$currentParent['id']] as $subcat) :
                  		$thumb = [
                  			'path' => $subcat['thumbnail_path']
						];
                  	?>

                    <?php if ($subcat['count']) :  ?>
                      <li class="catalogNav__item">
                        <a href="<?php echo \Yii::$app->breadcrumbs->getCategoryLink($subcat['id']); ?>" class="catalogNavCategory <?php if ($currentCategory['slug'] == $subcat['slug'] ) echo ' is-active ' ?>">
                          <?php if ($subcat['thumbnail_path']) : ?>
                            <div class="catalogNavCategory__image">
                              <img  src="<?php echo \Yii::$app->helper->getImage($thumb) ?>/90x52" srcset="<?php echo \Yii::$app->helper->getImage($thumb) ?>/165x165" alt="<?php echo $subcat['name'] ?>">
                            </div>
                          <?php endif; ?>
                          <span class="catalogNavCategory__title"><?php echo $subcat['name'] ?></span>
                          <span class="catalogNavCategory__count"><?php echo $subcat['count'] ?></span>
                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php  endif; ?>

                <div class="grid grid--4">
                  <?php if ($products) : ?>
                    <?php foreach ($products as $product) : ?>
                    <div class="grid__item">
                    <div class="card card--good">
                      <?php if ($product->thumbnail_path) : ?>
                      <a href="<?php echo \Yii::$app->breadcrumbs->getProductLink($product); ?>" class="card__photo">
                        <img src="<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/265x265" srcset="<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/530x530	 2x" alt="<?php echo $product->name; ?>">
                      </a>
                      <?php endif; ?>
                      <div class="card__body">
                        <a href="<?php echo \Yii::$app->breadcrumbs->getProductLink($product); ?>" class="card__title"> <?php echo $product->name; ?> </a>
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
                  <?php else : ?>
                    Товары в данной категории отсутствуют
                  <?php endif; ?>
                </div>


                <?php if ($pagination) : ?>
                  <?= LinkPager::widget([
                     'pagination' => $pagination,
                     'hideOnSinglePage' => true,
                     'prevPageLabel' => '&laquo;',
                     'nextPageLabel' => ' &raquo;',

                      'options' => [
                          'tag' => 'div',
                          'class' => 'pagination',
                      ],
                      'linkContainerOptions' => [
                          'tag' => 'div',
                          'class' => 'pagination__item',
                      ],

                      'activePageCssClass' => 'is-active',
                      'disabledPageCssClass' => 'disable',

                  ]) ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </main>
