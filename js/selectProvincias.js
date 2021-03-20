$(document).ready(function() {	
	/*select de localidades*/
	$('#selectProvincia').change(function () {
		$.ajax({
			type:'POST',
			cache:false,
			url:'php/controllers/localidadSelect.controller.php',
			data: 'prov='+$(this).val(),
			success:function (ok) {
				$('#localidadContenedor').html(ok)
			}
		})
	})
	/* --- fin --- */
})