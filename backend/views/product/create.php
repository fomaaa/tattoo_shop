<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */

$this->title = 'Создать товар';
$this->params['breadcrumbs'][] = ['label' => 'Product Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-model-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
