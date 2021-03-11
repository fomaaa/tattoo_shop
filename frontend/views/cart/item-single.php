<form action="/cart/add-item-single" method="post" class="form form-addGood goodCard__order">
    <input type="hidden" name="product_id" value="<?php echo $product->id ?>" class="js-good-value-target">
    <div class="goodCard__quantity">
        <div class="quantity quantity--lg">
            <div class="quantity__control quantity__control--minus minus">
                <svg class="icon icon-minus">
                    <use xlink:href="/img/sprite.svg#icon-minus"></use>
                </svg>
            </div>
            <input type="text" class="quantity__value" value="<?php echo $quantity ?>">
            <div class="quantity__control quantity__control--plus plus">
                <svg class="icon icon-plus">
                    <use xlink:href="/img/sprite.svg#icon-plus"></use>
                </svg>
            </div>
        </div>
    </div>
    <div class="goodCard__price"> <span class="price price--ruble"><?php echo $product->price * $quantity ?></span> </div>
    <div class="goodCard__buttons">
        <button class="btn btn--primary btn--lg js-cart-add-item" type="submit">
            <svg class="icon icon-checked">
                <use xlink:href="/img/sprite.svg#icon-checked"></use>
            </svg> <span>в корзине</span> </button>
    </div>
</form>

