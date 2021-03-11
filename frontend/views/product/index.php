<?php
/* @var $this yii\web\View */
?>
      <main class="pageWrapper">
        <div class="section section--catalog">
          <div class="containerFluid section__inner">
            <div class="catalog">
              <div class="catalog__fullWidth">
                <h1 class="catalog__title text--center"> Каталог </h1>
                <?php echo \Yii::$app->view->renderFile('@app/views/components/catalog-cards.php', [
                    'categories' => $categories,
                  ]); ?>
              </div>
            </div>
          </div>
        </div>
      </main>
