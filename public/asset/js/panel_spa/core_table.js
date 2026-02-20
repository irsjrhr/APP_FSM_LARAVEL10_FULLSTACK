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





function load_table_level( data = [] ) {
	trace('load_table_level');


	var row_struktur = {
		id_level: "",
		nama_level: "Beginner",
		user_admin : "DEBUG",
		waktu: "2025-03-25",
		status: "ACTIVE"
	};
	//Cek validasi data agar konsistensi
	var validasi_data_row = validasi_data( row_struktur, data ); 
	if ( validasi_data_row.param_data == false ) {
		//Data tidak tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
	}

	// Contoh data dummy
	var tableBody = $(".table_data").find('tbody');
	tableBody.empty(); // Bersihkan tabel sebelum menambahkan data baru
	var rowContent = "";

	for (var i = 0; i < data.length; i++) {
		var row = data[i];

		rowContent += `
		<tr>
		<td>
		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
		<div class="menu_opt">
		<div class="link_opt close_opt">Tutup</div>
		<a href="#" class="link_opt">
		<i class="fas fa-edit"></i> Edit
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-trash"></i> Hapus
		</a>
		</div>
		</td>
		<td>${i + 1}</td>
		<td>${row.nama_level}</td>
		<td>${row.waktu}</td>
		<td><div class="label ${row.status}">${row.status}</div></td>
		</tr>`;
	}

	tableBody.append(rowContent);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++
function load_table_account( data = [] ) {
	trace('load_table_account');

	// Contoh data JSON yang berasal dari server
	var row_struktur = {
		alamat: "NULL",
		email: "irshandy@gmail",
		id_file_profile: "",
		source_file_profile: "",
		id_user: "40",
		level: "user_guru",
		nama: "asd",
		password: "ada",
		status: "ACTIVE",
		user: "assdafa",
		user_pembuat: "REGISTER",
		waktu: "2024-12-24"
	};
	//Cek validasi data agar konsistensi
	var validasi_data_row = validasi_data( row_struktur, data ); 
	if ( validasi_data_row.param_data == false ) {
		//Data tidak tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
	}



	var tableBody = $(".table_data").find('tbody');
	tableBody.empty(); // Bersihkan tabel sebelum tambah data baru
	var rowContent = "";
	for (var i = 0; i < data.length; i++) {


		var row = data[i];
		var data_row_json = cv_obj_json( row );

		rowContent += `
		<tr data-row="${data_row_json}">
		<td>
		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
		<div class="menu_opt">
		<div class="link_opt close_opt">Tutup</div>
		<a href="#" class="link_opt update_data">
		<i class="fas fa-edit"></i> Edit
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-edit"></i> Update Level
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-trash"></i> Hapus
		</a>
		</div>
		</td>
		<td>${i + 1}</td>
		<td><img src="${row.source_file_profile}" class="profile"></td>
		<td>${row.user}</td>
		<td>${row.email}</td>
		<td>${row.nama}</td>
		<td>${row.level}</td>
		<td>${row.waktu}</td>
		<td><div class="label ${row.status}">${row.status}</div></td>
		</tr>`;
	}

	tableBody.append(rowContent);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++


function load_table_produk( data = [] ) {
	trace('load_table_produk');

	// Contoh data JSON yang berasal dari server
	var row_struktur = {
		id_produk : "NULL",
		nama_produk : "",
		deskripsi_produk : "",
		harga_produk : 0,
		id_file_thumb: "",
		source_file_thumb: "",
		user_pembuat: "",
		status: "ACTIVE",
		waktu: "2024-12-24"
	};
	//Cek validasi data agar konsistensi
	var validasi_data_row = validasi_data( row_struktur, data ); 
	if ( validasi_data_row.param_data == false ) {
		//Data tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
	}

	var tableBody = $(".table_data").find('tbody');
	tableBody.empty(); // Bersihkan tabel sebelum tambah data baru
	var rowContent = "";
	for (var i = 0; i < data.length; i++) {

		var row = data[i];
		var data_row_json = cv_obj_json( row );

		rowContent += `
		<tr data-row="${data_row_json}">
		<td>
		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
		<div class="menu_opt">
		<div class="link_opt close_opt">Tutup</div>
		<a href="#" class="link_opt update_data">
		<i class="fas fa-edit"></i> Edit
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-trash"></i> Hapus
		</a>
		</div>
		</td>
		<td>${i + 1}</td>
		<td>${row.id_produk}</td>
		<td>${row.nama_produk}</td>
		<td>${row.harga_produk}</td>
		<td><img src="${row.source_file_thumb}" class="thumb"></td>
		<td>${row.user_pembuat}</td>
		<td>${row.waktu}</td>
		<td><div class="label ${row.status}">${row.status}</div></td>
		</tr>`;
	}

	tableBody.append(rowContent);
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++
function load_table_teknisi( data = [] ) {
	trace('load_table_teknisi');

	// Contoh data JSON yang berasal dari server
	var row_struktur = {
		id_user_teknisi : "NULL",
		user : "",
		lok_long : "",
		lok_lat : "",
		status_teknisi : "READY",
		last_update_lacak : "",
		user_pembuat : "",
		status : "",
		waktu : ""
	};
	//Cek validasi data agar konsistensi
	var validasi_data_row = validasi_data( row_struktur, data ); 
	if ( validasi_data_row.param_data == false ) {
		//Data tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
	}

	var tableBody = $(".table_data").find('tbody');
	tableBody.empty(); // Bersihkan tabel sebelum tambah data baru
	var rowContent = "";
	for (var i = 0; i < data.length; i++) {

		var row = data[i];
		var data_row_json = cv_obj_json( row );

		rowContent += `
		<tr data-row="${data_row_json}">
		<td>
		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
		<div class="menu_opt">
		<div class="link_opt close_opt">Tutup</div>
		<a href="#" class="link_opt update_data">
		<i class="fas fa-edit"></i> Edit
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-trash"></i> Hapus
		</a>
		</div>
		</td>
		<td>${i + 1}</td>
		<td>${row.id_user_teknisi}</td>
		<td>${row.user}</td>
		<td>${row.lok_long}</td>
		<td>${row.lok_lat}</td>
		<td>${row.status_teknisi}</td>
		<td>${row.last_update_lacak}</td>
		<td>${row.user_pembuat}</td>
		<td>${row.waktu}</td>
		<td>
		<div class="label ${row.status}">
		${row.status}
		</div>
		</td>
		</tr>`;
	}

	tableBody.append(rowContent);
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++
function load_table_project(data = []) {
	trace('load_table_project');

	var row_struktur = {
		id_project: "NULL",
		id_produk: "",
		user_teknisi: "",
		user_client: "",
		nama_project: "",
		deskripsi_project: "",
		id_dokumen_project: "",
		source_dokumen_project: "",
		lok_long: "",
		lok_lat: "",
		waktu_mulai_project: "",
		waktu_selesai_project: "",
		status_project: "",
		user_pembuat: "",
		waktu: "",
		status: "ACTIVE"
	};

	var validasi_data_row = validasi_data(row_struktur, data);
	if (validasi_data_row.param_data == false) {
		return validasi_data_row.param_data;
	}

	var tableBody = $(".table_data").find('tbody');
	tableBody.empty();
	var rowContent = "";
	var BUTTON_APPROVE_PENDING;
	for (var i = 0; i < data.length; i++) {
		var row = data[i];
		var data_row_json = cv_obj_json(row);

		if ( row.status_project == "PENDING" ) {
			BUTTON_APPROVE_PENDING = `
			<button class="btn btn-primary btn_aprove_project"> APRROVE </button>
			`;
		}else{
			BUTTON_APPROVE_PENDING = "";
		}


		rowContent += `
		<tr data-row="${data_row_json}">
		<td>
		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
		<div class="menu_opt">
		<div class="link_opt close_opt">Tutup</div>
		<a href="#" class="link_opt update_data">
		<i class="fas fa-edit"></i> Edit
		</a>
		<a href="#" class="link_opt">
		<i class="fas fa-trash"></i> Hapus
		</a>
		</div>
		</td>
		<td>${i + 1}</td>
		<td>${row.id_project}</td>
		<td>${row.id_produk}</td>
		<td>${row.user_teknisi}</td>
		<td>${row.user_client}</td>
		<td>${row.nama_project}</td>
		<td>${row.deskripsi_project}</td>
		<td>${row.id_dokumen_project}</td>
		<td>
		<button class="btn btn-primary btn_modal_view" data-href="${row.source_dokumen_project}">
		<i class="fas fa-eye"></i>
		</button>
		</td>
		<td>${row.lok_long}</td>
		<td>${row.lok_lat}</td>
		<td>${row.waktu_mulai_project}</td>
		<td>${row.waktu_selesai_project}</td>
		<td>${row.status_project} ${BUTTON_APPROVE_PENDING} </td>
		<td>${row.user_pembuat}</td>
		<td>${row.waktu}</td>
		<td><div class="label ${row.status}">${row.status}</div></td>
		</tr>`;
	}

	tableBody.append(rowContent);
}





































// function load_table_transaksi_kategori( data = [] ) {

	// 	var row_struktur = {
		// 		id_transaksi_kategori: "Beginner",
		// 		user_admin : "DEBUG",
		// 		nama_transaksi_kategori: "Beginner",
		// 		deskripsi_transaksi_kategori: "Beginner",
		// 		waktu: "2025-03-25",
		// 		status: "ACTIVE"
		// 	};
		// 	//Cek validasi data agar konsistensi
		// 	var validasi_data_row = validasi_data( row_struktur, data ); 
		// 	if ( validasi_data_row.param_data == false ) {
			// 		//Data tidak tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
			// 		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
			// 	}

			// 	// Contoh data dummy
			// 	var tableBody = $(".table_data").find('tbody');
			// 	tableBody.empty(); // Bersihkan tabel sebelum menambahkan data baru
			// 	var rowContent = "";

			// 	for (var i = 0; i < data.length; i++) {
				// 		var row = data[i];
				// 		var data_row_json = cv_obj_json( row );


				// 		rowContent += `
				// 		<tr data-row="${data_row_json}">
				// 		<td>
				// 		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
				// 		<div class="menu_opt">
				// 		<div class="link_opt close_opt">Tutup</div>
				// 		<a href="#" class="update_data link_opt">
				// 		<i class="fas fa-edit"></i> Edit
				// 		</a>
				// 		<a href="#" class="link_opt">
				// 		<i class="fas fa-trash"></i> Hapus
				// 		</a>
				// 		</div>
				// 		</td>
				// 		<td>${i + 1}</td>
				// 		<td>${ row.id_transaksi_kategori }</td>
				// 		<td>${row.user_admin}</td>
				// 		<td>${row.nama_transaksi_kategori}</td>
				// 		<td>${row.deskripsi_transaksi_kategori}</td>
				// 		<td>${row.waktu}</td>
				// 		<td><div class="label ${row.status}">${row.status}</div></td>
				// 		</tr>`;
				// 	}

				// 	tableBody.append(rowContent);
				// }

				// //+++++++++++++++++++++++++++++++++++++++++++++++++++

				// function load_table_transaksi_pemasukan( data = [] ) {


					// 	var row_struktur = {
						// 		id_transaksi_pemasukan: "",
						// 		id_transaksi_kategori: "Beginner",
						// 		user_admin : "DEBUG",
						// 		nama_transaksi: "Beginner",
						// 		nominal_transaksi: "Beginner",
						// 		catatan_transaksi: "Beginner",
						// 		waktu_transaksi: "Beginner",
						// 		id_file: "Beginner",
						// 		source_file: "Beginner",
						// 		waktu: "2025-03-25",
						// 		status: "ACTIVE"
						// 	};
						// 	//Cek validasi data agar konsistensi
						// 	var validasi_data_row = validasi_data( row_struktur, data ); 
						// 	if ( validasi_data_row.param_data == false ) {
							// 		//Data tidak tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
							// 		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
							// 	}

							// 	// Contoh data dummy
							// 	var tableBody = $(".table_data").find('tbody');
							// 	tableBody.empty(); // Bersihkan tabel sebelum menambahkan data baru
							// 	var rowContent = "";

							// 	for (var i = 0; i < data.length; i++) {
								// 		var row = data[i];
								// 		var data_row_json = cv_obj_json( row );


								// 		rowContent += `
								// 		<tr data-row="${data_row_json}">
								// 		<td>
								// 		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
								// 		<div class="menu_opt">
								// 		<div class="link_opt close_opt">Tutup</div>
								// 		<a href="#" class="update_data link_opt">
								// 		<i class="fas fa-edit"></i> Edit
								// 		</a>
								// 		<a href="#" class="link_opt">
								// 		<i class="fas fa-trash"></i> Hapus
								// 		</a>
								// 		</div>
								// 		</td>
								// 		<td>${i + 1}</td>
								// 		<td>${ row.id_transaksi_pemasukan }</td>
								// 		<td>${ row.id_transaksi_kategori }</td>
								// 		<td>${row.user_admin}</td>
								// 		<td>${row.nama_transaksi}</td>
								// 		<td>${ formatRupiah(row.nominal_transaksi) }</td>
								// 		<td>${row.catatan_transaksi}</td>
								// 		<td>
								// 		<div class="btn btn-primary btn_modal_view" data-href="${row.source_file}" target="_blank"> 
								// 		<i class="fas fa-eye"> </i>
								// 		</div>
								// 		</td>
								// 		<td>${row.waktu_transaksi}</td>
								// 		<td>${row.waktu}</td>
								// 		<td><div class="label ${row.status}">${row.status}</div></td>
								// 		</tr>`;
								// 	}

								// 	tableBody.append(rowContent);
								// }

								// //+++++++++++++++++++++++++++++++++++++++++++++++++++

								// function load_table_transaksi_pengeluaran( data = [] ) {


									// 	var row_struktur = {
										// 		id_transaksi_pengeluaran: "",
										// 		id_transaksi_kategori: "Beginner",
										// 		user_admin : "DEBUG",
										// 		nama_transaksi: "Beginner",
										// 		nominal_transaksi: "Beginner",
										// 		catatan_transaksi: "Beginner",
										// 		waktu_transaksi: "Beginner",
										// 		id_file: "Beginner",
										// 		source_file: "Beginner",
										// 		waktu: "2025-03-25",
										// 		status: "ACTIVE"
										// 	};
										// 	//Cek validasi data agar konsistensi
										// 	var validasi_data_row = validasi_data( row_struktur, data ); 
										// 	if ( validasi_data_row.param_data == false ) {
											// 		//Data tidak tidak bisa di load di table, karena persyaratan yang tidak terpenuhi. 
											// 		return validasi_data_row.param_data; //Menghentikan jalan fungsi 
											// 	}

											// 	// Contoh data dummy
											// 	var tableBody = $(".table_data").find('tbody');
											// 	tableBody.empty(); // Bersihkan tabel sebelum menambahkan data baru
											// 	var rowContent = "";

											// 	for (var i = 0; i < data.length; i++) {
												// 		var row = data[i];
												// 		var data_row_json = cv_obj_json( row );


												// 		rowContent += `
												// 		<tr data-row="${data_row_json}">
												// 		<td>
												// 		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
												// 		<div class="menu_opt">
												// 		<div class="link_opt close_opt">Tutup</div>
												// 		<a href="#" class="update_data link_opt">
												// 		<i class="fas fa-edit"></i> Edit
												// 		</a>
												// 		<a href="#" class="link_opt">
												// 		<i class="fas fa-trash"></i> Hapus
												// 		</a>
												// 		</div>
												// 		</td>
												// 		<td>${i + 1}</td>
												// 		<td>${ row.id_transaksi_pengeluaran }</td>
												// 		<td>${ row.id_transaksi_kategori }</td>
												// 		<td>${row.user_admin}</td>
												// 		<td>${row.nama_transaksi}</td>
												// 		<td>${ formatRupiah(row.nominal_transaksi) }</td>
												// 		<td>${row.catatan_transaksi}</td>
												// 		<td>
												// 		<div class="btn btn-success btn_download" data-href="${row.source_file}" target="_blank"> 
												// 		<i class="fas fa-download"> </i>
												// 		</div>
												// 		</td>
												// 		<td>${row.waktu_transaksi}</td>
												// 		<td>${row.waktu}</td>
												// 		<td><div class="label ${row.status}">${row.status}</div></td>
												// 		</tr>`;
												// 	}

												// 	tableBody.append(rowContent);
												// }


												// // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
												// function load_table_transaksi_pembayaran(data = []) {
													// 	var row_struktur = {
														// 		id_transaksi_pembayaran: "",
														// 		user_admin: "DEBUG",
														// 		nama_item: "Sample",
														// 		harga: 0,
														// 		qty: 0,
														// 		total_harga: 0,
														// 		nama_pembeli: "Sample",
														// 		alamat_pembeli: "Sample",
														// 		email_pembeli: "sample@email.com",
														// 		waktu_bayar: "2025-03-25",
														// 		order_id_midtrans: "ORD-123",
														// 		status_pembayaran: "pending",
														// 		waktu: "2025-03-25",
														// 		status: "ACTIVE"
														// 	};

														// 	var validasi_data_row = validasi_data(row_struktur, data); 
														// 	if (!validasi_data_row.param_data) {
															// 		return false;
															// 	}

															// 	var tableBody = $(".table_data").find('tbody');
															// 	tableBody.empty();
															// 	var rowContent = "";

															// 	for (var i = 0; i < data.length; i++) {
																// 		var row = data[i];
																// 		var data_row_json = cv_obj_json(row);

																// 		rowContent += `
																// 		<tr data-row='${data_row_json}'>
																// 		<td>
																// 		<button class="btn btn-default btn_opt"><i class="fas fa-ellipsis-v"></i></button>
																// 		<div class="menu_opt">
																// 		<div class="link_opt close_opt">Tutup</div>
																// 		<a href="#" class="update_data link_opt">
																// 		<i class="fas fa-edit"></i> Edit
																// 		</a>
																// 		<a href="#" class="buat_pembayaran link_opt">
																// 		<i class="fas fa-wallet"></i> Buat Pembayaran
																// 		</a>
																// 		<a href="#" class="update_status_pembayaran link_opt">
																// 		<i class="fas fa-cog"></i> Update Status Pembayaran
																// 		</a>
																// 		<a href="#" class="link_opt">
																// 		<i class="fas fa-trash"></i> Hapus
																// 		</a>
																// 		</div>
																// 		</td>
																// 		<td>${i + 1}</td>
																// 		<td>${row.id_transaksi_pembayaran}</td>
																// 		<td>${row.user_admin}</td>
																// 		<td>${row.nama_item}</td>
																// 		<td>${ formatRupiah(row.harga) }</td>
																// 		<td>${row.qty}</td>
																// 		<td>${ formatRupiah(row.total_harga) }</td>
																// 		<td>${row.nama_pembeli}</td>
																// 		<td>${row.alamat_pembeli}</td>
																// 		<td>${row.email_pembeli}</td>
																// 		<td>${row.waktu_bayar}</td>
																// 		<td>${row.order_id_midtrans}</td>
																// 		<td><div class="label ${row.status_pembayaran}">${row.status_pembayaran}</div></td>
																// 		<td>${row.waktu}</td>
																// 		<td><div class="label ${row.status}">${row.status}</div></td>
																// 		</tr>`;
																// 	}

																// 	tableBody.append(rowContent);
																// }



