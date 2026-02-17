function load_table_project(data = []) {

	trace();

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
	for (var i = 0; i < data.length; i++) {
		var row = data[i];
		var data_row_json = cv_obj_json(row);

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
		<td>${row.status_project} </td>
		<td>${row.user_pembuat}</td>
		<td>${row.waktu}</td>
		<td><div class="label ${row.status}">${row.status}</div></td>
		</tr>`;
	}

	tableBody.append(rowContent);
}


