<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetCarouselItem
 * @var $form  yii\bootstrap\ActiveForm
 */

?>

<?php $form = ActiveForm::begin() ?>

<?php echo $form->errorSummary($model) ?>

<?php echo $form->field($model, 'image')->widget(
    \trntv\filekit\widget\Upload::class,
    [
        'url' => ['/file/storage/upload'],
    ]
) ?>

<?php echo $form->field($model, 'order')->textInput() ?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => 1024]) ?>

<?php echo $form->field($model, 'caption')->textInput(['maxlength' => 1024]) ?>

<?php echo $form->field($model, 'link')->textInput(['maxlength' => 1024]) ?>

<?php echo $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

<div class="form-group">
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success' ]) ?>
</div>

<?php ActiveForm::end() ?>
