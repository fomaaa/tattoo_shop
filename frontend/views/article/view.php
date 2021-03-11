<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

      <main class="pageWrapper">
        <div class="breadcrumbs">
          <ul class="breadcrumbsList">
            <li class="breadcrumbsList__item">
              <a href="/page">Главная</a>
            </li>
            <li class="breadcrumbsList__item">
              <a href="/blog">блог </a>
            </li>
            <li class="breadcrumbsList__item">
              <span><?php echo $model->title ?></span>
            </li>
          </ul>
        </div>
        <div class="section section--article">
          <div class="i-content section__inner">
            <article>
              <h1> <?php echo $model->title ?> </h1>
              <div class="date"> <?php echo date('d.m.Y.', $model->published_at)?></div>
              <?php echo $model->body ?>
            
            </article>
            <div class="shareBox">
              <a href="#" onclick="
                  Share.vk(
                  '<?php echo '/blog/' . $model->slug ?>',
                  '<?php echo $model->title; ?>',
                  '<?php echo $model->thumbnail_base_url . str_replace("\\", "/", $model->thumbnail_path) ?>',
                  '<?php //echo //$model->post_excerpt ?>');
                  return false;
                  "  class="shareBox__item">
                <div class="shareBox__icon">
                  <svg class="icon icon-vk2">
                    <use xlink:href="/img/sprite.svg#icon-vk2"></use>
                  </svg>
                </div>
                <div class="shareBox__title"> Поделиться </div>
              </a>
              <a href="#" onclick="
                  Share.facebook(
                  '<?php echo '/blog/' . $model->slug ?>',
                  '<?php echo $model->title; ?>',
                  '<?php echo $model->thumbnail_base_url . str_replace('\\', '/', $model->thumbnail_path) ?>',
                  '<?php //echo //$model->post_excerpt ?>');
                  return false;
                  " class="shareBox__item">
                <div class="shareBox__icon">
                  <svg class="icon icon-fb">
                    <use xlink:href="/img/sprite.svg#icon-fb"></use>
                  </svg>
                </div>
                <div class="shareBox__title"> Поделиться </div>
              </a>
              <a href="#" onclick="
                  Share.twitter(
                  '<?php echo '/blog/' . $model->slug ?>',
                  '<?php //echo //$model->post_excerpt ?>');
                  return false;
                  " class="shareBox__item">
                <div class="shareBox__icon">
                  <svg class="icon icon-tw">
                    <use xlink:href="/img/sprite.svg#icon-tw"></use>
                  </svg>
                </div>
                <div class="shareBox__title"> Поделиться </div>
              </a>
            </div>
          </div>
        </div>
          <?php echo \Yii::$app->view->renderFile('@app/views/components/subscribe-block.php', [
            'subscribe' => $subscribe
          ]); ?>  

      </main>
