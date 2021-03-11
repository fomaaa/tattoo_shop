import {ACTIVE, DOC} from '../_const';
import '../lib/jquery-validation';
import '../lib/inputmaks';
import {initDadata} from '../components/dadata';
import {configFlatPickr} from '../components/date-picker';
import flatpickr from 'flatpickr';

$('.js-phone-mask').mask('+7 (999) 999-99-99');

$.extend($.validator.messages, {
  required: 'Это поле необходимо заполнить',
  remote: 'Исправьте это поле чтобы продолжить',
  email: 'Введите правильный email адрес.',
  url: 'Введите верный URL.',
  date: 'Введите правильную дату.',
  dateISO: 'Введите правильную дату (ISO).',
  number: 'Введите число.',
  digits: 'Введите только цифры.',
  creditcard: 'Введите правильный номер вашей кредитной карты.',
  equalTo: 'Повторите ввод значения еще раз.',
  accept: 'Пожалуйста, введите значение с правильным расширением.',
  maxlength: jQuery.validator.format('Нельзя вводить более {0} символов.'),
  minlength: jQuery.validator.format('Должно быть не менее {0} символов.'),
  rangelength: jQuery.validator.format('Введите от {0} до {1} символов.'),
  range: jQuery.validator.format('Введите число от {0} до {1}.'),
  max: jQuery.validator.format('Введите число меньше или равное {0}.'),
  min: jQuery.validator.format('Введите число больше или равное {0}.')
});

$('#formOrder').validate({
  invalidHandler: function() {
    $('.js-add-preloader').removeClass('is-loading');
  },
  rules: {
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6
    },
    name: {
      required: true
    },
    lastName: {
      required: true
    },
    phone: {
      required: true,
      digits: true,
      minlength: 9
    },
    delivery: {
      required: true
    },
    freshSelect: {
      required: '#freshRadio:checked'
    },
    newAddress: {
      required: '#newAddressRadio:checked'
    },
    dateDelivery: {
      required: true
    },
    timeDelivery: {
      required: true
    },
    orderPayment: {
      required: true
    },
  },
  messages: {
    orderPayment: 'Укажите способ оплаты',
    delivery: 'Укажите способ получения заказа'
  },
  onfocusin: false,
  onfocusout: false,
});

$('.form--goodNotification').validate({
  invalidHandler: function() {
    $('.js-add-preloader').removeClass('is-loading');
  },
  rules: {
    email: {
      required: true,
      email: true
    }
  }
});

$('input').on('keyup', function() {
  let self = $(this);
  let $parent = self.parent();

  if (self.val() !== '') {
    $parent.addClass('input-val');
  } else {
    $parent.removeClass('input-val');
  }
});

$('.btn-change-vision').on('click', function(e) {
  e.preventDefault();
  let self = $(this);
  let $fieldInput = self.parent().find('input');

  self.toggleClass(ACTIVE);

  if (self.hasClass(ACTIVE)) {
    $fieldInput.attr('type', 'text');
  } else {
    $fieldInput.attr('type', 'password');
  }
});

$('.js-add-field').on('click', function(e) {
  e.preventDefault();
  let self = $(this);
  let $group = self.closest('.js-group-wrapper');
  let template = $group.find('.form__field-template').clone().html();

  $group.find('.js-group-body').append(template);

  initDadata($group.find('.js-dadata-target'));

  if (self.hasClass('js-add-field--address')) {
    $group.find('.js-group-body').find('.radioButton:last-child input[type="radio"]').attr('checked', 'true');
    self.hide();
  }
});

$(document).on('change', '.js-address-value', function() {
  let $target = $('.js-address-new');
  let self = $(this);

  if (!$target.is(':checked')) {
    self.closest('.form__group').find('.newFields').removeClass(ACTIVE);
  }
});

export function scrollToError() {
  if ($('.error').length) {
    let $targetEl = $('.error').eq(0);

    $('html, body').animate({
      scrollTop: $targetEl.offset().top - ($(window).outerHeight() / 2)
    });

    $targetEl.parent().find('input').focus();
  }
}

$(document).on('change', '.js-calculate-shipping', function() {
  let self = $(this);
  let $form = self.closest('.js-form--order');
  let $shippingUrl = $form.data('shipping-url');

  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: $shippingUrl,
    data: $form.serialize(),
    beforeSend: function() {
      $('.basket').addClass('is-locked');
    },
    success: function({htmlDateField, htmlSidebar, htmlPaymentField}) {

      // If this function call on page with Basket Box
      const $basketBox = $('.basketBox');
      if ($basketBox.length > 0) {
        $basketBox.replaceWith(htmlSidebar);
        console.log('update basketBox');
      }

      const calendarEl = $('.js-datepicker-wrapper .js-datepicker').get(0);
      const fp = calendarEl._flatpickr;
      fp.destroy();

      $(calendarEl).replaceWith(htmlDateField);
      let newEl = $('.js-datepicker-wrapper .js-datepicker').get(0);
      flatpickr(newEl, configFlatPickr($(newEl)));

      $('.js-payments-field').replaceWith(htmlPaymentField);

      $('.basket').removeClass('is-locked');
    }
  });
});

DOC.on('change', '.js-form--interview .js-input', function() {
  let $form = $(this).closest('.js-form--interview');

  $.ajax({
    url: $form.data('save-url'),
    data: $form.serialize(),
    method: 'POST'
  });
});
