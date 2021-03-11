import { REMOVED, DOC, LOCKED } from '../_const';
import '../components/jquery.countBind';
import debounce from '../components/debounce';
import { setMiniCartHtml } from './mini-cart';
import { setCheckoutSidebarHtml } from './checkout-sidebar';

const changeQuantityHandler = debounce(
  () => {
    saveCartForm(({ htmlItems, htmlSidebar, htmlIndicator }) => {
      setMiniCartHtml(htmlIndicator);
      setCheckoutSidebarHtml(htmlSidebar);
      setCartItemsHtml(htmlItems);
    });

    return false;
  },
  500
);

export const countBindOptions = {
  callback: changeQuantityHandler,
  finalQuantity: 100
};

$('.quantity')
  .countBind(countBindOptions);


DOC.on('click', '.js-cart-reset', function(e) {
  e.preventDefault();
  const self = $(this);

  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: self.attr('href'),
    error(xhr) {
      alert(`${xhr.status}:${xhr.statusText}`);
    },
    success({ htmlItems, htmlSidebar, htmlIndicator }) {
      setMiniCartHtml(htmlIndicator);
      setCheckoutSidebarHtml(htmlSidebar);
      setCartItemsHtml(htmlItems);
    }
  });
});

DOC.on('change', '.quantity__value', changeQuantityHandler);

DOC.on('click', '.form--goods .card .btn--remove', function(e) {
  e.preventDefault();

  const self = $(this);
  const $card = self.closest('.card');
  const $cardWrapper = $card.parent();

  $card.find('.quantity__value')
    .val(0);

  $cardWrapper.css({
    height: $card.outerHeight()
  });

  $card.addClass(REMOVED);

  $cardWrapper.slideUp(
    400,
    () => {
      saveCartForm(({ htmlItems, htmlSidebar, htmlIndicator }) => {
        setMiniCartHtml(htmlIndicator);
        setCheckoutSidebarHtml(htmlSidebar);
        setCartItemsHtml(htmlItems);

        // Remove element after send form
        $cardWrapper.remove();
      });
    }
  );

  return false;
});

// DOC.on('change', '.card .js-select', function() {
//   const self = $(this);
//
//   $.ajax({
//     type: 'POST',
//     dataType: 'json',
//     url: self.data('url'),
//     data: {
//       id: self.val(),
//       parent: self.data('parent')
//     },
//     beforeSend() {
//       $('.basket')
//         .addClass(LOCKED);
//     },
//     error(xhr) {
//       alert(`${xhr.status}:${xhr.statusText}`);
//     },
//     success({ htmlItems, htmlSidebar, htmlIndicator }) {
//       setMiniCartHtml(htmlIndicator);
//       setCheckoutSidebarHtml(htmlSidebar);
//       setCartItemsHtml(htmlItems);
//
//       $('.basket')
//         .removeClass(LOCKED);
//     }
//   });
// });

function saveCartForm(callback) {
  const $goodsForm = $('.form--goods');
  const $cartMini = $('.form--cartMini');

  if ($goodsForm.length === 0) {
    if ($cartMini.length) {
      $.ajax({
        method: 'POST',
        url: $cartMini.attr('action'),
        data: $cartMini.serialize(),
        dataType: 'json',
        beforeSend() {
        },
        success(data) {
          callback(data);
        }
      });
    }
    return;
  }

  $.ajax({
    method: 'POST',
    url: $goodsForm.attr('action'),
    data: $goodsForm.serialize(),
    dataType: 'json',
    beforeSend() {
      $('.cart')
        .addClass(LOCKED);
    },
    success(data) {
      callback(data);
      $('.cart')
        .removeClass(LOCKED);
    }
  });
}

export function updateCartPage(callback) {
  const $goodsForm = $('.form--goods');

  if ($goodsForm.length === 0) {
    return;
  }

  $.ajax({
    method: 'GET',
    url: $goodsForm.attr('action'),
    dataType: 'json',
    beforeSend() {
      $('.basket')
        .addClass(LOCKED);
    },
    success(data) {
      callback(data);
      $('.basket')
        .removeClass(LOCKED);
    }
  });
}

export function setCartItemsHtml(html) {
  // If this function call on page with Basket Goods
  const $basketGoods = $('.cart .cartGoods');

  if ($basketGoods.length === 0) {
    return;
  }

  const $newCartItems = $('<div/>')
    .append(html)
    .find('.cartGoods .goodsList__item');

  if ($newCartItems.length > 0) {
    $basketGoods.replaceWith(html);
    // Find new elements after replace
    const $basketGoodsActual = $('.cart .goodsList');
    // $basketGoodsActual.find('.js-select')
    //   .selectric();
    $basketGoodsActual.find('.quantity')
      .countBind(countBindOptions);
  } else {
    $('.js-cartPage__content')
      .hide();
    $('.js-cartPage__empty')
      .show();
  }
}
