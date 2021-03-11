import {openModal} from '../lib/togglepopup';

$('.js-add-notification').on('click', function(e) {
  e.preventDefault();
  let self = $(this);
  let idPopup = self.data('popup');

  $(idPopup).find('.form').data('product-id', self.data('product-id'));

  let productName = self.data('product-name');
  let successText = 'Вы успешно оформили подписку на «' + productName + '»!';
  $('#productSubscribed').find('.modalSuccess__subtitle').text(successText);

});

$('.form--goodNotification').submit(function(e) {
  e.preventDefault();
  let self = $(this);

  if ($('[aria-invalid="true"]', self).length) return false;

  r46('subscribe_trigger', 'product_available', {
    email: $('[name="email"]', self).val(),
    item: self.data('product-id')
  });
  self.closest('.modal').removeClass('is-active');

  openModal($('#productSubscribed'));
});
