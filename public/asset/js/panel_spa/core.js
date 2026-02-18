//Script TERHUBUNGAN DENGAN FUNGSI PADA api.js untuk melakukan request data dan admin_table.js untuk melakukan load DOM table terkait data yang di load
//Di script ini semuanya berhubungan dengan data di URL_SERVICE_BE
var LOAD_PAGE_URL;


$(document).ready(function() {
	// ======================== ADMIN EVENT TRIGER ========================================
	
	$('body').on('click', '.btn_opt', function(e) {
		trace();

		btn_opt_toggle( $(this) );
	});
	$('body').on('click', '.menu_opt .close_opt', function(e) {
		trace();


		var close_opt = $(this);
		var menu_opt = close_opt.parents('.menu_opt');
		menu_opt_hide( menu_opt );
	});
	$('body').on('click', '.btn_video', function(e) {
		trace();


		var btn = $(this);
		var data_url = btn.attr('data-url'); //Ambil data source video dari button
		var modal_video = $('#modal_video');
		var video = modal_video.find('video');
		var video_src = video.find('source');

		//Update src
		video_src.attr('src',  data_url );
		//Muat ulamg DOM Videonya dengan source terbaru
		video[0].load();

	});	
	//++++++++++ Asynchronous ++++++++++++++++
	$('.sidebar .link_modul .row_modul_header').on('click', function() {
		load_link_modul( $(this) );
	});

	//Event sidebar menu untuk load page spa 
	$('.sidebar .link_menu').on('click', function() {

		trace();

		//Membuka load page dan efek menu sidebar
		var link_menu = $('.sidebar .link_menu');
		var link_menu_target = $(this);
		var data_page = link_menu_target.attr('data-page');
		load_page( data_page ); //Inni ada di route_app.js

	});


	
	//Event .btn_load untuk melakukan load data ke tabel yang ada di main_container pada page yang sedang aktif atau dimuat
	$('.main_container').on('click', '.btn_load', function() {
		trace();

		// Melakukan load table pada section_content yang sedang aktif berdasarkan data-fungsi 
		load_table_active();
	});

});


function btn_opt_toggle( obj ) {
	trace();

	var btn_opt = $( obj );
	var td = btn_opt.parents('td');
	var menu_opt = td.find('.menu_opt');
	menu_opt.show( function() {
		$('html').bind('click', function(e) {
			var target = $(e.target);
			var obj_is_menu = target.is('.menu_opt');
			if ( obj_is_menu == false ) {
				//Jika yang di klik bukan area dalam menu yang sedang di buka, maka tutup menu ini 
				menu_opt_hide( menu_opt );

			}
		});				
	});
}
function menu_opt_hide( menu_opt ) {
	trace();

	menu_opt.hide();
	$('html').unbind('click');
}


// +++++++++++ Asynchronous Method 
function animasi_loadPage( param = "show", animasi_loadPageElInput = "", text_load = "Memuat data ....", callback = false ) {
	trace();


	console.log("Animasi load page", param);
	var animasi_loadPageEl = $(animasi_loadPageElInput);
	//Melakukan perubahan pada text load animasi 
	var text_loadEl = animasi_loadPageEl.find('.text_load');
	text_loadEl.html(text_load);

	//Menentukan hilang atau muncul
	switch( param ){
		case "show" :
		animasi_loadPageEl.show();
		break;

		case 'hide' :
		setTimeout(function() {
			animasi_loadPageEl.hide();
		}, 100);
		break;
	}
	if ( animasi_loadPageEl.length < 1 ) {
		console.log( "Tidak ada object animasi_loadPage dengan class", animasi_loadPageEl);
	}


	//Handling error arg untuk bentuk callback
	if ( callback == false ) {
		//buat menjadi fungsi kosong 
		callback = function( s ) {
			return false;
		} 
	}
	callback( animasi_loadPageEl );
}
function create_animasiLoadPageEl() {
	trace();

	//Ambil element yang sudah pernah ada di col content utama
	var col_content = $('.col.content');
	var animasi_loadPageEl = col_content.find('.animasi_loadPage').html();
	//Buat yang baru 
	var new_animasi_loadPage = `
	<!-- Elemen ini ditambahkan oleh fungsi create_animasiLoadPageEl() pada saat load page berlangsung dan berhasil -->
	<div class='animasi_loadPage'>
	${ animasi_loadPageEl } </div>
	<!-- Elemen ini ditambahkan oleh fungsi create_animasiLoadPageEl() pada saat load page berlangsung dan berhasil -->
	`;
	//Tambahkan ke section content di page yang di load atau yang sedang aktif pada div parent table_data
	var table_data = $('.table_data');
	var parent_table = table_data.parent('div');
	parent_table.prepend( new_animasi_loadPage );

}



function load_link_modul( row_modul_header_target ) {
	var link_modul_target = row_modul_header_target.parents( '.link_modul.row_modul' );
	var row_container_menu = link_modul_target.find('.row_container_menu');
	var link_menu_active = row_container_menu.find('.link_menu.active');
		
	if ( link_modul_target.is('.active') == false ) {
		//Jika link modul tidak aktif dan tidak terlihat, maka aktifkan dan tampilkan

		$('.link_modul').removeClass('active');
		link_modul_target.addClass('active');
	}else{
		//Jika link modul aktif dan terlihat, maka nonaktifkan dan hilangkan
		if ( link_menu_active.length < 1 ) {
			link_modul_target.removeClass('active');
		}else{
			console.log('TIDAK BISA MENUTUP, KARENA ADA MENU YANG SEDANG AKTIF');
		}
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


// +++++++++++++++++ Fungsi Untuk Melakukan Load Data Ke Table Berdasarkan data-fungsi yang ada pada section_content ++++++++++++++

// Melakukan load table pada section_content yang sedang aktif berdasarkan data-fungsi 
function load_table_active() {	
	trace();

	//Event ini akan membuat fungsi load yang di ambil dari data-fungsi dan fungsinya yang sudah dibuat 
	//Contoh melakukan load di section_content dengan data-fungsi "course" dan maka course tersebut dijadikan string load_content_course dan dijadikan fungsi kemudian dijalankan. Fungsi load_content_course itu sudah ada sebelumnya
	//data-fungsi menjadi path endpoint
	var section_content = $('.section_content');
	var data_fungsi = section_content.attr('data-fungsi');	

	//Hasil yang diharapkan {URL_SERVICE_BE}/{data_fungsi}
	var URL_ENDPOINT = URL_SERVICE_BE + data_fungsi;
	var animasi_loadPageEl = section_content.find('.animasi_loadPage');
	animasi_loadPage('show', animasi_loadPageEl, "Memuat data table...." );
	//Menjalankan fungsi get_data( enpoint, callback ) yang ada pada api.js
	get_data( URL_ENDPOINT, {}, function( response ) {

		console.log(response);
		//Jika request berhasil
		if ( response != null ) {
			var data_load = response;
			load_table( data_load );
			animasi_loadPage('hide', animasi_loadPageEl);
		}else{
			animasi_loadPage('show', animasi_loadPageEl, "Data tidak ditemukan!");
		}

	});
}

//Melakukan load tabel data yang mengintegrasikannya pada fungsi di admin_table.js dengan closure berdasarkan data yang dikirimkan pada argument 
function load_table( data = [] ) {
	trace();

	// Bentuk argument data nya adalah array index multidimensi yang isinya object 
	//Ini adalah konsep closure interopobility
	//Merupakan fungsi untuk melakukan load data ke suatu table pada section_content (berdasarkan data-fungsi) yang sedang di buka berdasarkan data yang di kirim pada argument
	//Data yang di kirim ke argument adalah array index yang isinya array associatif atau object 
	//Function yang di panggil itu ada di admin_table.js dengan format fungsinya adalah load_table_[data-fungsi]()
	//Dan yang terjadi adalah fungsi yang di panggil akan melakukan load data ( dari data yang di kirim dari argumen ) ke dalam table pada section_content yag sedang dibuka berdasarkan data-fungsinya tadi. Load data ke tabel ini melibatkan proses manipulasi DOM agar terdapat strukut data yang sesuai 
	// Jadi bisa dikatakan setiap page fitur asynchronous yang di buat pada admin yang memiliki struktur halaman data tabel, maka  punya fungsi load data DOM di admin_table.js 
	var section_content = $('.section_content'); // Memilih object .section_content yang sedang terbuka 
	
	var banyak_data = section_content.find('.banyak_data');

	banyak_data.text( data.length );

	var data_fungsi = section_content.attr('data-fungsi'); //Mengambil data-fungsi untuk pembuatan dan pemanggilan fungsi load table pada admin_table.js untuk memuat data pada table. Jadi isi pada data-fungsi pada setiap section_content itu terhubung atau memiliki bentuk dengan nama fungsi tersebut di admin_table.js
	var nama_fungsi = "load_table_" + data_fungsi;
	let func = new Function("data", `
		return ${nama_fungsi}( data );` //Pembuatan fungsi 
		); //Closure interopablity 

	//++++++++++++++++++
	func( data );// Fungsi untuk load table, dengan perilaku loadnya ada di admin_table.js
	//++++++++++++++++++

	console.log("+++ Menjalankan fungsi load", nama_fungsi, "dengan data yang di load ke content adalah", data );
}

function open_modal_pembayaran( src ) {
	trace();


	function loader_pembayaran( param_visible = "hide", caption = "...."  ) {
		var loader_pembayaran = $('.loader_pembayaran');
		loader_page( param_visible, loader_pembayaran, caption );
	}
	var modal_pembayaran = $('#modal_pembayaran');
	var caption_source = modal_pembayaran.find('#caption_source');
	var source_url = caption_source.find('.source_url');
	var container_modal_view = modal_pembayaran.find('.container_modal_view');
	var btn_download = modal_pembayaran.find('.btn_download');
	var midtrans_view = container_modal_view.find('#midtrans_view');
	modal_pembayaran.modal('show');
	source_url.text( src );
	btn_download.attr('data-href', src);
	loader_pembayaran('show', 'Harap Tunggu.....');

	//MENAMPILKAN IFRAME DALAM IFRAME AGARR TIDAK TERKENA EFEK REDIRECT DARI MIDTRANS CALLBACK
	// Jadi Di Modal kita melakukan iframe ke method route admin/embed_midtrans/{url}. Kemudian di method tersebut dia akan melakukan iframe lagi dengan halaman full daari url yang kita passing pada parameter routenya 
	// src = BASE_URL_PAGE +'admin/embed_midtrans/'+src ;
	// ==== Midtrans Iframe Snap ==== 
	midtrans_view.attr("src", src);
	loader_pembayaran('hide');
}


//Melakukan Debug Untuk Setiap Fungsi Yang Berjalan Pada FE 
// variabel DEBUG_CONSOLE_TRACE ada di api.js dan kalo nilainya false maka debug fungsi ini akan berjalan. Jika true debug fungsi ini tidak akan berjalan
function trace(label = "", data = null, callback = false) {

	// Handling callback
	if (callback == false) {
		callback = function() {
			return false;
		};
	}

	//Handling Debug
	if ( DEBUG_CONSOLE_TRACE == false ) {
		return false;
	}

	// Ambil stack trace
	const stack = new Error().stack;
	const stackLines = stack.split('\n');

	// Cari informasi caller (line ke-3 di stack)
	let callerInfo = "Unknown";
	let fileInfo = "Unknown";
	let functionName = "anonymous";

	if (stackLines.length >= 4) {
		const callerLine = stackLines[3].trim();

		// Ekstrak informasi fungsi dan file
		// Format: "at functionName (file:///path/to/file.js:10:20)"
		const funcMatch = callerLine.match(/at\s+([^\s(]+)/);
		if (funcMatch && funcMatch[1] !== "trace") {
			functionName = funcMatch[1];
		}

		// Ekstrak file path dan line number
		const fileMatch = callerLine.match(/\((.*):(\d+):(\d+)\)/);
		if (fileMatch) {
			const fullPath = fileMatch[1];
			// Ambil hanya nama file
			const fileName = fullPath.split('/').pop() || fullPath.split('\\').pop() || fullPath;
			const line = fileMatch[2];
			fileInfo = `${fileName}:${line}`;
		} else {
			// Format alternatif (tanpa parentheses)
			fileInfo = callerLine.replace('at ', '');
		}

		callerInfo = `${functionName} @ ${fileInfo}`;
	}

	// Header dengan informasi caller
	console.log(
		`%c =====TRACE%c ${label} %c| ${callerInfo}`,
		'background:#222;color:#00e676;font-weight:bold;padding:2px 6px;border-radius:4px 0 0 4px;',
		'color:#999;background:#333;padding:2px 8px;',
		'color:#aaa;font-size:11px;font-style:italic;padding:2px 8px;border-radius:0 4px 4px 0;'
		);

	// Data
	if (data !== null) {
		console.log(
			'%cDATA',
			'color:#03a9f4;font-weight:bold;',
			data
			);
	}

	// Stack trace dengan highlight
	console.log(
		'%cSTACK TRACE',
		'color:#ff5252;font-weight:bold;margin-top:8px;display:block;'
		);

	// Format stack trace agar lebih rapi
	const formattedStack = stackLines
	.slice(2, 8) // Ambil 6 baris mulai dari index 2
	.map((line, index) => {
		const trimmed = line.trim();

		// Highlight baris caller (index 1)
		if (index === 1) {
			return `%c▶ ${trimmed}`;
		}

		return `  ${trimmed}`;
	})
	.join('\n');

	// Print stack trace dengan styling
	console.log(
		formattedStack,
		'color:#00e676;font-weight:bold;' // Style untuk baris caller
		);

	// Separator
	console.log('%c' + '─'.repeat(60), 'color:#444;font-size:10px;');

	// Eksekusi callback
	return callback();
}