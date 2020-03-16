@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Menu Tambah Uang Muka Kerja
			</h3>
		</div>
	</div>
	<div class="">
		<div class="card-body table-responsive" >
		<!--begin: Datatable -->
		<div id="body-form">
						<form  class="kt-form" id="form-tambah-umk"  enctype="multipart/form-data" >
							{{csrf_field()}}
                            <input readonly hidden type="text" name="flag_edit" id="flag_edit">	
							<div class="kt-portlet__body">
								<div class="form-group form-group-last">
									<div class="alert alert-secondary" role="alert">
										<div class="alert-text">
										<!-- data input -->
																
											<div class="form-group row">
												<label class="col-form-label"></label>
																		
											</div>
											<div class="form-group row">
												<label class="col-1 col-form-label">No. UMK</label>
												<label class="col-form-label">:</label>
												<div class="col-4">
													<?php $a = str_replace('/', '-', $no_umk); ?>
													<input  class="form-control" type="hidden" value="{{$a}}" id="no_umk_details"  size="25" maxlength="25" readonly>
													<input  class="form-control" type="text" value="{{$no_umk}}" id="no_umk" name="no_umk" size="25" maxlength="25" readonly>
												</div>

												<label class="col-1 col-form-label"></label>
												<label class="col-1 col-form-label">Tanggal</label>
												<div class="col-3">
													<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="datepicker" id="tgl_panjar" size="15" maxlength="15">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-1 col-form-label">Jenis Uang Muka</label>
												<label class="col-form-label">:</label>
												<div class="col-3">
													<select class="form-control" id="jenis_um" name="jenis_um">
														<option value="">-Pilih-</option>
														<option value="K">Uang Muka Kerja</option>
														<option value="D">Uang Muka Dinas</option>
													</select>
												</div>

												<label class="col-2 col-form-label"></label>
												<label class="col-1 col-form-label">Bulan Buku</label>
												<div class="col-3">
													<input class="form-control" type="text" value="" data-date-format="yyyymm" id="bulan_buku" name="bulan_buku" size="6" maxlength="6">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-1 col-form-label">No. Panjar</label>
												<label class="col-form-label">:</label>
												<div class="col-2">
													<input class="form-control" type="text" value="" name="no_panjar" id="no_panjar">
												</div>

												<label class=" col-form-label"></label>
												<label class=" col-form-label">Mata Uang</label>
												<div class="col-2">
													<input class="form-control" type="text" value="" name="ci" id="ci" size="1" maxlength="1" >
												</div>

												<label class="col-1 col-form-label"></label>
												<label class=" col-form-label">Kurs</label>
												<div class="col-2">
													<input class="form-control" type="text" value="" name="kurs" id="kurs" size="10" maxlength="10">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-1 col-form-label">Untuk</label>
												<label class="col-form-label">:</label>
												<div class="col-4">
													<input  class="form-control" type="text" value="" name="untuk" id="untuk" size="70" maxlength="200">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-1 col-form-label">Jumlah</label>
												<label class="col-form-label">:</label>
												<div class="col-4">
													<input  class="form-control" type="text" value="" name="jumlah" id="jumlah" size="16" maxlength="16"  readonly>
												</div>
											</div> 

											<div style="float:right;">
												<div class="kt-form__actions">
													<a  id="btn-cencel" class="btn btn-warning">Cancel</a>
													<button type="submit" id_umk="{{$no_umk}}" class="btn btn-brand">Save</button>
												</div>
											</div>
										<!-- data input -->
										</div>
									</div>
								</div>
							</div>
					</form>
				<div class="kt-section__content" id="body-table">
						<span class="kt-section__info" id="btn-add-umk-detail" >
							<div style="padding-left:15px;font-size:16px;float:left;color:blue;font-weight:bold;" id="card-title" >Detail Uang Muka Kerja</div>
													&nbsp;<div style="padding-left:25px;float:left;font-weight:bold; font-size:20px" >
								<a style="color:blue;" href="#" id="btn-cek-detail"    class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-plus-1"></span></a>
								<a style="color:green;" href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-writing"></span></a>
								<a style="color:red;" href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-delete"></span></a>
								</div>
						</span>
					<div class="card-body table-responsive">
						<table id="example2" class="table table-striped table-hover table-bordered">
							<thead >
								<tr style="color:#ffffff" bgcolor="#483D8B">
									<th style="color:#ffffff">No.</th>
									<th style="color:#ffffff">Keterangan</th>
									<th style="color:#ffffff">Account</th>
									<th style="color:#ffffff">Bagian</th>
									<th style="color:#ffffff">PK</th>
									<th style="color:#ffffff">JB</th>
									<th style="color:#ffffff">KK</th>
									<th style="color:#ffffff">Jumlah</th>
								</tr>
							</thead>
							<tbody>
													
							</tbody>
						</table>
					</div>
				</div>
			</div>

		<!--end: Datatable -->
		</div>
	</div>
</div>
</div>


@endsection
