if ($('#map').length) ymaps.ready(init);

function init() {
  const { placemarks } = locationCoords;

  window.yandexMap = new ymaps.Map('map', {
    center: [placemarks[0].lat, placemarks[0].lng],
    zoom: 12,
    controls: []
  });

  yandexMap.behaviors.disable('scrollZoom');

  for (let i = 0; i < placemarks.length; i += 1) {
    yandexMap.geoObjects
      .add(new ymaps.Placemark([placemarks[i].lat, placemarks[i].lng], {
        balloonContent: `${placemarks[i].text}`,
        iconCaption: `${placemarks[i].caption}`
      }, {
        preset: 'islands#redDotIconWithCaption'
      }));
  }
  // yandexMap.setBounds(yandexMap.geoObjects.getBounds());
}
