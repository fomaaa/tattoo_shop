import { DOC } from '../_const';

$('.filterGridNav')
  .on('click', 'a', function(e) {
    e.preventDefault();
    $('.filterGridNav a')
      .removeClass('is-active');
    $(this)
      .addClass('is-active');

    const filterValue = $(this)
      .attr('data-filter');
    // use filterFn if matches value
    grid.isotope({ filter: filterValue });
  });

$('.accordion__head')
  .on('click', function() {
    $(this)
      .toggleClass('is-active');
    $(this)
      .next()
      .slideToggle(400);
  });

DOC
  .on('click', '.js-toggleCartMini, .cartMini__close', (e) => {
    e.preventDefault();

    $('.cartMini')
      .toggleClass('is-active');
  });
