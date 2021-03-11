import { DOC } from '../_const';

// eslint-disable-next-line func-names
DOC.on('click', '.js-favorite-add-item', function(e) {
  e.preventDefault();

  const self = $(this);

  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: self.attr('href'),
    success({ htmlButton, htmlIndicator }) {
      self.replaceWith(htmlButton);
      $('.header .header__favorites').html(htmlIndicator);
    }
  });
});
