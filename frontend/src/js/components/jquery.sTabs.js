import { ACTIVE } from '../_const';

$.fn.sTabs = function(scroll) {
  this.each(function() {
    const $wrapTab = $(this);
    const $tabs = $wrapTab.find('.tabsList a');
    const $wrapCont = $wrapTab.find('.tabsBox');
    const $tab_cont = $wrapCont.children('div');

    if (scroll) {
      $tab_cont.customScrollbar({
        skin: 'default-skin',
        hScroll: false,
        updateOnWindowResize: true
      });
    }
    $tabs.on('click', function() {
      const tab_id = $(this)
        .attr('class')
        .split(' ');

      $tabs.removeClass(ACTIVE);
      $(this)
        .addClass(ACTIVE);
      $tab_cont.removeClass(ACTIVE);
      $wrapCont.children(`.tabs__con_${tab_id[0]}`)
        .addClass(ACTIVE);
      $(window)
        .resize();
      return false;
    });
  });
};

$('.tabs')
  .sTabs();
