<?php
$breadcrumbs = \Yii::$app->breadcrumbs->getBreadcrumbs($product);
?>
<?php if ($breadcrumbs) : ?>
	<div class="breadcrumbs">
		<ul class="breadcrumbsList">
			<?php foreach ($breadcrumbs as $key => $item) :  ?>
			<li class="breadcrumbsList__item">
				<?php if ($item['is_product']):  ?>
					<span><?php echo $item['name'] ?></span>
				<?php else : ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['name'] ?></a>
				<?php endif; ?>
			</li>
			<?php  endforeach;   ?>
		</ul>
	</div>
<?php endif; ?>
