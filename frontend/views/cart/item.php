<form class="form form--addGood" action="/cart/add-item" method="post">
 <button type="submit" data-title-item="<?php echo $product->name?>" class="btn btn--toCart js-cart-add-item"> 
 	<svg class="icon icon-checked"> 
 	<use xlink:href="/img/sprite.svg#icon-checked"></use> 
 </svg> 
 </button> 
 <input type="hidden" name="product_id" value="<?php echo $product->id ?>" class="js-good-value-target"> 
</form>