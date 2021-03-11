(function ($) {

  $.Redactor.prototype.addSlider = function () {
    return {
      getTemplate: function () {

        return String()
          + '<section id="redactor-modal-addSlider">'
          + '<label class="control-label">Загрузите изображения</label>'
          + '<form action="/upload-target" class="dropzone" id="dropzoneSlider"></form>'
          + '</section>';
      },
      init: function () {
        var button = this.button.add('addSlider', 'Advanced');

        this.button.addCallback(button, this.addSlider.show);
        this.button.setAwesome('addSlider', 'fa-tasks');
      },
      initSlider: function () {

        window.dropzoneImages = [];

        window.dropzoneArea = new Dropzone('#dropzoneSlider', {
          url: this.opts.imageUpload,
          addRemoveLinks: true,
          // uploadMultiple: true,
          success: function (file, response) {
            dropzoneImages.push(response[0]);
          }
        });
      },
      show: function () {
        this.modal.addTemplate('addSlider',
          this.addSlider.getTemplate());
        this.modal.load('addSlider', 'Создание слайдера', 800);
        this.modal.createCancelButton();
        var button = this.modal.createActionButton('Вставить');
        button.on('click', this.addSlider.insert);
        this.selection.save();
        this.modal.show();
        $('#mymodal-textarea').focus();

        this.addSlider.initSlider();
      },
      insert: function () {

        // console.log(dropzoneArea.files);


        var html = $('<div class="sliderBox">' +
          '    <div class="sliderBox__main">' +
          '        <div class="swiper-container">' +
          '            <div class="swiper-wrapper"></div>' +
          '        </div>' +
          '    </div>' +
          '    <div class="sliderBox__thumbs">' +
          '        <div class="swiper-container">' +
          '            <div class="swiper-wrapper">' +
          '            </div>' +
          '        </div>' +
          '        <div class="swiper-button swiper-button-prev"></div>' +
          '        <div class="swiper-button swiper-button-next"></div>' +
          '    </div>' +
          '</div>');

        dropzoneImages.map(function (item) {

          var template = '<div class="swiper-slide">' +
            '<div class="sliderBoxImage" style="background-image: url(' + item.filelink + ')" />';

          html.find('.sliderBox__main .swiper-wrapper').append(template);
        })


        // this.modal.close();
        this.selection.restore();

        this.insert.html(html.get(0).outerHTML, false);

        this.code.sync();
      }
    };
  };
})(jQuery);

(function ($)
{
  $.Redactor.prototype.imageSchortcodes = function ()
  {
    var ext = {
      imageShortcodes: [],
      init: function ()
      {
        if (typeof this.opts.imageGetUrl == 'undefined')
          return false;
        var imperavi = this;

        var oldInsert = this.image.insert;
        this.image.insert = function (json, direct, e) {
          if (typeof json.error == 'undefined')
            ext.imageShortcodes[ext.imageShortcodes.length] = {shortcode: '#image-' + json.id + '#', id: json.id, src: json.filelink};
          oldInsert(json, direct, e);
        };
        var oldSync = this.clean.onSync;
        this.clean.onSync = function (html) {
          for (var i in ext.imageShortcodes)
          {
            var shortcodeObj = ext.imageShortcodes[i];
            html = html.replace(new RegExp(shortcodeObj.src, 'g'), shortcodeObj.shortcode);
          }
          return oldSync(html);
        };

        var regular = /#image-([0-9]*)#/g;
        var text = imperavi.code.get();
        var images = [];
        while (match = regular.exec(text)) {
          images[images.length] = {shortcode: match[0], id: match[1]};
        }
        $.post(this.opts.imageGetUrl, {images: images}, function (data) {
          for (var i in data)
          {
            var image = data[i];
            ext.imageShortcodes[ext.imageShortcodes.length] = image;
            text = text.replace(image.shortcode, image.src);
          }
          imperavi.code.set(text);
        }, 'json');

      },
    };
    return ext;
  };
})(jQuery);

