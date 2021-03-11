<?php
    $count = $cart->getTotalCount();

    $products = $cart->getItems();
 ?>
<a href="javascript:void(0);" class="btn btn--cart js-toggleCartMini">
    <span class="btn__title">корзина</span>
    <span class="badge badge--circle" style="background-color: #4cd964;"> <?php echo $count; ?> </span>
</a>

<div class="cartMini">
    <div class="cartMini__head"> <a href="/cart" class="cartMini__title"> Корзина <span><?php echo $count; ?></span> </a>
        <a href="javascript:void(0);" class="cartMini__close">
            <svg class="icon icon-close">
                <use xlink:href="/img/sprite.svg#icon-close"></use>
            </svg>
        </a>
    </div>
    <?php if ($count) : ?>
    <div class="cartMini__body">
        <div class="cartMini__container" data-simplebar>
            <form action="/cart/get-cart" class="form form--cartMini" onsubmit="return false;">
                <div class="cartMini__container">
                    <ul class="cartMini__list">
                        <?php foreach($products as $key => $product) :
                            $quantity = $product->getQuantity();
                            $product = $product->getProduct();
                        ?>
                        <li>
                            <div class="card card--goodMini">
                                <a href="<?php echo $product->get_url() ?>" class="card__link"></a>
                                <div class="card__left">
                                    <div class="card__photo" style="background-image: url('<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/165x165');"></div>
                                    <div class="card__quantity">
                                        <div class="quantity">
                                            <div class="quantity__control quantity__control--minus minus">
                                                <svg class="icon icon-minus">
                                                    <use xlink:href="/img/sprite.svg#icon-minus"></use>
                                                </svg>
                                            </div>
                                            <input type="text" class="quantity__value" name="CartForm[<?php echo $product->id ?>]" value="<?php echo $quantity; ?>">
                                            <div class="quantity__control quantity__control--plus plus">
                                                <svg class="icon icon-plus">
                                                    <use xlink:href="/img/sprite.svg#icon-plus"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__right">
                                    <div class="card__title"><?php echo $product->name?></div>
                                    <div class="card__price">
                                        <span class="price price--ruble">
                                            <?php echo $product->price ?>
                                        </span>
                                    </div>
                                    <a href="/cart/remove-item/<?php echo $product->id ?>" class="card__remove">
                                      <svg class="icon icon-close">
                                        <use xlink:href="/img/sprite.svg#icon-close"></use>
                                      </svg>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <?php endforeach; ?>
                    </ul>

                </div>
            </form>
        </div>
    </div>
    <?php else : ?>
    <div class="cartMini__body">
        <div class="cartMiniEmpty">
        <div class="cartMiniEmpty__text"> К сожалению, в вашей корзине нет ни одного товара </div>
        <div class="cartMiniEmpty__button">
            <a href="/catalog" class="btn btn--primary btn--lg"> Перейти в каталог </a>
        </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($count) : ?>
    <div class="cartMini__bottom">
        <div class="cartMini__top">
            <div class="cartMini__total"> <span class="price price--ruble"><?php echo $cart->getTotalCost() ?></span> </div>
            <div class="cartMini__reset">
                <a href="/cart/clear" class="btn btn--link btn--linkGray js-cart-reset"> Очистить корзину </a>
            </div>
        </div>
        <div class="cartMini__bottom"> <a href="/order" class="btn btn--primary"> Перейти к оформлению </a> </div>
    </div>
    <?php endif; ?>

</div>
