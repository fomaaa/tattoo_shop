<form action="/cart/add-certificate" method="post" class="form form--certificateOffer">
	<div class="form__top">
		<div class="radioButtonPrice">
			<input type="radio" name="quantity" value="500" class="radioButtonPrice__input">
			<div class="radioButtonPrice__body">
				<span class="price price--ruble">500</span>
			</div>
		</div>
		<div class="radioButtonPrice">
			<input type="radio" value="1000" name="quantity" class="radioButtonPrice__input">
			<div class="radioButtonPrice__body">
				<span class="price price--ruble">1 000</span>
			</div>
		</div>
		<div class="radioButtonPrice">
			<input type="radio" value="2000" name="quantity" class="radioButtonPrice__input">
			<div class="radioButtonPrice__body">
				<span class="price price--ruble">2 000</span>
			</div>
		</div>
		<div class="radioButtonPrice">
			<input type="radio" value="5000" name="quantity" class="radioButtonPrice__input">
			<div class="radioButtonPrice__body">
				<span class="price price--ruble">5 000</span>
			</div>
		</div>
		<input type="text" name="custom" placeholder="или введите свою сумму">
	</div>
	<div class="form__bottom">
		<a href="#" class="btn btn--toCart js-cart-add-item">
			<svg class="icon icon-checked">
				<use xlink:href="img/sprite.svg#icon-cart"></use>
			</svg>
		</a>
	</div>
	<input type="hidden" name="product_id" value="1" class="js-good-value-target">
</form>
