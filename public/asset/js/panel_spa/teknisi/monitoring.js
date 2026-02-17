$(document).ready(function() {

	$('body').on('submit', '#form_monitoring', function(e) {
		e.preventDefault();
		var input_id_project = $('input[name=monitoring_id_project]');
		var id_project = input_id_project.val();
		get_data_project(id_project, function(row_project) {
			//Taro ke aatribut data-row-project section_content untuk jadi sumber bahan lacak
			$('.section_content').attr('data-row-project', cv_obj_json( row_project ));

			//Rendering ke UI  dari row project yang diterima untuk data_project
			$("#nama_project").text(row_project.nama_project);
			$("#status_project").text(row_project.status_project);
			$("#waktu_mulai_project").text(row_project.waktu_mulai_project || "-");
			$("#waktu_selesai_project").text(row_project.waktu_selesai_project || "-");
			$("#user_teknisi").text(row_project.user_teknisi);
			$("#source_dokumen_project").attr("href", row_project.source_dokumen_project);
			$("#deskripsi_project").text(row_project.deskripsi_project);
			$("#project_lat").text(row_project.project_lat);
			$("#project_long").text(row_project.project_long);

		});
	});


});