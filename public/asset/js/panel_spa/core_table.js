//+++++++++++++++++++++++++++++++++++++++++++++++++++
function formatRupiah(angka) {
	if (angka === null || angka === undefined) return "Rp 0";
	return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
function isSameStructure(row_struktur, row_response) {
	let keys_struktur = Object.keys(row_struktur);
	let keys_response = Object.keys(row_response);

	// cek apakah semua key_struktur ada di key_response
	return keys_struktur.every(key => keys_response.includes(key));
}
function checkSameStructure(row_struktur, row_response) {
	let keys_struktur = Object.keys(row_struktur);
	let keys_response = Object.keys(row_response);

	// cari key yang hilang
	let missingKeys = keys_struktur.filter(key => !keys_response.includes(key));

	return {
		isValid: missingKeys.length === 0,
		missing: missingKeys
	};
	
}
//Melakukan validasi data agar data response yang diterima itu konsisten sama dengan data yang ditentukan pada setiap table
//Intinya struktur object row_struktur harus ada/dimiliki oleh row dari data_response. Selama itu terpenuhi, walaupun di row data response nya itu ada property tambahan yang tidak ada di dalam row_strutkur, maka itu tidak apa
/*	
Misal :
row_struktur = { id : "shandy", nama : "andi" }
row_response = { id : "shandy", nama : "andi", umur : 20 }
Ini Diperbolehkan, karena property row_struktur itu dimiliki oleh row_response dan itu sudah cukup

*/
function validasi_data( row_struktur, data_reponse ) {
	//Cek struktur data_reponse dari data_reponse yang diterima agar terjadi konsistensi data_reponse 
	//Mengecek apakah row_struktur yang di tentukan sama strukturnya dengan row pada data_response yang diterima, dan kalo mau bener harus sama strukturnya.
	// Row responsenya adalah row index pertama di data_response dan makanya data_response gak boleh kosong.
	var param_data = true;
	var msg_false;
	if ( data_reponse.length > 0 ) {
		// Jika datanya ada, maka ambil 
		var row_response = data_reponse[0];

		var checkSameStructure_valid = checkSameStructure( row_struktur, row_response );
		if ( checkSameStructure_valid.isValid == true ) {
			//Struktur data_reponse sama
			param_data = true;
		}else{
			//Struktur data_reponse tidak sama
			param_data = false;
			msg_key_missing = checkSameStructure_valid['missing'],
			msg_false = "Strukur data_reponse yang di terima tidak sesuai dengan struktur data_reponse yang telah ditentukan sebelumnya! Cek Console";
		}

		console.log("+++++++ Validasi Struktur ++++++++");
		if ( param_data == false ) {
			console.error( msg_false );
			console.error( msg_key_missing );
			alert( msg_false );
		}
		console.log("Row Strukur", row_struktur);
		console.log("Row Response", row_response);
		console.log("+++++++ End Validasi Struktur ++++++++");


	}else{
		msg_false = "Tidak ada data_reponse yang di terima";
		param_data = false;
	}

	return { 
		param_data : param_data,
		msg_false : msg_false,
	}
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









