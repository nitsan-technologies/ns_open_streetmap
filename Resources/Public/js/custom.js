$(document).ready(function () {
	sideHeight();
});
$(window).resize(function () {
	sideHeight();
});

function sideHeight() {
	var mapblock = $('.map_canvas').outerHeight();
	$('.add_sidebar').css('height', mapblock);
}