var ajaxImagesUploader = (function($) {
    var options, time, formTpl = '\
        <form data-aip-id="${id}" data-aip-id="${i}" class="fileForm" action="${uploader}" method="post" enctype="multipart/form-data">\
            <input class="hidden" type="file" name="file">\
            <input class="hidden" type="submit" value="Upload File to Server">\
            <input type="hidden" name="imgprefix" value="${imgprefix}" />\
        </form>\
    ';
    function openFileDialog($form) {
        $form.find('input[type="file"]').trigger('click');
    }
    function forceUpload () {
        $(this).parents('form').submit();
    }
    
    function create (o) {
        options = o;
        time = new Date();
        time = time.getTime();
        var form = formTpl, $form;
        options.elements.each(function (i) {
            $(this).attr({'data-aip-id': time, 'data-aip-i': i});
            form = form.replace('${uploader}', options.uploadController)
                    .replace('${imgprefix}', options.imgprefix)
                    .replace('${id}', time)
                    .replace('${i}', i);
            $form = $(form);
            $('body').append($form);
            if ($(this).find('img').attr('src') != options.imgDropzone) {
                $(this).find('.borrarImagen').show();
                $(this).find('.info').hide();
            }
            
            //attachEvents
            $form.find('input[type="file"]').change(forceUpload);
            $(this).click(function () {
                openFileDialog($form);
            });
            upload($form, $(this));
            remove($(this).find('.borrarImagen'));
        });
    }
    
    function upload ($form, $imagenUploader) {            
        $form.ajaxForm({
            beforeSubmit: function(arr, $form, options) {
                $imagenUploader.find('.info span').html('Por favor espere...');
                $imagenUploader.find('.info .fa-spin').show();
            },
            success: function(data) {
                $imagenUploader.find('.info span').html('');
                $imagenUploader.find('.info .fa-spin').hide();
                if (data) {
                    $imagenUploader.find('img')
                        .fadeOut(400, function() {
                            $(this).attr('src', data[0].src);
                        })
                        .fadeIn(400, function() {
                            $(this).siblings('a').attr('data-id', data[0].id).show();
                        });
                }
            }
        });
    }

    function remove($deleteBtn) {
        $deleteBtn.click(function(event) {
            event.stopPropagation();
            $.ajax({
                url: options.deleteController,
                type: 'post',
                data: {id: $deleteBtn.attr('data-id')},
                success: function() {
                    $deleteBtn.parent().find('img')
                            .fadeOut(400, function() {
                                $(this).attr('src', options.imgDropzone);
                            })
                            .fadeIn(400, function() {
                                $deleteBtn.hide();
                                $deleteBtn.parent().find('.info span').html('Click para cargar la imagen');
                            })
                }
            })
        })
    }

    return {
        /**
         * @param {{ elements: jQuery, uploadController: String, deleteController: String, imgprefix: String, imgDropzone: String }} options
         */
        create: function(options) {
            create(options);
        }
    };
})(jQuery);