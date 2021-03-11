import { setCartItemsHtml } from './cart-page';
import { ACTIVE, DOC } from '../_const';
import debounce from '../components/debounce';
import { setMiniCartHtml } from './mini-cart';

DOC.on('submit', '.form--basketBox', (e) => {
  e.preventDefault();
  e.stopPropagation();

  saveCheckoutSidebar(saveCheckoutSidebarHandler);
});

DOC.on('change', '.bonusCheck input', debounce(() => {
  saveCheckoutSidebar(saveCheckoutSidebarHandler);
}, 500));

DOC.on('change', '.couponsControl input', debounce(() => {
  saveCheckoutSidebar(saveCheckoutSidebarHandler);
}, 500));

DOC.on('click', '.couponsControl__button', function(e) {
  e.preventDefault();
  const $self = $(this);
  const $couponBlock = $self.closest('.couponsControl');
  const $couponInputBlock = $couponBlock.find('.couponsControl__field');

  $couponInputBlock.slideToggle(400, () => {
    if ($couponInputBlock.hasClass(ACTIVE)) {
      const $couponInput = $couponInputBlock.find('input');
      if ($couponInput.val().trim() !== '') {
        $couponInput.val('');

        saveCheckoutSidebar(saveCheckoutSidebarHandler);
      }

      $couponInputBlock.removeClass(ACTIVE);
      $self.removeClass(ACTIVE);
    } else {
      $couponInputBlock.addClass(ACTIVE);
      $self.addClass(ACTIVE);
    }
  });
});

/*eslint-disable*/

export function setCheckoutSidebarHtml(html) {
  // If this function call on page with Basket Box
  const $basketBox = $('.cartBox');

  if ($basketBox.length === 0) {
    return;
  }

  $basketBox.replaceWith(html);
}

function saveCheckoutSidebar(callback) {
  const $basketBoxForm = $('.form--basketBox');

  $.ajax({
    method: 'POST',
    url: $basketBoxForm.attr('action'),
    data: $basketBoxForm.serialize(),
    dataType: 'json',
    beforeSend() {
      $('.basket').addClass('is-locked');
    },
    success(data) {
      callback(data);
      $('.basket').removeClass('is-locked');
    }
  });
}

function saveCheckoutSidebarHandler({ htmlItems, htmlSidebar, htmlIndicator }) {
  setMiniCartHtml(htmlIndicator);
  setCheckoutSidebarHtml(htmlSidebar);
  setCartItemsHtml(htmlItems);
}
