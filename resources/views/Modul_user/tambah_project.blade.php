
<style type="text/css">
	.btn_back_form{
		position: absolute;
		right: 0;
		top: 0;
		z-index: 99;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('')}}asset/css/tambah_project.css">

<section class="section_content" data-fungsi="tambah_project" style="position:relative;">
	<div class="header_page">
		<h1>
			Buat Project
		</h1>
	</div>


	{{-- Container tambah project --}}
	<div class="container_tambah_project">

		<div class="loader_page loader_tambah_project"></div>
		{{-- Ada di folder resource/view/template/form_tambah_project.blade.php --}}
		{{-- Form Submit --}}
		<form method="post" class="form_file_upload" id="form_tambah_project" action="project" style="position:relative">

			<div class="header_content_form">
				Form Project
			</div>
			{{-- Container content form --}}
			<div class="body_content_form" style="position: relative;">
				<input type="hidden" class="lat_input" name="lok_lat" value="none">
				<input type="hidden" class="long_input" name="lok_long" value="none">
				<input type="hidden" name="user_teknisi" value="none">
				<input type="hidden" name="user_client" value="none">


				{{-- Content Form - Form Teknisi --}}
				<div class="container-fluid content_form active" id="form_input">
					{{-- Row Form --}}
					<div class="row row_form">
						<div class="col-sm col_form_input">
							<div class="form-group">
								<label> Nama Project : </label>
								<input autosave type="text" name="nama_project" class="form-control" required placeholder="Nama Project">
							</div>
							<div class="form-group">
								<label> Product Project </label>
								<select class="form-control" name="id_produk">
									<!-- Ini akan ditambahkan dengan jvascript -->
									<option value="1"> Maintance Videotron </option>
								</select>
							</div>
							{{-- Form ini nanti akan diisi atau di manipulasi berdasarkan level yang melakukan submit --}}
							{{-- 							<div class="form-group">
								<label> User Client : </label>
								<input autosave type="text" name="user_client" class="form-control" required placeholder="User Client">
							</div> --}}
							<div class="form-group">
								<label> Waktu Project : </label>
								<input autosave type="date" name="waktu_mulai_project" class="form-control" required placeholder="Waktu Project ">
							</div>
							<div class="form-group">
								<label> Teknis Dokumen : </label>
								<div class="field_upload_custom" data-name-idFile="id_dokumen_project" data-name-sourceFile='source_dokumen_project'></div>
							</div>
							<div class="form-group">
								<label> Deskripsi Project : </label>
								<textarea style="height: 250px;" autosave name="deskripsi_project" class="form-control" required placeholder="Nama Project">
								</textarea>
							</div>
						</div>
						{{-- end of col form input  --}}

						{{-- col form maps --}}
						<div class="col-sm-7 col_form_maps">
							<div class="loader_page loader_update_lokasi"></div>
							<div class="form-group">
								<label> Lokasi Client : </label>
								<br>
								<button type="button" class="btn btn-primary btn_ambil_lokasi mb-3">
									Update Lokasi Kamu
								</button>
								<!-- Section monitoring maps -->
								<section class="monitoring_maps" id="maps_tambah_project">

									<iframe id="maps" style="border:0;"loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade">
									</iframe>

								</section>

							</div>
						</div>
						{{-- end of col form maps --}}
					</div>
					{{-- End Of Row Form --}}
				</div>
				{{-- End Of Content Form - Form Teknisi --}}
				{{-- Content Form - Form Rekom Teknisi --}}
				<div class="container-fluid content_form" id="form_rekom_teknisi">

					<button type="button" class="btn btn-primary btn_back_form">
						<i class="fas fa-arrow-left"></i>
					</button>

					{{-- Row Teknisi - Tempat Loop --}}
					<div class="row row_teknisi">
						{{--  INI DIISI OLEH JS SECARA ASYN API di 
						@for ($i = 0; $i < 20; $i++)
						<div class="col-12 col_teknisi" data-user-teknisi="{{$i}}">
							<div class="teknisi_img">
								<img src="{{ asset('asset/gam/user.png') }}">
							</div>
							<div class="teknisi_info">
								<p> Teknisi {{$i}} </p>
								<p> {{ $i+1 }} km </p>
								<button type="button" class="btn btn-success btn_pilih_teknisi"> Pilih </button>
							</div>
						</div>
						@endfor
						--}}
					</div>
					{{-- End Of Row Teknisi --}}
				</div>
				{{-- End Of Content Form - Form Rekom Teknisi --}}
			</div>
			{{-- End Of Container content form --}}

			<div class="form-group mt-5">
				<button type="submit" name="submit" class="btn btn-primary btn_submit_tambahProject form-control">
					Submit
				</button>
			</div>

		</form>
		{{-- End Of Form --}}


	</div>
	{{-- End Of Container tambah project --}}


</section>


