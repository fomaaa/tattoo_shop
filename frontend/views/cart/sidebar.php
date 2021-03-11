<div class="cartBox">
  <form action="/" class="form form--cartBox cartBox__inner">
    <div class="cartBox__row">
      <div class="cartBox__title">корзина</div>
      <div class="cartBox__right">
        <span class="price price--ruble"><?php echo $cart->getTotalCost() ?></span>
      </div>
    </div>
    <div class="cartBox__row">
      <div class="cartBox__title">доставка</div>
      <div class="cartBox__right">
        <span class="price price--ruble"><?php echo $delivery ?></span>
      </div>
    </div>
    <div class="cartBox__row">
      <div class="cartBox__title">сертификат</div>
      <div class="cartBox__right">
        <input type="text" class="input input--codeSale" placeholder="Введите код">
      </div>
    </div>
    <div class="cartBox__row">
      <div class="cartBox__total">
        <span class="price price--ruble"><?php echo $cart->getTotalCost() + $delivery; ?></span>
      </div>
    </div>
  </form>
</div>