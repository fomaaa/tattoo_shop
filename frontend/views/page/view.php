<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
?>

      <main class="pageWrapper">
        <div class="section section--staticBlock section--paddingTopDefault">
          <div class="container section__inner">
            <div class="staticBlock">
              <div class="page__title">
               <h1><?php echo $model->title ?></h1>
              </div>
              <article>
                <?php echo $model->body ?>
              </article>
            </div>
          </div>
        </div>
      </main>