<?php  if ($subscribe->enabled && !Yii::$app->user->identity->subscribe) : ?>
<div class="section section--subscribe">
	<div class="section__inner">
		<div class="subscribe">
			<div class="subscribe__title"><span>скидки новости статьи</span></div>
			<div class="subscribe__body">
				<form action="/site/subscribe" class="form form--subscribe" onsubmit="return false;">
					<div class="form__title">подписка на рассылку</div>
					<div class="form__area">
						<input type="email" name="email" placeholder="электронная почта"/>
						<button class="btn btn--arrow js-subscribe-button" type="submit">
							<svg class="icon icon-arrow_right">
								<use xlink:href="/img/sprite.svg#icon-arrow_right"></use>
							</svg>
						</button>
					</div>
				</form>
			</div>
			<div class="subscribe__title"><span>скидки новости статьи</span></div>
		</div>
	</div>
</div>
<?php endif; ?>
