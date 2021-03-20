function WinModal (contenido, id) {
	this.id = id;
	this.class = 'winmodal'
	this.abrir = function () {
		$('body').append('<div id="fondoModal"><div id="'+this.id+'">'+contenido+'</div></div>');
		$('#'+this.id).addClass(this.class);
		$('#fondoModal').click(this.cerrar);
		$('#'+this.id).click(function (){return false});
	}
	this.cerrar = function () {
		$('#fondoModal').remove();
		$('#'+this.id).remove();
	}
	this.setContenido = function (cont) {
		$('#'+this.id).html(cont);
	}
}