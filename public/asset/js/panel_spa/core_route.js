//++++++++++++++++++++++++ BASE ROUTING SCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//INGAT!! INI HARUS TERHUBUNG ATAU DIBARENGI DENGAN core.js dan api.js
// Kemudian route yang ada disini merupkan callback triger dari pada load page yang di panggil di menu sidebar 

// const BASE_URL_PAGE = "http://127.0.0.1:8000/"; ---> INI ADA DI api.js
function ROUTE_INIT( route, load_spa = false ) {
	this.route = route;
	this.callback_route = false;
	this.start = function() {
		//Handling Type Callback
		if (typeof this.callback_route !== 'function') {
			this.callback_route = function ( route ) {
				return 1;
			};
		}

		///Panggil Routenya
		this.callback_route( route );
	}
}
const ROUTE = {
	QUE_ROUTE : [],   
	add : function( route = "{path}/{path2}/{path3}", callback = false, load_spa = false ) {

		//Handling Default Type Callback
		if (typeof callback !== 'function') {
			callback = function () {
				return "Callback is not sign for function callback!!!";
			};
		}

		//++++++++ Build Object Route With Callback Triger +++++++
		var page = new ROUTE_INIT( route, load_spa );
		// Buat perilaku page ketika di triger dari method callback yang di daftarkan berdasarkan routenya
		page.callback_route = function() {
			callback( route );
		};

		//++++++++ Sign Object Route Yang Sudah Di Buil +++++++
		this.QUE_ROUTE.push( page );
	},

	//MEMANGGIL ROUTE BERDASARKAN TRIGER ROUTE AARGUMENNYA 
	load : function( url_route_target = BASE_URL_PAGE + "path/path2/" ) {
		var ROUTE_INIT_EXIST = false;
		var QUE_ROUTE = this.QUE_ROUTE;
		for (var i = 0; i < QUE_ROUTE.length; i++) {
			var row_obj = QUE_ROUTE[i];
			//Kalo routenya sudah terdaftar sebagai object Page
			if ( row_obj.route == url_route_target ) {	
				ROUTE_INIT_EXIST = row_obj;
				break;
			}
		}

		if ( ROUTE_INIT_EXIST != false ) {
			//Jika Route Yang Di Triger Ada, Maka Jalankan Perilaku dari callbacknya
			console.log('ROUTE TARGET DITEMUKAN DENGAN MENJALANKAN CALLBACK URL ROUTE ' + url_route_target);

			ROUTE_INIT_EXIST.start(); //Memanggil callback_route dari PAGE yang di pilih berdasarkan route
		}else{
			var msg_error = 'TIDAK DITEMUKAN ATAU BELUM DIDAFTARKAN ROUTENYA DI route_app.js DENGAN URL ROUTE ' + url_route_target;
			Swal.fire(msg_error);
			console.error( msg_error );
		}
	}
};
//++++++++++++++++++++++++ END OF BASE ROUTING SCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


//+++++++++++  BASE SPA ASYNCHRONOUS SCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//Helper Function For Route to Load SPA
function load_page( url_route = "path/path2/" ) {

	ROUTE.load( url_route );

	// Membuka parent .link_modul jika link menu punya parent link_modul
	var link_menu_target = $('.sidebar .link_menu').filter(`[data-page="${url_route}"]`); 
	var link_modul = link_menu_target.parents('.link_modul');
	if ( link_modul.length > 0 ) {
		//Buat object triger
		var row_modul_header = link_modul.find('.row_modul_header');
		load_link_modul( row_modul_header );
	}
}
//FUNGSI CORE UNTUK LOAD PAGE SPA
function LOAD_PAGE_SPA( target_page = BASE_URL_PAGE, callback = false ) {

	trace();

	//Handling Error Callback Type
	if ( typeof callback !== 'function' ) {
		callback = function() {
			return false;
		}
	}

	//SET DEBUG URL ACTIVE
	LOAD_PAGE_URL = target_page; 

	//Melakukan load page secara asynchrnous yang saling terhubung dengan menu sidebarnya dengan element root utama parentnya adalah .main_container
	// Jadi page akan di load() ke dalam element parent .main_container
	//Link menu target yang dijadikan active di pilih dari link menu yang memiliki data-page seperti target_page
	// Target_page berisi nilai dari url atau alamat halaman yang akan dimuat. 
	//  pada element link_menu data-page tersebut nilainya akan diisi langsung dari view atau seperti alamatnya 

	//+++++ Lakukan load section_content untuk halaman yang dituju sesuai dengan metad data link
	//Mengilangkan konten didalam main_container yaitu juga menghilangkan section_content yang lama
	var main_container = $('.main_container');
	main_container.html();
	//Melakukan load pada halaman baru yaitu juga menambahkan section_content yang baru pada halaman tersebut
	var animasi_loadPageEl = $('.col.content').find('.animasi_loadPage'); 
	animasi_loadPage("show", animasi_loadPageEl );
	console.log( "Target page", target_page );
	main_container.load( target_page, function(responseText, statusText, xhr) {

		if ( statusText === "error") {
			console.log( xhr );
			//Jika page tidak dapat di load atau error 	
			var msg = `${ xhr.status } <br> ${xhr.statusText}`
			animasi_loadPage('show', animasi_loadPageEl, msg);
			return false; //Menghentikan laju fungsi
		}
		//Ini letaknya ada di file.js untuk menambahkan elemen untuk melakukan select file
		//Mengecek dan menambahkan tombol untuk memanggil modal select file apabila ada elemen form yang memiliki class .form_file_upload 
		el_form_file_upload();  
		animasi_loadPage("hide", animasi_loadPageEl);

		//Menambahan element animasi load page pada table
		create_animasiLoadPageEl();

		//Memanggil callback
		callback( responseText, statusText, xhr );
	});


	//++++++++++ Memberikan tanda efek ke .link_menu yang punya nilai data-page seperti target_page
	var link_menu = $('.sidebar .link_menu');
	var link_menu_target = link_menu.filter(`.link_menu[data-page="${target_page}"]`);
	//+++++ Tandai elemen link menu yang aktif 
	link_menu.removeClass('active');
	link_menu_target.addClass('active');


	console.log("+++ Melakukan load page async", target_page);
}



function load_link_modul( row_modul_header_target ) {
	var link_modul_target = row_modul_header_target.parents( '.link_modul.row_modul' );
	var row_container_menu = link_modul_target.find('.row_container_menu');
	var link_menu_activeTarget = row_container_menu.find('.link_menu.active');
	var link_modul_icon = link_menu_activeTarget.find('i');


	if ( link_modul_target.is('.active') == false ) {
		//Jika link modul tidak aktif dan tidak terlihat, maka aktifkan dan tampilkan

		//Menghilangkan terlebih dahulu seluruh modul yang bukan target dan yang tidak punya child mennu yang sedang aktif
		var link_modul_hasMenuActive =  $('.link_menu.active').parents('.link_modul');
		$('.link_modul').not( link_modul_hasMenuActive ).removeClass('active');

		//Munculkan link modul target
		link_modul_target.addClass('active');

		//Ubah Icon Indicator Menjadi Chevron Ke Bawah
		var icon_indicator = link_modul_target.find('span.icon_indicator');
		var i_element = icon_indicator.find('i');
		i_element.removeClass('fa-chevron-right');
		i_element.addClass('fa-chevron-down');

	}else{
		//Jika link modul aktif, maka hilangkan link modul tersebut jika dia tidak punya menu active 
		if ( link_menu_activeTarget.length < 1 ) {
			link_modul_target.removeClass('active');
					//Ubah Icon Indicator Menjadi Chevron Ke Bawah
			var icon_indicator = link_modul_target.find('span.icon_indicator');
			var i_element = icon_indicator.find('i');
			i_element.removeClass('fa-chevron-down');
			i_element.addClass('fa-chevron-right');
		}else{
			console.log('TIDAK BISA MENUTUP, KARENA ADA MENU YANG SEDANG AKTIF');
		}
	}


}
//+++++++++++ END OF BASE SPA ASYNCHRONOUS SCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++






//+++++++++++++++++++++ IMPLEMENTASI - PENDAFTARAN TRIGER CALLBACK ROUTE SCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


/*
// === CONTOH MENDAFTARKAN ROUTE SPA CALLBACK BASIC 
ROUTE.add( '{URL_PATH_TERDAFTAR_DI_CONTROLLER}/path', function( route ) {
	alert('EVENT TRIGER CALLBACK');
});

// === CONTOH MENDAFTARKAN ROUTE SPA CALLBACK DENGAN LOAD SPA 
ROUTE.add( '{URL_PATH_TERDAFTAR_DI_CONTROLLER}/path', function( route ) {
	LOAD_PAGE_SPA( route );
});

// === CONTOH MENDAFTARKAN ROUTE SPA CALLBACK DENGAN LOAD SPA BER CALLBACK 
ROUTE.add( '{URL_PATH_TERDAFTAR_DI_CONTROLLER}/path', function( route ) {
	LOAD_PAGE_SPA( route, function( responseText, statusText, xhr  ){
		alert('EVENT CALLBACK SETELAH LOAD SPA');
	});
});
*/


//----- ADMIN CONTROLLER ROUTE CALLBACK ----
//https://url_app_fe/admin/dashboard
ROUTE.add( BASE_URL_PAGE + 'admin/dashboard', function( route ) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/admin/account
ROUTE.add( BASE_URL_PAGE + 'admin/account', function( route ) {
	LOAD_PAGE_SPA( route, function() {
		//Membuat list select level pada halaman di modal form berdasarkan data API pada modal tambah account
		get_data( URL_SERVICE_BE + "level", {}, function( response ) {
			var select_level = $('select[name=level]');
			for (var i = 0; i < response.length; i++) {
				var row_level = response[i];
				var nama_level = row_level.nama_level;
				var option_el = `<option value='${nama_level}'>${nama_level}</option>`;
				select_level.append( option_el );
			}
		});
	});

});
//https://url_app_fe/admin/level
ROUTE.add( BASE_URL_PAGE + 'admin/level', function( route ) {
	LOAD_PAGE_SPA( route );

});
//https://url_app_fe/admin/teknisi
ROUTE.add( BASE_URL_PAGE + 'admin/teknisi', function( route ) {
	LOAD_PAGE_SPA( route );

});
//https://url_app_fe/admin/produk
ROUTE.add( BASE_URL_PAGE + 'admin/produk', function( route ) {
	LOAD_PAGE_SPA( route );

});
//https://url_app_fe/admin/project
ROUTE.add( BASE_URL_PAGE + 'admin/project', function( route ) {
	LOAD_PAGE_SPA( route );

});
//https://url_app_fe/admin/laporan
ROUTE.add( BASE_URL_PAGE + 'admin/laporan', function( route ) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/admin/monitoring
ROUTE.add( BASE_URL_PAGE + 'admin/monitoring', function( route ) {
	LOAD_PAGE_SPA( route, function() {

	});
});
//https://url_app_fe/admin/transaksi_kategori
ROUTE.add( BASE_URL_PAGE + 'admin/transaksi_kategori', function( route ) {
	LOAD_PAGE_SPA( route, function() {

	});
});
//https://url_app_fe/admin/transaksi_pemasukan
ROUTE.add( BASE_URL_PAGE + 'admin/transaksi_pemasukan', function( route ) {
	LOAD_PAGE_SPA( route, function() {

	});
});
//https://url_app_fe/admin/transaksi_pengeluaran
ROUTE.add( BASE_URL_PAGE + 'admin/transaksi_pengeluaran', function( route ) {
	LOAD_PAGE_SPA( route, function() {

	});
});
//https://url_app_fe/admin/transaksi_pembayaran
ROUTE.add( BASE_URL_PAGE + 'admin/transaksi_pembayaran', function( route ) {
	LOAD_PAGE_SPA( route, function() {

	});
});




//----- TEKNISI CONTROLLER ROUTE CALLBACK ----
//https://url_app_fe/teknisi/dashboard
ROUTE.add( BASE_URL_PAGE + 'teknisi/dashboard', function( route ) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/teknisi/project
ROUTE.add( BASE_URL_PAGE + 'teknisi/project', function( route ) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/teknisi/monitoring
ROUTE.add( BASE_URL_PAGE + 'teknisi/monitoring', function( route ) {
	LOAD_PAGE_SPA( route );
});


//----- USER CONTROLLER ROUTE CALLBACK ----
//https://url_app_fe/user/dashboard
ROUTE.add( BASE_URL_PAGE + 'user/dashboard', function( route ) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/user/profile
ROUTE.add( BASE_URL_PAGE + 'user/profile', function( route ){
	LOAD_PAGE_SPA( route, function() {
		//Menampilkan profile pada card profile 
		get_row(URL_SERVICE_BE + "account", { by_user : get_userLogin() }, function(response ) {
			// ===============================
			// PROFILE HEADER
			// ===============================
			if (response.source_file_profile) {
				$('#source_file_profile').attr('src', response.source_file_profile);
			}

			$('#nama').text(response.nama);
			$('#user').text(response.user);
			$('#level').text(response.level);

			// ===============================
			// PERSONAL INFORMATION
			// ===============================
			$('#email').text(response.email);

			if (response.alamat && response.alamat !== 'NULL') {
				$('#alamat').text(response.alamat);
			} else {
				$('#alamat').text('-');
			}

			// ===============================
			// FORM UPDATE PROFILE (MODAL)
			// ===============================
			$('input[name=nama]').val(response.nama);
			$('input[name=email]').val(response.email);
			$('textarea[name=alamat]').val(
				(response.alamat && response.alamat !== 'NULL') ? response.alamat : ''
				);
		});
	});
});
//https://url_app_fe/user/project
ROUTE.add( BASE_URL_PAGE + 'user/project', function(route) {
	LOAD_PAGE_SPA( route );
});
//https://url_app_fe/user/tambah_project
ROUTE.add( BASE_URL_PAGE + 'user/tambah_project', function( route ) {
	LOAD_PAGE_SPA( route, function() {
		//Menampilkan list produk pada option di form tambah project pada form 
		var form_tambah_project = $('#form_tambah_project'); 
		var select_option_produk = form_tambah_project.find('select[name=id_produk]');
		//Bersihan elemen option lama 
		select_option_produk.html(" ");
		if ( form_tambah_project.length > 0 ) {
			get_data( URL_SERVICE_BE + "produk", {}, function(response) {
				var form_tambah_project = $('#form_tambah_project'); 
				for (var i = 0; i < response.length; i++) {
					var row_produk = response[i];
					var el_option = `<option value='${ row_produk.id_produk }'> ${ row_produk.nama_produk } </option>`;
					select_option_produk.append(  el_option );
				}
			});
		}
		// Event monitoring maps 
		maps_update();

	} );

});
//https://url_app_fe/user/monitoring
ROUTE.add( BASE_URL_PAGE + 'user/monitoring', function(route) {
	LOAD_PAGE_SPA( route );
});



//=== Contoh Penggunaan Memanggi Langsung Routenya Dan Menjalankan Callbacck Trigernya dengan Triger routenya untuk menjalankan callback dari page yang didaftarkan
// load_page( URL_ROUTE_YANG_TERDAFTAR );







