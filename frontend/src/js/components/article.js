$('.section--article article')
  .find('p')
  .each(function() {
    if ($(this)
      .find('img').length) {
      $(this)
        .addClass('imageContainer');
    }
  });

$('.section--article article')
  .find('p')
  .each(function() {
    if ($(this)
      .find('.btn').length) {
      $(this)
        .addClass('buttonContainer');
    }
  });
