import { DOC } from '../_const';
import { setMiniCartHtml } from './mini-cart';
import { setCheckoutSidebarHtml } from './checkout-sidebar';
import { updateCartPage, setCartItemsHtml } from './cart-page';

/*eslint-disable*/

DOC.on('click', '.js-cart-add-item', function(e) {
  e.preventDefault();

  const self = $(this);
  const $form = self.closest('.form');

  $.ajax({
    method: 'POST',
    dataType: 'json',
    data: $form.serialize(),
    url: $form.attr('action'),
    beforeSend() {
      self.addClass('is-loading');
    },
    error(xhr, ajaxOptions, thrownError) {
      console.log(xhr.status);
      console.log(thrownError);
    },
    success({ htmlIndicator, htmlButton }) {

      self.closest('.form')
        .replaceWith(htmlButton);

      setMiniCartHtml(htmlIndicator);

      // If we are on the cart page now
      updateCartPage(({ htmlItems, htmlSidebar, htmlIndicator }) => {
        setMiniCartHtml(htmlIndicator);
        setCheckoutSidebarHtml(htmlSidebar);
        setCartItemsHtml(htmlItems);
      });
    }
  });
});

// DOC.on('click', '.js-good-value', function() {
//   $('.js-good-value-target')
//     .val(this.value);
// });
