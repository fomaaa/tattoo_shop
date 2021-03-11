<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategorySearchModel */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-category-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'parent') ?>

    <?php echo $form->field($model, 'sort') ?>

    <?php echo $form->field($model, 'slug') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
