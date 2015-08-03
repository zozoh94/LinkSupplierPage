$(document).ready(function(){
    $('#linksupplierpage').click(function(){
	$(this).removeClass('slide_close');
	$(this).addClass('slide_open');
	$('#linksupplierpage .fancybox-close').show();
    });
    $('#linksupplierpage .fancybox-close').click(function(e){
	$('#linksupplierpage').removeClass('slide_open');
	$('#linksupplierpage').addClass('slide_close');
	$(this).hide();
	e.stopPropagation();
    });
});
