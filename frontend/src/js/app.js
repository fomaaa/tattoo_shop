import '@fancyapps/fancybox';
import Swiper from 'swiper';
import svg4everybody from 'svg4everybody';
import Simplebar from 'simplebar';
import 'suggestions-jquery';

import { ACTIVE, DOC } from './_const';

import './components/instafeed';
import './components/instagramBlock';
import './components/jquery.sTabs';
import './components/events';
import './components/grid-filter';
import './components/article';
import './components/sliders';
import './components/map';
import initDadata from './components/dadata';

import { setCartItemsHtml, updateCartPage } from './shop/cart-page';
import './shop/add-to-cart-button';
import './shop/add-to-favorite-button';
import { setMiniCartHtml } from './shop/mini-cart';

import { setCheckoutSidebarHtml } from './shop/checkout-sidebar';

/*eslint-disable*/

(function($) {
  $(() => {
    svg4everybody();

    DOC.on('click', '.js-subscribe-button', function (e) {
      e.preventDefault();

      const self = $(this);
      const $form = self.closest('.form');

      $.ajax({
        method: 'POST',
        dataType: 'html',
        data: $form.serialize(),
        url: $form.attr('action'),
        beforeSend() {
          self.closest('.subscribe').addClass('is-loading');
        },
        error(xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        },
        success(data) {
          self.closest('.subscribe').removeClass('is-loading');
          self.closest('.subscribe__body')
            .replaceWith(data);
        }
      });


    });

    $('.js-dadata-container')
      .each(function() {
        const self = $(this);
        const $country = self.find('[data-type="country"]');
        const $city = self.find('[data-type="city-settlement"]');
        const $address = self.find('[data-type="address"]');
        const $postalCode = self.find('[data-type="postal-code"]');

        // $country.suggestions({
        //   token: '4ac3bf29befb6e4ba3876af3632df6eb29782523',
        //   type: 'ADDRESS',
        //   bounds: 'country'
        // });

        $city.suggestions({
          token: '4ac3bf29befb6e4ba3876af3632df6eb29782523',
          type: "ADDRESS",
          bounds: "city-settlement",
          // geoLocation: false,
          onSelect: enforceCity,
          onSelectNothing: enforceCity
        });

        $address.suggestions({
          token: '4ac3bf29befb6e4ba3876af3632df6eb29782523',
          type: "ADDRESS",
          onSelect: restrictAddressValue,
          formatSelected: formatSelected
        });

        $city.suggestions().fixData();

        $city.suggestions().getGeoLocation()
          .done(function(locationData) {
            var sgt = {
              value: null,
              data: locationData
            };

            $country.val(locationData.country);
            $city.suggestions().setSuggestion(sgt);
            enforceCity(sgt);
          });

        function setConstraints(sgt, kladr_id) {
          var restrict_value = false;
          var locations = null;
          if (kladr_id) {
            locations = { kladr_id: kladr_id };
            restrict_value = true;
          }
          sgt.setOptions({
            constraints: {
              locations: locations
            },
            restrict_value: restrict_value
          });
        }

        function enforceCity(suggestion) {
          var sgt = $address.suggestions();
          sgt.clear();
          if (suggestion) {
            setConstraints(sgt, suggestion.data.kladr_id);
          } else {
            setConstraints(sgt, null);
          }
        }

        function restrictAddressValue(suggestion) {
          var citySgt = $city.suggestions();
          var addressSgt = $address.suggestions();

          $postalCode.val(suggestion.data.postal_code);

          if (!citySgt.currentValue) {
            citySgt.setSuggestion(suggestion);
            var city_kladr_id = suggestion.data.kladr_id.substr(0, 13);
            setConstraints(addressSgt, city_kladr_id);
          }
        }

        function formatSelected(suggestion) {
          var addressValue = makeAddressString(suggestion.data);
          return addressValue;
        }

        function makeAddressString(address) {
          return join([
            address.street_with_type,
            join([address.house_type, address.house,
              address.block_type, address.block], ' '),
            join([address.flat_type, address.flat], ' ')
          ]);
        }

        function join(arr /*, separator */) {
          var separator = arguments.length > 1 ? arguments[1] : ', ';
          return arr.filter(function(n) {
            return n;
          })
            .join(separator);
        }
      });

    // $('.js-dadata')
    //   .each(function() {
    //     initDadata(this);
    //   });

    $('.js-hideField-button')
      .on('click', function(e) {
        e.preventDefault();

        $(this)
          .closest('.hideFields')
          .addClass('is-active');
      });

    if ($('#catalogNav')
      .length) {
      const sidebar = new StickySidebar('#catalogNav', { topSpacing: 20 });
    }

    $('.subscribe__title')
      .each(function() {
        $(this)
          .html($(this)
            .html()
            .repeat(20));
      });
  });
}(jQuery));
