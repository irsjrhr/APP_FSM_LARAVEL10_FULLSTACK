$(document).ready(function(e) {
	
    //Membuka halaman pertama dari menu yang paling awal yaitu dashboard 
	var link_menu_first = $('.sidebar').find('.link_menu').first();
	var data_page = link_menu_first.attr('data-page');
	load_page( data_page, function() {

	});	
	




});