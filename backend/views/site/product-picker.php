<?php

use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="product-model-form">

	<div class="form-group">
		<div class="sortableGroup js-sortable">
			<div class="sortableGroup__cell js-search-sortable">
				<div class="sortableGroup__title">
					<h3>Список всех товаров</h3>
				</div>
				<div class="sortableGroup__searchBar">
					<form action="/site/get-products" class="form form--sortableSearch js-search-sortable-form" onsubmit="return false;">
						<div class="form-group">
							<label>Поле поиска</label>
							<input type="text" class="form-control js-search-sortable-form-input" name="search" placeholder="Начните ввод..">
						</div>
					</form>
				</div>
				<div class="sortableGroup__column js-sortable-column js-search-sortable-container">
					<?php if (0) :  ?>
						<?php foreach ($products as $product) : ?>
					<div class="sortableGroup__item">
						<div class="productItem">
							<input type="hidden" name="Product[<?php echo $product->id ?>]" value="<?php echo $product->id ?>">
							<div class="productItem__head">
								<div class="productItem__label">
									Название товара
								</div>
								<h4 class="productItem__title">
									<?php echo $product->name ?>
								</h4>

								<a href="<?php echo Yii::getAlias('@frontend') . $product->get_url(); ?>" target="_blank" class="productItem__link">
									<i class="fa fa-external-link"></i>
								</a>
							</div>
						</div>
					</div>
					<?php endforeach; endif; ?>
				</div>
			</div>
			<div class="sortableGroup__cell js-sidebar">
    		<?php $form = ActiveForm::begin(['id' => 'product_picker']); ?>
				<div class="sortableGroup__title">
					<h3>Список товаров в слайдере</h3>
				</div>
				<div class="sortableGroup__column js-sortable-column">
					<?php if ($products) :  ?>
						<?php foreach ($products as $product) : ?>
					<div class="sortableGroup__item">
						<div class="productItem">
							<input type="hidden" name="Product[<?php echo $product->id ?>]" value="<?php echo $product->id ?>">
							<div class="productItem__head">
								<div class="productItem__label">
									Название товара
								</div>
								<h4 class="productItem__title">
									<?php echo $product->name ?>
								</h4>

								<a href="<?php echo Yii::getAlias('@frontend') . $product->get_url(); ?>" target="_blank" class="productItem__link">
									<i class="fa fa-external-link"></i>
								</a>
							</div>
						</div>
					</div>
					<?php endforeach; endif; ?>
				</div>
			<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

    <div class="form-group">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'form' => 'product_picker']) ?>
    </div>


</div>
