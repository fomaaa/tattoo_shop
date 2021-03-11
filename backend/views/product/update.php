<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */

$this->title = 'Редактирование товара: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование товара';
?>
<div class="product-model-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'seo' => $seo
    ]) ?>

</div>
