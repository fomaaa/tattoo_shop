        <div class="section section--location">
          <div class="section__inner">
            <div class="locationBar">
              <div class="locationBar__left">
                <div class="locationBar__title"> Наш магазин в&nbsp;Москве </div>
              </div>
              <div class="locationBar__center">
                <div class="locationBar__address"><?php echo $contacts->address ?></div>
                <ul class="locationBar__info">
                  <li>
                    <a href="tel:<?php echo preg_replace('~[^0-9]+~','',$contacts->phone); ?>"> <?php echo $contacts->phone ?> </a>
                    <a href="mailto:<?php echo $contacts->email ?>"> <?php echo $contacts->email ?> </a>
                  </li>
                  <li>
                    <p> <div class="contactsLocation__small"> <?php echo $contacts->work_time ?> </div> </p>
                  </li>
                </ul>
              </div>
              <div class="locationBar__right">
                <div class="metroBox">
                  <div class="metroBox__image">
                    <img src="/img/metro_image.png" alt="">
                  </div>
                  <div class="metroBox__body">
                    <p><?php echo $contacts->metro ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="locationMap" id="map"></div>
          </div>
        </div>

<script>
  var locationCoords = {
    zoom: 14,
    placemarks: [
      {
        lat: <?php echo $contacts->lat ?>,
        lng: <?php echo $contacts->lng ?>,
        caption: '<?php echo $contacts->marker ?>',
        text: '<?php echo $contacts->tooltip_text ?>',
      }]
  };
</script>