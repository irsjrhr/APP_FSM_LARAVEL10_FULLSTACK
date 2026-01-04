
// LAT = "-6.1753924", LONG = "106.827153";
$(document).ready(function() {

    maps_update();

    //Menghilangkan  event DOM form submit yang teerdaftar pada admin.js
    // $('form#form_tambah_project').off();

    var link_menu_first = $('.sidebar').find('.link_menu').first();
    var data_page = link_menu_first.attr('data-page');
    load_page( BASE_URL_PAGE + "admin/project", function() {
       $('#modal_tambah_project').modal('show');
   });
    // Submit Form 
    $('body').on('submit', '#form_tambah_project', function(e) {

        e.preventDefault();

        var loader_tambah_project = $('.loader_tambah_project');
        var lat_input = $('input.lat_input');
        var long_input = $('input.long_input');
        var user_teknisi_input = $('input[name=user_teknisi]');
        //pengecekan agar input lat, long, dan id teknisi diisi
        var lat = lat_input.val();
        var long = long_input.val();
        var user_teknisi = user_teknisi_input.val();

        // End Of Debug Value
        console.log( "lat ", lat );
        console.log( "long ", long );
        console.log( "user_teknisi ", user_teknisi );
        console.log('obj',  lat_input);
        //++++ End Of Debug Value

        //Cek apakah nilai lat, long, dan user teknisi sudah teisi atau belum
        if ( lat != "none" && long != "none" && user_teknisi != "none" ) {

            console.log('Validasi berhasil dilewati, tinggal submit form ke BE');
            //Jika semua input sudah terisi, maka submit api ke BE tambah project
            loader_page( 'show',  loader_tambah_project, "Membuat Project Baru ......");
            //Nanti settimeout itu adalah request POST api tambah project
            var form = $(this);
            var form_data = form.serialize();
            var action = form.attr('action');
            post_dataForm( action, form_data, function( response ) {
                console.log(response);
                var msg = response.msg;
                Swal.fire( msg );
                //Refresh data di table load 
                load_table_active();

                // setTimeout(function() {
                    //     Swal.fire( "Project berhasil dibuat!! Pantau project kamu." );
                    //     // load_page( BASE_URL_PAGE + "user/monitoring");
                    // },1000);

                });


        }else{
            //Jika ada input belum terisi atau ada lokasi atau teknisi yng masih ernilai none
            if ( lat == "none" || long == "none" ) {
                //Jika lokasinya belum di update, maka Pindah ke form input
                console.log('Terdeteksi lat dan long untuk lokasinya belum di update');
                open_form_input();
            }else if ( user_teknisi == "none" ){
                console.log('Terdeteksi teknisinya belum dipilih');
                //Jika id teknisi belum di pilih, maka Pindah ke form rekom teknisi
                open_form_rekom_teknisi();
            }
        }


    });
    // Event Pilih Teknisi
    $('body').on('click', '.btn_pilih_teknisi', function() {
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

    //Button ambil lokasi user
    $('body').on('click', '.btn_ambil_lokasi', function() {

        var loader_tambah_project = $('.loader_tambah_project');
        var lat_input = $('input.lat_input');
        var long_input = $('input.long_input');
        var user_teknisi_input = $('input[name=user_teknisi]');

        loader_page( 'show',  $('.loader_update_lokasi'), "Mengambil lokasi anda");
        get_lokasi_user( function( lat, long ) {
            lat_input.val( lat );
            long_input.val( long );
            //Update juga di visualiasi mapsnya
            maps_update( lat, long );

            console.log( "+====LOKASI TERUPDATE", lat + "," + long );
            loader_page( 'hide',  $('.loader_update_lokasi'), "");

        });
    });



}); 

var open_form_input = () =>{

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
var open_form_rekom_teknisi = () =>{
    console.log('+++++++++ Membuka .content_form #form_rekom_teknisi tambah project ++++++++ ');

    Swal.fire('Pilih teknisi yang tersedia!');
    var content_form = $('.content_form');
    var form_input = content_form.filter('#form_input');
    var form_rekom_teknisi = content_form.filter('#form_rekom_teknisi');
    var header_content_form = $('.header_content_form');
    var loader_tambah_project = $('.loader_tambah_project');

    header_content_form.text('Rekomendasi Teknisi');
    loader_page( 'show',  loader_tambah_project, "Mencari Teknisi");

    //Nanti settimeout itu adalah request GET api data teknisi rekomendasi 
    setTimeout(function() {
        loader_page( 'hide',  loader_tambah_project, "Mencari Teknisi");
        content_form.removeClass('active');
        form_rekom_teknisi.addClass('active');
    }, 3000);


}


