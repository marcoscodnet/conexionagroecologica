$(document).ready(function () {
    $('#left-panel li[data-nav="sponsors"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="sponsors-listado"]').addClass('active');
    ajaxImagesUploader.create({
        elements: $('.imagenUploader'),
        uploadController: BASE_URL+'php/uploaders/nosApoyan.uploader.php',
        deleteController: BASE_URL+'php/controllers/borrarImagenSponsor.controller.php',
        imgprefix: $('input[name="imgprefix"]').val(),
        imgDropzone: BASE_URL+'img/dropzone.gif'
    });
    $('.saveForm').on('click', function () {
        $('#formSponsor').submit();
    })
})