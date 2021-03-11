$(function () {
	var day;
	var count_int = 1;
	$(document).on('click', '.remove-item1, .remove-item, .remove-item2, .remove-item3, .remove-item4, .remove-item5', function () {
		var count = $('.custom-widjet .item');

		$(this).parents('.box-default').remove();
	});
	$(document).on('click', '.add-image', function () {
		count_int = getRandomIntInclusive(0, 9999);
		var item = '<div class="item1 box box-default border-left border-right"><div class="box-header clearfix with-border"><div class="pull-right"><button type="button"class="remove-item1 btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button></div></div><div class="box-body"><div class="row"><div class="col-md-6"><label for="">Заголовок</label><textarea class="form-control"name="DynamicModel[title][]"aria-required="true"></textarea></div><div class="col-md-6"><label for="">Подзаголовок</label><textarea class="form-control"name="DynamicModel[subtitle][]"aria-required="true"></textarea></div><div class="col-md-12"><div class="form-group"><label for="">Ссылка</label><input type="text" class="form-control" name="DynamicModel[link][]" aria-required="true"></div></div><div class="col-md-6"><div class="form-group field-dynamicmodel-image"><label class="control-label" for="dynamicmodel-image">Изображение</label><div><input type="hidden" id="dynamicmodel-image" class="empty-value " name="DynamicModel[image][0]"><input type="file" id="slider' + count_int + '" class="slider-image' + count_int + '" name="_fileinput_image"></div></div></div></div></div></div>';
		var container = $(this).parents('.box-primary').find('.container-items1');
		$(item).appendTo(container);

		jQuery('.slider-image' + count_int).yiiUploadKit({
			"url": "/file/storage/upload?fileparam=_fileinput_image",
			"multiple": false,
			"sortable": false,
			"maxNumberOfFiles": 1,
			"maxFileSize": 5000000,
			"minFileSize": null,
			"acceptFileTypes": /(\.|\/)(gif|jpe?g|png|svg)$/i,
			"files": null,
			"previewImage": true,
			"showPreviewFilename": false,
			"pathAttribute": "path",
			"baseUrlAttribute": "base_url",
			"pathAttributeName": "path",
			"baseUrlAttributeName": "base_url",
			"messages": {
				"maxNumberOfFiles": "Достигнуто максимальное кол-во файлов",
				"acceptFileTypes": "Тип файла не разрешен",
				"maxFileSize": "Файл слишком большой",
				"minFileSize": "Файл меньше минимального размера"
			},
			"name": "DynamicModel[image][" + count_int + "]"
		});
		count_int++;
	});

	$(document).on('click', '.add-advantage', function () {
		count_int = getRandomIntInclusive(0, 9999);
		var item = '<div class="col-md-6"><label for="">Заголовок</label><textarea class="form-control"name="DynamicModel[advantage_title][]"aria-required="true"></textarea></div><div class="col-md-6"><div class="form-group field-dynamicmodel-advantage_image"><label class="control-label" for="dynamicmodel-advantage_image">Изображение</label><div><input type="hidden" id="dynamicmodel-advantage_image" class="empty-value" name="DynamicModel[advantage_image][' + count_int + ']"><input type="file" id="advantage' + count_int + '" class="advantage-image' + count_int + '" name="_fileinput_advantage_image"></div></div></div>';
		var container = $(this).parents('.box-primary').find('.container-items2');
		$(item).appendTo(container);

		jQuery('.advantage-image' + count_int).yiiUploadKit({
			"url": "/file/storage/upload?fileparam=_fileinput_advantage_image",
			"multiple": false,
			"sortable": false,
			"maxNumberOfFiles": 1,
			"maxFileSize": 5000000,
			"minFileSize": null,
			"acceptFileTypes": /(\.|\/)(gif|jpe?g|png|svg)$/i,
			"files": null,
			"previewImage": true,
			"showPreviewFilename": false,
			"pathAttribute": "path",
			"baseUrlAttribute": "base_url",
			"pathAttributeName": "path",
			"baseUrlAttributeName": "base_url",
			"messages": {
				"maxNumberOfFiles": "Достигнуто максимальное кол-во файлов",
				"acceptFileTypes": "Тип файла не разрешен",
				"maxFileSize": "Файл слишком большой",
				"minFileSize": "Файл меньше минимального размера"
			},
			"name": "DynamicModel[advantage_image][" + count_int + "]"
		});
		count_int++;
	});

	$('.js-ajax-status').on('change', function () {
		var order_id = $(this).attr('data-id');
		var val = $(this).val();

		if (val && order_id) {
			$.ajax({
				url: '/orders/change-status',
				method: 'POST',
				dataType: 'html',
				data: {
					'order_id': order_id,
					'val': val
				},
				success: function (data) {
				}
			});
		}
	});

  if ($('.js-sortable').length) {
    $('.js-sortable').each(function () {
      var self = $(this);

      self.find('.js-sortable-column').each(function () {
        new Sortable(this, {
          group: 'shared',
          animation: 150
        });
      })
    });
  }

  if ($('.js-sidebar').length) {
    $('.js-sidebar').stickySidebar({
      topSpacing: 10,
      resizeSensor: true,
      bottomSpacing: 0
    });
  }

  $('.js-search-sortable').each(function () {
    var self = $(this);
    var $form = self.find('.js-search-sortable-form');

    $form.find('.js-search-sortable-form-input').on('keydown', debounce(function () {

      var data = $(this).closest('.form').serialize();

      $.ajax({
        url: $form.attr('action'),
        data: data,
        beforeSend() {
          self.addClass('is-loading');
        },
        success: function (data) {
          self.removeClass('is-loading');
          self.find('.js-search-sortable-container').html(data);
        }
      })

    }, 300));
  })

});


function debounce(fn, delay) {
  var timer = null;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function() {
      fn.apply(context, args);
    }, delay);
  };
}
function getRandomIntInclusive(min, max) {
	min = Math.ceil(min);
	max = Math.floor(max);
	return Math.floor(Math.random() * (max - min + 1)) + min;
}
