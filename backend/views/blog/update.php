<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BlogModel */

$this->title = 'Update Blog Model: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-model-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
