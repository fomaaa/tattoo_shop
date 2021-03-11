/*eslint-disable*/

$.fn.countBind = function(options) {
  const settings = $.extend(true, {
    prefix: '',
    startQuantity: 1,
    finalQuantity: 999999,
    callback: $.noop
  }, options);

  this.each(function() {
    const $block = $(this);
    const iterator = $block.data('iterator') || 1;
    const $input = $block.find('input');
    let oldValue = parseInt($input.val(), 10);

    if (typeof settings.startQuantity === 'undefined') {
      settings.startQuantity = iterator;
    }

    $input.unbind('keyup, keypress');

    $input.on('keypress', function(e) {
      if (e.which !== 8 && e.which !== 0 && e.which !== 46 && (e.which < 48 || e.which > 57) || (e.which === 46 && $(this)
        .val()
        .indexOf('.') !== -1)) {
        return false;
      }
    });

    $block.find('.minus')
      .off('click.minus')
      .on('click.minus', () => {
        minus();
        return false;
      });

    $block.find('.plus')
      .off('click.plus')
      .on('click.plus', () => {
        plus();
        return false;
      });

    $block.data('api', {
      minus,
      plus
    });

    function minus() {
      let currentValue = parseInt($input.val(), 10),
        newValue = currentValue - iterator;

      if ((currentValue <= settings.startQuantity) || (isNaN(currentValue)) || (currentValue === undefined)) {
        newValue = currentValue;
      }
      if (newValue > settings.finalQuantity) {
        newValue = settings.finalQuantity;
      }
      $input.val(newValue + settings.prefix)
        .attr('value', newValue + settings.prefix);

      if (oldValue !== newValue) {
        settings.callback(newValue);
      }

      oldValue = newValue;

      return newValue;
    }

    function plus() {
      let currentValue = parseInt($input.val(), 10),
        newValue = currentValue + iterator;

      if ((isNaN(currentValue)) || (currentValue === undefined)) {
        newValue = iterator;
      }
      if (newValue > settings.finalQuantity) {
        newValue = settings.finalQuantity;
      }
      $input.val(newValue + settings.prefix)
        .attr('value', newValue + settings.prefix);

      if (oldValue !== newValue) {
        settings.callback(newValue);
      }

      oldValue = newValue;

      return newValue;
    }
  });
};
