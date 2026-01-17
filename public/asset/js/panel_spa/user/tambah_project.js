

function cv_decimal(num, decimals = 2) {
    const factor = Math.pow(10, decimals);
    return Math.round((num + Number.EPSILON) * factor) / factor;
}


$(document).ready(function() {

    maps_update();

    //Button ambil lokasi user saat tambah project 
    $('body').on('click', '.btn_ambil_lokasi', function() {

        trace();


        var loader_tambah_project = $('.loader_tambah_project');
        var lat_input = $('input.lat_input');
        var long_input = $('input.long_input');
        var user_teknisi_input = $('input[name=user_teknisi]');

        loader_page( 'show',  $('.loader_update_lokasi'), "Mengambil lokasi anda");
        get_lokasi_user( function( lat, long ) {
            lat_input.val( lat );
            long_input.val( long );
            //Update juga di visualiasi mapsnya
            maps_update( '#maps_tambah_project', lat, long );

            console.log( "+====LOKASI TERUPDATE", lat + "," + long );
            loader_page( 'hide',  $('.loader_update_lokasi'), "");

        });
    });

    // Submit Form Tambah Project dan Pilih Teknisi Berdasarkan Rekomendasi Teknisi Haversine
    $('body').on('submit', '#form_tambah_project', function(e) {

        trace();


        e.preventDefault();

        var loader_tambah_project = $('.loader_tambah_project');
        var lat_input = $('input.lat_input');
        var long_input = $('input.long_input');
        var user_teknisi_input = $('input[name=user_teknisi]');
        //pengecekan agar input lat, long, dan id teknisi diisi
        var lat = lat_input.val();
        var long = long_input.val();
        var user_teknisi = user_teknisi_input.val(); // Ini akan diisi oleh event .btn_pilih_teknisi

        // End Of Debug Value
        console.log( "lat ", lat );
        console.log( "long ", long );
        console.log( "user_teknisi ", user_teknisi );
        console.log('obj',  lat_input);
        //++++ End Of Debug Value

        //Cek apakah nilai lat, long, dan user teknisi sudah teisi atau belum
        if ( lat != "none" && long != "none" && user_teknisi != "none" ) {

            //Jika semua validasi dan nilai wajib berhasil di input

            console.log('Validasi berhasil dilewati, tinggal submit form ke BE');
            //Jika semua input sudah terisi, maka submit api ke BE tambah project
            var form = $(this);

            //Ambil user_login untuk jadi user_client karena kan user yang melakukan tambah project ini di Controller User dan sudah pasti terdaftara dan rolenya user. Kemudian tambahkan isinya di form input hidden dengan name user_client
            var user_client = DATA_AUTH.user_login; 
            form.find('input[name=user_client]').val( user_client );
            var form_data = form.serialize();
            var action = form.attr('action');
            // loader_page( 'show',  loader_tambah_project, "Membuat Project Baru ......");
            post_dataForm( action, form_data, function( response ) {

                console.log(response);
                var msg = response.msg;
                Swal.fire( msg );

                //Setelah berhasil langsung arahkan ke list project user
                load_page( BASE_URL_PAGE + "user/project"); 

            });


        }else{
            //Jika ada input belum terisi atau ada lokasi atau teknisi yng masih ernilai none
            if ( lat == "none" || long == "none" ) {
                //Jika lokasinya belum di update, maka Pindah ke form input
                console.log('Terdeteksi lat dan long untuk lokasinya belum di update');
                open_form_input();
            }else if ( lat != "none" && long != "none" && user_teknisi == "none" ){
                console.log('Terdeteksi teknisinya belum dipilih');
                //Jika id teknisi belum di pilih, maka Pindah ke form rekom teknisi
                //Open form rekom teknisi bisa di buka ketika lat dan long sudah terisi dan user teknisinya memang belum dipilih
                console.log("Membuka rekom teknisi dengan lo" + lat + ", " + long  );
                open_form_rekom_teknisi( lat, long );
            }
        }


    });
    // Event Pilih Teknisi
    $('body').on('click', '.btn_pilih_teknisi', function() {
        trace();


        var col_teknisi = $('.col_teknisi');
        var btn_pilih_teknisi = $(this);
        var col_teknisi_target = btn_pilih_teknisi.parents('.col_teknisi');
        var data_user_teknisi = col_teknisi_target.attr('data-user-teknisi');

        //Update input id teknisi 
        $('input[name=user_teknisi]').val( data_user_teknisi );
        //Kasih Efek Untuk Teknisi
        col_teknisi.removeClass('active');
        col_teknisi_target.addClass('active');

    }); 


    //Event btn back to form input
    $('body').on('click', '.btn_back_form', function() {
        trace();
        //Event ini biss bekerja jika content form yang actve itu adalah yang form rekom
        if ( $('.content_form').filter('#form_rekom_teknisi').filter('.active').length > 0 ) {
            open_form_input();
        }
    });

}); 

var open_form_input = () =>{
    trace();


    console.log('+++++++++ Membuka .content_form #form_input tambah project ++++++++ ');

    Swal.fire('Lengkapi form dan update lokasi kamu!');
    var content_form = $('.content_form');
    var form_input = content_form.filter('#form_input');
    var form_rekom_teknisi = content_form.filter('#form_rekom_teknisi');
    var header_content_form = $('.header_content_form');

    header_content_form.text('Form Project');
    content_form.removeClass('active');
    form_input.addClass('active');
}
var open_form_rekom_teknisi = ( lat, long ) =>{

    trace();


    //REQUEST DATA TEKNISI BERDASARKAN LOKASI LAT DAN LONG MENGGUNAKAN ALGORITMA HAVERESINE

    console.log('+++++++++ Membuka .content_form #form_rekom_teknisi tambah project ++++++++ ');
    console.log('+++++++++ Melakukan rekomendasi teknisi menggunakan algoritma Haversine ++++++++ ');

    Swal.fire('Pilih teknisi yang tersedia!');
    var content_form = $('.content_form');
    var form_input = content_form.filter('#form_input');
    var form_rekom_teknisi = content_form.filter('#form_rekom_teknisi');
    var header_content_form = $('.header_content_form');
    var loader_tambah_project = $('.loader_tambah_project');

    header_content_form.text('Rekomendasi Teknisi');
    loader_page( 'show',  loader_tambah_project, "Mencari Teknisi");
    get_data( URL_SERVICE_BE + "teknisi", {  
        rekomendasi_teknisi : "true",  
        lat : lat,  
        long : long,  
    }, function(response) {
        setTimeout(function() {
            console.log( response );
            loader_page( 'hide',  loader_tambah_project, "Mencari Teknisi");

            //Menampilkan form rekom teknisi dan menutup form_input 
            form_input.removeClass('active');
            form_rekom_teknisi.addClass('active');

            //Menampilkan card teknisi berdasarkan data json yang di terima dari BE 
            var data_rekom_teknisi = response; 
            load_card_rekomTeknisi( data_rekom_teknisi );
        }, 100);
    }); 

};


function load_card_rekomTeknisi( data_rekom_teknisi = []) {

    trace();


    var form_rekom_teknisi = $( '#form_rekom_teknisi' );
    var el_row_teknisi = form_rekom_teknisi.find('.row_teknisi');
    for (var i = 0; i < data_rekom_teknisi.length; i++) {
        var row_rekom_teknisi = data_rekom_teknisi[i];  
        // Simpan ke variabel biasa satu per satu
        var id_user_teknisi = row_rekom_teknisi.id_user_teknisi;
        var user = row_rekom_teknisi.user;
        var lok_lat = cv_decimal(row_rekom_teknisi.lok_lat);
        var lok_long = cv_decimal(row_rekom_teknisi.lok_long);
        var status_teknisi = row_rekom_teknisi.status_teknisi;
        var last_update_lacak = row_rekom_teknisi.last_update_lacak;
        var user_pembuat = row_rekom_teknisi.user_pembuat;
        var waktu = row_rekom_teknisi.waktu;
        var status = row_rekom_teknisi.status;
        var jarak_km = cv_decimal(row_rekom_teknisi.jarak_km);
        var nama = row_rekom_teknisi.nama;
        var source_file_profile = row_rekom_teknisi.source_file_profile;
        

        //Implementasi ke card teknisi
        var el_card_teknisi = `<div class="col-12 col_teknisi" data-user-teknisi="${ user }">
        <div class="teknisi_img">
        <img src="${source_file_profile}">
        </div>
        <div class="teknisi_info">
        <p> ${ nama } </p>
        <p> ${ jarak_km } km dari jarak kamu </p>
        <button type="button" class="btn btn-success btn_pilih_teknisi"> Pilih </button>
        </div>
        </div>`;

        //Tambahkan cardnya 
        el_row_teknisi.append( el_card_teknisi );
    }



}

