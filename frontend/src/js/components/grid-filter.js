const jQueryBridget = require('jquery-bridget');
const Isotope = require('isotope-layout');

jQueryBridget('isotope', Isotope, $);

window.grid = $('.filterGridBody')
  .isotope({
    itemSelector: '.filterGridBody__item',
    layoutMode: 'fitRows',
    getSortData: {
      category: '[data-category]'
    }
  });
