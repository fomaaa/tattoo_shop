import Instafeed from './instafeed';

/*eslint-disable*/

if ($('#instafeed').length) {
  let galleryPhotos;

  const feed = new Instafeed({
    get: 'user',
    userId: $('[name="instagram-user-id"]')
      .attr('content'),
    clientId: $('[name="instagram-client-id"]')
      .attr('content'),
    accessToken: $('[name="instagram-access-token"]')
      .attr('content'),
    limit: $('[name="instagram-photos-limit"]')
      .attr('content'),
    template: '<div class="instBox__item">{{model.template}}</div>',
    target: 'instafeed',
    resolution: 'standard_resolution',
    links: false,
    error() {
      $('#instafeed')
        .closest('.section')
        .hide();
    },
    filter(image) {
      image.template = ` <a href="${image.images.standard_resolution.url}" data-fancybox="#gallery"><img src="${image.images.standard_resolution.url}"/></a>`;
      return true;
    },
    after() {
    }
  }).run();
}
