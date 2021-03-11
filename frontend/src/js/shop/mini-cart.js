import { DOC, REMOVED, ACTIVE } from '../_const';
import { setCartItemsHtml, countBindOptions } from './cart-page';
import { setCheckoutSidebarHtml } from './checkout-sidebar';

DOC.on('click', '.cartMini .card .card__remove', function(e) {
  e.preventDefault();

  const $self = $(this);
  const $card = $self.closest('.card');

  const $cardWrapper = $card.parent();
  $cardWrapper.css({
    height: $card.outerHeight()
  });
  $card.addClass(REMOVED);
  $cardWrapper.slideUp(
    400,
    () => {
      $.ajax({
        method: 'POST',
        dataType: 'json',
        url: $self.attr('href'),
        success({ htmlItems, htmlSidebar, htmlIndicator }) {
          setMiniCartHtml(htmlIndicator);
          setCheckoutSidebarHtml(htmlSidebar);
          setCartItemsHtml(htmlItems);

          // Remove element after send form
          $cardWrapper.remove();
        }
      });
    }
  );

  return false;
});

/*eslint-disable*/

export function setMiniCartHtml(html) {
  let stateMiniCart = !!$('.cartMini')
    .hasClass(ACTIVE);
  $('.header .header__cartMini').html(html);

  if (stateMiniCart) {
    $('.cartMini').addClass(ACTIVE);
  }

  $('.quantity')
    .countBind(countBindOptions);
}
