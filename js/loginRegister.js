$(document).ready(function() {
    $('.login').colorbox({
        iframe:true,
        innerWidth:400,
        innerHeight:300
    });
    $('.registro').colorbox({
        iframe:true,
        innerWidth:400,
        innerHeight:750
    });
})

function bindColorbox (param) {
	if (param == 'reload') {
		$(document).bind('cbox_closed', function(){
			document.location.reload();
			$(document).unbind('cbox_closed');
		});
	} else if (param == 'back') {
		$(document).bind('cbox_closed', function(){
			window.back(1);
			$(document).unbind('cbox_closed');
		});
	} else {
		$(document).bind('cbox_closed', function(){
			window.location = param;
			$(document).unbind('cbox_closed');
		});
	}
}

function cerrarColorbox () {
    $.colorbox.close();
}