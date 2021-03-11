<?php

/**
 * @var $this       yii\web\View
 * @var $model      common\models\Article
 */

$this->title = 'Обновить: ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
    'seo' => $seo,
]) ?>
