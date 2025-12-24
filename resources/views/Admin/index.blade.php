@include('Admin.header')
@include('template.alert_flasher')
{{-- Disi Oleh JS SPA di core.js load_page() --}}
{{-- 
<section  class="section_content" data-fungsi="nama_method">
	<div class="header_page">
		<h1>
			Atur Level
		</h1>
	</div>

	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-md-5 box_dashboard">
				<div class="card">
					<i class="fas fa-book logo_back"></i>
					<h2 class="banyak_data"> 0 </h2>
					<h3> Level </h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12" style="max-width: 300px;">
				<table class="table table_option">
					<tr>
						<td style="display: flex;">
							<button class="btn btn-primary btn_load mr-2">
								<i class="fas fa-recycle"></i>
							</button>
							<button class="btn btn-default btn_tambah_data" data-toggle="modal" data-target="#modal_tambah">
								<i class="fas fa-plus"></i>
							</button>
						</td>
						<!-- Form Search -->
						<td>
							<div class="container_option">
								<form id="form_search">
									<div class="form-group">
										<input type="text" class="form-control" name="search_keyword" placeholder="By Nama Level">
									</div>
									<button class="btn btn-secondary btn_submit_opt">
										<i class="fas fa-search"></i>
									</button>
								</form>
							</div>
						</td>
						<!-- End Of Form Search -->

						<!-- Form Filter Status -->
						<td>
							<div class="container_option">
								<form class="form_filter" id="form_filter_status">
									<div class="form-group">
										<select class="form-control" name="filter_keyword">
											<option value="active"> Active </option>
											<option value="disabled"> Disabled </option>
										</select>
									</div>
									<button class="btn btn-warning btn_filter btn_submit_opt">
										<i class="fas fa-filter"></i>
									</button>
								</form>
							</div>
						</td>
						<!-- End Of Form Filter Status -->

					</tr>
				</table>
				<table class="table table_data">

					<thead>
						<tr class="row_header">
							<td> <i class="fas fa-cog"></i> </td>
							<th> No </th>
							<th> Nama Level </th>
							<th> Waktu </th>
							<th> Status </th>
						</tr>
					</thead>

					<tbody>
						<!-- Ditambahkan dengan jquery -->
					</tbody></table>
			</div>
		</div>
	</div>
</section>
 --}}
@include('Admin.footer')
@include('Admin.modal_menu')
@include('File.modal_select_file')