

<style type="text/css">
.main_container{
	max-width: 100% !important;
}
</style>

<section class="section_content" data-fungsi="monitoring" data-row-project='{"lok_lat":"-6.1753924","lok_long":"106.827153"}'>
	<div class="header_page">
		<h1>
			Monitoring
		</h1>
	</div>

	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-5">
				<div class="container_option">
					<form id="form_monitoring">
						<div class="form-group">
							<input type="text" class="form-control" name="monitoring_id_project" placeholder="Masukkan ID Project">
						</div>
						<button class="btn btn-secondary btn_submit_opt">
							<i class="fas fa-search"></i>
						</button>
					</form>
				</div>
			</div>
		</div>


		{{-- Row Project --}}
		<div class="row" id="row_card_project">
			{{-- Col Card --}}
			<div class="col col_card">
				<!-- card project - data_project -->
				<div class="card card_project" id="card_data_project">
					<div class="card-header">
						<h5> Info Project </h5>
						<i class="fas fa-info"></i>
					</div>
					<div class="card-body">
						<div class="section_btn">
							<button class="btn btn-primary btn_lacak_project mb-3" style="width:100%">
								Lacak
							</button> 
						</div>
						<div class="card_table" style="max-height: 200px;overflow: auto;">
							
							<table class="table">
								<tbody>
									<tr class="row_project_judul">
										<th class="judul"> Judul  </th>   
										<td class="value" id="nama_project">-</td>
									</tr>
									<tr class="row_project_status">
										<th class="judul"> Status  </th>   
										<td class="value" id="status_project" style="font-style:italic;">-</td>   
									</tr>
									<tr class="row_project_mulai">
										<th class="judul"> Waktu Mulai Project  </th>   
										<td class="value" id="waktu_mulai_project">-</td>   
									</tr>
									<tr class="row_project_selesai">
										<th class="judul"> Waktu Selesai Project  </th>   
										<td class="value" id="waktu_selesai_project">-</td>   
									</tr>
									<tr class="row_project_lokasiLat">
										<th class="judul"> Lat  </th>   
										<td class="value" id="project_lat">
											-
										</td>   
									</tr>
									<tr class="row_project_lokasiLong">
										<th class="judul"> Long  </th>   
										<td class="value" id="project_long">
											-
										</td> 
									</tr>
									<tr class="row_project_dokumen">
										<th class="judul"> Dokumen </th>   
										<td class="value"><a href="#" target="_blank" id="source_dokumen_project">Lihat File</a></td>   
									</tr>
								</tbody>
							</table>
						</div>

					</div>
				</div>
				<!-- end of card project - data_project -->
			</div>
			{{-- End Of Col Card --}}

			{{-- Col Maps --}}
			<div class="col col_maps">
				<!-- Section monitoring maps -  Maps Teknisi -->
				<section class="monitoring_maps" id="maps_project">
					<iframe id="maps" style="border:0;"loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade">
					</iframe>
				</section>
				<!-- End Of Section monitoring maps - Maps Teknisi -->
			</div>
		</div>
		{{-- End Of Row Project --}}

	</div>



</section>


