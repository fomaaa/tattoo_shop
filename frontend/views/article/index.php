<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $searchModel frontend\models\search\ArticleSearch */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Articles');
print_r(count($articles));
?>
<main class="pageWrapper">
	<div class="section section--blog section--paddingTopDefault">
		<div class="section__inner">
			<div class="page__title">Блог</div>
			<div class="article">
				<div class="container">
					<?php if (is_array($articles)) : ?>
						<ul class="articleList">
							<?php foreach ($articles as $key => $article) :
								if (!$key) :
									?>
									<li class="articleList__item articleList__item--lg">
										<div class="card card--article card--lg">
											<a href="/blog/<?php echo $article->slug ?>"
											   class="card__link"></a>
											<div class="card__photo"
												 style="background-image: url('<?php echo $article->getThumbnailUrl() ?>');"></div>
											<div class="card__body">
												<div class="card__date"><?php echo date('d.m.Y', $article->published_at) ?></div>
												<div class="card__title"><?php echo $article->title ?></div>
												<?php if ($article->excerpt) : ?>
												<div class="card__description"> <?php echo $article->excerpt ?></div>
												<?php endif; ?>
											</div>
										</div>
									</li>
								<?php else : ?>
									<li class="articleList__item">
										<div class="card card--article ">
											<a href="/blog/<?php echo $article->slug ?>"
											   class="card__link"></a>
											<div class="card__photo"
												 style="background-image: url('<?php echo $article->getThumbnailUrl() ?>');"></div>
											<div class="card__body">
												<div class="card__date"><?php echo date('d.m.Y', $article->published_at) ?></div>
												<div class="card__title"><?php echo $article->title ?></div>
												<?php if ($article->excerpt) : ?>
													<div class="card__description"> <?php echo $article->excerpt ?></div>
												<?php endif; ?>
											</div>
										</div>
									</li>
								<?php endif;
								if ($key == 3) break; endforeach; ?>
						</ul>
					<?php else : ?>
						Статей нет :(
					<?php endif; ?>
				</div>
			</div>
			<div class="section section--subscribe">
				<div class="section__inner">
					<div class="subscribe">
						<div class="subscribe__title"><span>скидки новости статьи</span></div>
						<div class="subscribe__body">
							<form action="/" class="form form--subscribe">
								<div class="form__title">подписка на рассылку</div>
								<div class="form__area">
									<input type="text" name="input"
										   placeholder="электронная почта"/>
									<button class="btn btn--arrow" type="submit">
										<svg class="icon icon-arrow_right">
											<use xlink:href="img/sprite.svg#icon-arrow_right"></use>
										</svg>
									</button>
								</div>
							</form>
						</div>
						<div class="subscribe__title"><span>скидки новости статьи</span></div>
					</div>
				</div>
			</div>

			<?php if (is_array($articles) && count($articles) > 3) : ?>
				<div class="article">
					<div class="container">
						<ul class="articleList">
							<?php foreach ($articles as $key => $article) :
								if ($key > 3) :
									?>
									<li class="articleList__item">
										<div class="card card--article ">
											<a href="#" class="card__link" target="_blank"></a>
											<div class="card__photo"
												 style="background-image: url('<?php echo $article->getThumbnailUrl() ?>');"></div>
											<div class="card__body">
												<div class="card__date"><?php echo date('d.m.Y.', $article->published_at) ?></div>
												<div class="card__title"><?php echo $article->title ?></div>
												<div class="card__description"> Подходящий,
													инновационный, а главное качественный блок
													питания — это залог успешной работы мастера
													машинки.
												</div>
											</div>
										</div>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>

						</ul>
					</div>
				</div>
			<?php endif; ?>


			<?php if ($pagination) : ?>
				<div class="container">
					<div class="pagination">
						<div class="pagination__item">
							<span>1</span>
						</div>
						<div class="pagination__item">
							<a href="#">2</a>
						</div>
						<div class="pagination__item">
							<a href="#">3</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>
