<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductCategoryModel */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-model-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
