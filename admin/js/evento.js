var optionsDatepickers = {
    dateFormat: 'dd-mm-yy',
    dayNamesMin: ['do', 'lu', 'ma', 'mi', 'ju', 'vi', 'sá'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort:['Ene','Feb','Mar','Abril','Mayo','Jun','Jul','Ago','Sept','Oct','Nov','Dic'],
    prevText : '<i class="fa fa-chevron-left"></i>',
    nextText : '<i class="fa fa-chevron-right"></i>'
}

$(document).ready(function () {
    $('#left-panel li[data-nav="eventos"]').addClass('active');
    $('input[name="dia"]').datepicker(optionsDatepickers)
    $('input[name="hora"]').timepicker({
        defaultTime: false
    }).on('show.timepicker', function(e) {console.log(e)});
    $('.saveForm').click(function () {$('form:first').submit()})
})