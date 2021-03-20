$(document).ready(function () {
	 var $_GET = getUrlVars();
	 $('a[rel="galleryBox'+$_GET['id']+'"]').colorbox({onOpen:function (){$('.zoomHover').hide()}});
})

/*obtiene los valores de las variables get*/
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
/* --- fin --- */