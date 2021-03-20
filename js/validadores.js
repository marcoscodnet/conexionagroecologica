function validarTexto (inputId) {
	//var expresion = RegExp ("^[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ±Ã‘Ã§Ã‡Ã¤Ã«Ã¯Ã¶Ã¼Ã„Ã‹ÃÃ–Ãœ]+( )*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ±Ã‘Ã§Ã‡Ã¤Ã«Ã¯Ã¶Ã¼Ã„Ã‹ÃÃ–Ãœ]*$")
	var expresion = /^[a-záéíóúñüàè\s]*$/i
	if ($('#'+inputId).val() != false && !expresion.test($('#'+inputId).val())) {
		$('#'+inputId).val('Este campo sólo acepta texto').attr('class','mensaje');
		return false;
	} else {
		return true;
	}
}

function validarNumero (inputId) {
	var expresion = RegExp ("^[0-9]*$")
	if ($('#'+inputId).val() != false && !expresion.test($('#'+inputId).val())) {
		$('#'+inputId).val('Este campo sólo acepta números').attr('class','mensaje');
		return false;
	}
}

function validarTextoYNumero (inputId) {
	var expresion = /^[a-záéíóúñüàè0-9\s]*$/i
	if ($('#'+inputId).val() != false && !expresion.test($('#'+inputId).val())) {
		$('#'+inputId).val('Use sólo caracteres alfanuméricos').attr('class','mensaje');
		return false;
	} else {
		return true;
	}
}

function validarEmail(inputId) {
	if ($('#'+inputId).val() != false) {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('#'+inputId).val()) && $('#'+inputId).val() != false){
			return true;
		} else {
			$('#'+inputId).val('El mail ingresado no es válido').attr('class','mensaje');
			return false;
		}
	} else {
		return true;
	}
}

function validarObligatorio (inputId) {
	if ($('#'+inputId).val() == false) {
		$('#'+inputId).val('Este campo es obligatorio').attr('class','mensaje');
		return false;
	} else {
		return true;
	}
}