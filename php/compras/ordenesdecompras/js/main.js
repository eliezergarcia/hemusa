$(document).ready(function () {
	// $('.contenedor-menu .menu:has(a)').click(function(e){
	// 	e.preventDefault();

	// });

	$('.menu li:has(ul)').click(function(e){

		if ($(this).hasClass('activado')) {
			$(this).removeClass('activado');
			$(this).children('ul').slideUp();
		} else {
			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activado');
			$(this).addClass('activado');
			$(this).children('ul').slideDown();
		}
	});

	$('main .contenedor-principal .encabezado-main .btn-menu').click(function(){
		$('.contenedor-menu .menu').slideToggle();
	});

	$(window).resize(function(){
		if ($(document).width() >= 1199) {
			$('.contenedor-menu .menu').css({'display' : 'block'});
		}

		if ($(document).width() <= 1199) {
			$('.contenedor-menu .menu').css({'display' : 'none'});
			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activado');
		}

	});
});