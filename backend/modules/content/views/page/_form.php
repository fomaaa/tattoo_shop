<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Page
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
<div class="nav-tabs-custom margin-minus-10 nav-tabs-in">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#contentPage" data-toggle="tab">Настройки контента</a>
        </li>
        <li><a href="#seo" data-toggle="tab">Настройки SEO</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="contentPage">
            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'body')->widget(
                \yii\imperavi\Widget::class,
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
                    ],
                ]
            ) ?>

            <?php //echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="tab-pane" id="seo">
            <?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo]); ?>
        </div>

<div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
    </div>
</div>