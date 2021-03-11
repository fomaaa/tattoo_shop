<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BlogModel */

$this->title = 'Create Blog Model';
$this->params['breadcrumbs'][] = ['label' => 'Blog Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-model-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
