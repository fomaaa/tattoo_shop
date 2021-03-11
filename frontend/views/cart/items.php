<?php 
  $count = $cart->getTotalCount();
  $products = $cart->getItems();
 ?>
    <div class="cartGoods">
        <form action="cart/get-cart" class="form form--goods">
            <ul class="goodsList">
                <?php if (is_array($products)) : ?>
                <?php foreach($products as $key => $product) : 
                      $quantity = $product->getQuantity();
                      $product = $product->getProduct();
                  ?>
                    <li class="goodsList__item">
                        <div class="card card--cart">
                            <div class="card__photo" style="background-image: url('<?php echo $product->get_image_url('165x165'); ?>');"></div>
                            <div class="card__body">
                                <a href="/catalog/<?php echo $product->slug ?>" class="card__title"><?php echo $product->name ?></a>
                                <div class="card__right">
                                    <div class="card__quantity">
                                        <div class="quantity">
                                            <div class="quantity__control quantity__control--minus minus">
                                                <svg class="icon icon-minus">
                                                    <use xlink:href="/img/sprite.svg#icon-minus"></use>
                                                </svg>
                                            </div>
                                            <input type="text" class="quantity__value" name="CartForm[<?php echo $product->id ?>]" value="<?php echo $quantity; ?>" />
                                            <div class="quantity__control quantity__control--plus plus">
                                                <svg class="icon icon-plus">
                                                    <use xlink:href="/img/sprite.svg#icon-plus"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__price">
                                        <span class="price price--ruble"><?php echo $product->price * $quantity ?></span>
                                    </div>
                                    <button class="btn btn--remove" type="button">
                                        <svg class="icon icon-close">
                                            <use xlink:href="/img/sprite.svg#icon-close"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </form>
    </div>