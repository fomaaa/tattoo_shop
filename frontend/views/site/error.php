<?php

use yii\helpers\Html;
use common\models\KeyStorageItem;
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$statusCode = Yii::$app->response->statusCode;

if ($statusCode != 404 && $statusCode != 500) $statusCode = 500;

$key = 'frontend.' . $statusCode;
$error = KeyStorageItem::find()->where(['key' => $key])->one();
$data = json_decode($error->value, true);

?>

<div class="section section--error">
	<div class="container section__inner">
		<div class="errorPage__body">
			<?php if ($data['error' . $statusCode . '_title']) :  ?>
			<div class="errorPage__icon">
				<div class="errorIcon404">
					<?php for ($i = 0; $i < strlen($data['error' . $statusCode . '_title'] - 1); $i++) { ?>
					<span><?php echo $data['error' . $statusCode . '_title'][$i]; ?></span>
					<?php } ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="errorPage__title page__title"><?php echo $data['error' . $statusCode . '_subtitle']; ?></div>
			<div class="errorPage__subtitle">
				<?php echo $data['error' . $statusCode . '_description']; ?>
			</div>
			<div class="errorPage__bottom">
				<a href="<?php echo $data['error' . $statusCode . '_link']; ?>" class="btn btn--primary btn--lg">
					<span><?php echo $data['error' . $statusCode . '_btn']; ?></span>
				</a>
			</div>
		</div>
	</div>
</div>
