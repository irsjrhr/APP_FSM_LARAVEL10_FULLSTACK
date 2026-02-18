var LAT = "", LONG = "";

$(document).ready(function() {

	SET_LAT_LONG( "", "" );
	maps_update();	

	// Ini dijalankan ketika monitoring untuk ambil atau lacak lokasi project atau teknisi
	$('body').on('click', '.btn_lacak_project, .btn_lacak_teknisi', function(e) {

		trace();

		var btn_lacak = $(this);
		var section_content_teknisi = $('.section_content[data-fungsi=monitoring]');
		var data_row_project = section_content_teknisi.attr('data-row-project');
		// alert( '' );
		// console.log("+++++++++++++++");
		// console.log( data_row_project );
		data_row_project = cv_json_obj( data_row_project );

		var id_monitoring_maps;
		if ( btn_lacak.is('.btn_lacak_project') ) {
			id_monitoring_maps = "#maps_project";
			lat = data_row_project.project_lat;
			long = data_row_project.project_long;
		}else if ( btn_lacak.is('.btn_lacak_teknisi')) {
			id_monitoring_maps = "#maps_teknisi";
			lat = data_row_project.teknisi_lat;
			long = data_row_project.teknisi_long;
		}

		// alert( lat + " , " +long );

		maps_update( id_monitoring_maps, lat, long );
	});

}); 


//Mengambil dan merendering data project berdasarkan id project
function get_data_project( id_project, callback = false ) {
	trace();


	if ( callback == false ) {
		callback = function() {
			return 1;
		}
	}
	var endpoint = URL_SERVICE_BE + "project";
	get_row( endpoint, data_param = {	
		monitoring_project : true,
		by_id_project : id_project
	}, function(response) {	

		console.log('=++++++=====');
		console.log( response );



		callback( response );
	});

}











var SET_LAT_LONG = ( lat, long ) => {
	LAT = lat;
	LONG = long;
};
var maps_update = ( id_monitoring_maps = "#id_monitoring_maps", lat = LAT, long = LONG) => {

	trace();


	SET_LAT_LONG( lat, long );

	var monitoring_maps = $('.monitoring_maps');

	if ( monitoring_maps.filter( id_monitoring_maps ).length > 0 ) {
		monitoring_maps = monitoring_maps.filter( id_monitoring_maps );
	}else{
		console.log('+++++++++ TIDAK DITEMUKAN ID '+ id_monitoring_maps +' UNTUK MONITORING MAPS');
	}

	var maps = monitoring_maps.find('#maps');
	lat = lat.toString();
	long = long.toString();

	if ( lat.length > 0 && long.length > 0 ) {
		//Url embed maps dengan koordinat
		url = `https://www.google.com/maps?q=${lat},${long}&hl=id&z=15&output=embed`;
		console.log('ADA');
	}else {
		//Url embed maps tanpa koordinat maps default
		url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52739252.67058551!2d84.20547375!3d-2.4833827499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c5d1fdf2a5f7b2f%3A0x1030bfbca8b7a1b8!2sIndonesia!5e0!3m2!1sid!2sid!4v1700000000000';
		console.log('TIDAK ADA');
	}
	
	maps.attr('src', url);
}


// Ambil Lokasi 
async function getLocationValue() {
	return new Promise((resolve, reject) => {
		navigator.geolocation.getCurrentPosition(
			(pos) => {
				resolve({
					lat: pos.coords.latitude,
					long: pos.coords.longitude
				});
			},
			(err) => reject(err)
			);
	});
}
async function get_lokasi_user( callback = false ) {

	//Eror handling type data
	if ( callback == false ) {
		callback = function() {
			return 1;
		}
	}

	try {
		const lokasi = await getLocationValue();
		console.log("Latitude:", lokasi.lat);
		console.log("Longitude:", lokasi.long);

		callback( lokasi.lat, lokasi.long );
	} catch (e) {
		console.log("Error:", e.message);
	}
}





