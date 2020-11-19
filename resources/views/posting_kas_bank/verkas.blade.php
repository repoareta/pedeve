@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Verifikasi Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Verifikasi Kas Bank </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--mobile">

		<div class="kt-portlet__head kt-portlet__head">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Verifikasi Kas Bank
				</h3>				
			</div>
		</div>
		<div class="kt-portlet__body">
			<div class="form-group form-group-last">
				<div class="form-group row">
					<div class="col-3 alert alert-secondary">
						<ul style="margin-left:-50px" id="browser" class="filetree">
							<?php foreach($data_rsjurnal as $data_rsj){ ?>
							<li  class="closed"><span class="folder pointer-link kt-subheader__breadcrumbs-link">{{$data_rsj->store}}</span>
								<ul>
								<?php foreach(DB::table('kasdoc')->where('store',$data_rsj->store)->where('paid', 'Y')->where('verified','N')->orderBy('docno', 'asc')->get() as $data_doc){ ?>
								<!-- <li>{{$data_doc->docno}}</li> -->
								<li style="margin-left:-30px"><span class="file pointer-link kt-subheader__breadcrumbs-link" data-toggle="kt-tooltip" data-placement="top" title="Silahkan klik disini" style="cursor:hand"><a href="{{ route('postingan_kas_bank.verkas',['no' => str_replace('/', '-',$data_doc->docno),'id' =>$data_doc->verified])}}">{{$data_doc->docno}}</span></a></li>
								<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-9">
						<!--begin: Datatable -->
						<form  class="kt-form kt-form--label-right" id="form-create">
							{{csrf_field()}}
									<div class="alert alert-secondary" role="alert">
										<div class="alert-text">
											<h5 class="kt-portlet__head-title">
												Header Verifikasi Kas Bank
											</h5>	
										</div>
									</div>
								
									
									<div class="form-group row">
										<label for="spd-input" class="col-2 col-form-label">No</label>
										<div class="col-2">
											<input class="form-control" type="hidden" name="tanggal" value="{{ date('Y-m-d') }}" size="15" maxlength="15">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="mp" id="mp1" value="{{$mp}}"  readonly>
										</div>
										<div class="col-4">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nomor" id="nomor1" value="{{$nomor}}"  readonly>
										</div>
										<label for="spd-input" class="col-1 col-form-label">Sejumlah</label>
										<div class="col-3">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nilai" value="{{ $nilai}}" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="spd-input" class="col-2 col-form-label">Kode Bagian</label>
										<div class="col-2">
											<input class="form-control" type="text" name="bagian" id="bagian1" value="{{$bagian}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<div class="col-4">
											<input class="form-control" type="text" name="nama_bagian" value="{{$nama_bagian}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<label for="spd-input" class="col-1 col-form-label">Kurs</label>
										<div class="col-3">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="kurs" value="{{$kurs}}" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="spd-input" class="col-2 col-form-label">Jenis Kartu</label>
										<div class="col-2">
											<input class="form-control" type="text" name="jk" value="{{$jk}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<div class="col-4">
											<input class="form-control" type="text" name="namajk" value="{{$namajk}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<label for="spd-input" class="col-1 col-form-label">Currency</label>
										<div class="col-3">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="ci" value="{{$namaci}}" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun</label>
										<div class="col-2">
											<input class="form-control" type="text" name="bulan" value="{{$bulan}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<div class="col-2">
											<input class="form-control" type="text" name="tahun" value="{{$tahun}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<label for="spd-input" class="col-1 col-form-label">Nokas</label>
										<div class="col-2">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nokas" value="{{$nokas}}" readonly>
										</div>
										<div class="col-3">
											<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="namakas" value="{{$nama_kas}}" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="spd-input" class="col-2 col-form-label">{{$darkep}}</label>
										<div class="col-5">
											<input class="form-control" type="text" name="kepada" value="{{$kepada}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
										<label for="spd-input" class="col-2 col-form-label">Bo.Bukti</label>
										<div class="col-3">
											<input class="form-control" type="text" name="nobukti" value="{{$nobukti}}" readonly  style="background-color:#DCDCDC; cursor:not-allowed">
										</div>
									</div>
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-2"></div>
											<div class="col-10">
												<a  href="{{route('postingan_kas_bank.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
											</div>
										</div>
									</div>
								

							

								
							<div class="kt-portlet__head kt-portlet__head">
								<div class="kt-portlet__head-label">
									<span class="kt-portlet__head-icon">
										<i class="kt-font-brand flaticon2-line-chart"></i>
									</span>
									<h3 class="kt-portlet__head-title">
										Tabel Detail Kas Bank
									</h3>			
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
											@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',202)->limit(1)->get() as $data_akses)
											@if($docno<>"")
												@if($data_akses->tambah == 1)
												<a href="#" data-toggle="modal" data-target="#kt_modal_4">
													<span style="font-size: 2em;" class="kt-font-success">
														<i class="fas fa-plus-circle"></i>
													</span>
												</a>
												@endif

												@if($data_akses->rubah == 1)					
												<a href="#" id="editRow">
													<span style="font-size: 2em;" class="kt-font-warning">
														<i class="fas fa-edit"></i>
													</span>
												</a>
												@endif

											@endif
												@if($verified == "N")
													@if($data_akses->hapus == 1)
													<a href="#" id="deleteRow">
														<span style="font-size: 2em;" class="kt-font-danger">
															<i class="fas fa-times-circle"></i>
														</span>
													</a>
													@endif
												@endif
											@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-portlet__body">
								<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
									<thead class="thead-light">
										<tr>
											<th></th>
											<th>NO</th>
											<th>RINCIAN</th>	
											<th>KL</th>
											<th>SANPER</th>
											<th>BAGIAN</th>
											<th>PK</th>
											<th>JB</th>
											<th>JUMLAH</th>
											<th>CJ</th>	
										</tr>
									</thead>
									<tbody>
									@foreach($data_detail as $data_d)
										<tr>
											<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" docno="{{str_replace('/', '-', $data_d->docno)}}" lineno="{{$data_d->lineno}}" class="btn-radio" ><span></span></label></td>
											<td>{{$data_d->lineno}}</td>
											<td>{{$data_d->keterangan}}</td>
											<td>{{$data_d->lokasi}}</td>
											<td>{{$data_d->account}}</td>
											<td>{{$data_d->bagian}}</td>
											<td>{{$data_d->pk}}</td>
											<td>{{$data_d->jb}}</td>
											<td>{{number_format($data_d->totprice,2,'.',',')}}</td>
											<td>{{$data_d->cj}}</td>
										</tr>
									@endforeach
									</tbody>
									<tr>
										@if($docno<>"")
										<td colspan="2" align="left">
											@if($status1 == 'Y')
											<input id="status1" name="status1" value="N"  type="checkbox" <?php if($status1  == 'Y' ) echo 'checked' ; ?> > Verifikasi
											@else
											<input id="status1" name="status1" value="Y"  type="checkbox" > Verifikasi
											@endif
										</td>
										<td colspan="6" align="right">Jumlah Total : </td>
										<td colspan="2" ><?php echo number_format($jumlahnya, 2, ',', '.'); ?></td>
										@endif
									</tr>
								</table>
							</div>
						</form>
								<!--end: Datatable -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Tambah Menu Detail Kas/Bank</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
					<input  class="form-control" hidden type="text" value="{{$docno}}"  name="kode">
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$nu}}"  name="nourut" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Rincian</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="-"  size="35" maxlength="35" name="rincian" autocomplete='off'>
						</div>
					</div>
									
																					
					{{-- <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kd.Lapangan</label>
						<div  class="col-8" >
							<select name="lapangan"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_lapang as $data_lap)
								<option value="{{$data_lap->kodelokasi}}">{{$data_lap->kodelokasi}} - {{$data_lap->nama}}</option>
									@endforeach
							</select>
						</div>
					</div> --}}			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Sandi Perkiraan</label>
						<div  class="col-8" >
							<select name="sanper"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_sandi as $data_san)
								<option value="{{$data_san->kodeacct}}">{{$data_san->kodeacct}} - {{$data_san->descacct}}</option>
									@endforeach
							</select>
						</div>
					</div>			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<div  class="col-8" >
							<select name="bagian"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_bagian as $data_bag)
								<option value="{{$data_bag->kode}}">{{$data_bag->kode}} - {{$data_bag->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>		
					@if($mp == "P")
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="000000" size="6" maxlength="6" name="wo">
						</div>
					</div>	
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<div  class="col-8" >
							<select name="jnsbiaya" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_jenis as $data_jen)
								<option value="{{$data_jen->kode}}">{{$data_jen->kode}} - {{$data_jen->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>		

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="jumlah" size="16" maxlength="16"  autocomplete='off' oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C.Judex</label>
						<div  class="col-8" >
							<select name="cjudex"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_cjudex as $data_judex)
								<option value="{{$data_judex->kode}}">{{$data_judex->kode}} - {{$data_judex->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>	
					@else
					<input  class="form-control" type="hidden" value="000000" size="6" maxlength="6" name="wo">
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<div  class="col-8" >
							<select name="jnsbiaya" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_jenis as $data_jen)
								<option value="{{$data_jen->kode}}" <?php if($data_jen->kode  == '000000' ) echo 'selected' ; ?>>{{$data_jen->kode}} - {{$data_jen->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>		

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="jumlah" size="16" maxlength="16" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C.Judex</label>
						<div  class="col-8" >
							<select name="cjudex"  class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
									@foreach($data_cjudex as $data_judex)
								<option value="{{$data_judex->kode}}">{{$data_judex->kode}} - {{$data_judex->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>
					@endif
																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@if($verified == "N")
								<button type="submit" name="add" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
								@endif
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--begin::Modal Edit-->
<!--end::Modal-->
<div class="modal fade modal-edit-detail" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Edit Menu Detail Kas/Bank</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
			<form  class="kt-form " id="form-edit-detail"  enctype="multipart/form-data">
			{{csrf_field()}}
				<input  class="form-control" hidden type="text" value="{{$docno}}"  name="kode">
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$nu}}"  name="nourut" id="nourut" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Rincian</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="-"  size="35" maxlength="35" name="rincian" id="rincian" autocomplete='off' >
						</div>
					</div>
									
																					
					{{-- <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kd.Lapangan</label>
						<div  class="col-8" >
							<select name="lapangan" id="lapangan" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
									@foreach($data_lapang as $data_lap)
								<option value="{{$data_lap->kodelokasi}}">{{$data_lap->kodelokasi}} - {{$data_lap->nama}}</option>
									@endforeach
							</select>
						</div>
					</div> --}}			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Sandi Perkiraan</label>
						<div  class="col-8" >
							<select name="sanper" id="sanper" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_sandi as $data_san)
								<option value="{{$data_san->kodeacct}}">{{$data_san->kodeacct}} - {{$data_san->descacct}}</option>
									@endforeach
							</select>
						</div>
					</div>			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<div  class="col-8" >
							<select name="bagian" id="bagian" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
									@foreach($data_bagian as $data_bag)
								<option value="{{$data_bag->kode}}">{{$data_bag->kode}} - {{$data_bag->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>		
					@if($mp == "P")
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="000000" size="6" maxlength="6" name="wo" id="wo">
						</div>
					</div>	
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<div  class="col-8" >
							<select name="jnsbiaya" id="jnsbiaya" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_jenis as $data_jen)
								<option value="{{$data_jen->kode}}">{{$data_jen->kode}} - {{$data_jen->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>		

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="jumlah" id="jumlah" size="16" maxlength="16" autocomplete='off' oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C.Judex</label>
						<div  class="col-8" >
							<select name="cjudex"  id="cjudex" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_cjudex as $data_judex)
								<option value="{{$data_judex->kode}}">{{$data_judex->kode}} - {{$data_judex->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>	
					@else
					<input  class="form-control" type="hidden"  size="6" maxlength="6" name="wo" id="wo">
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<div  class="col-8" >
							<select name="jnsbiaya" id="jnsbiaya" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_jenis as $data_jen)
								<option value="{{$data_jen->kode}}">{{$data_jen->kode}} - {{$data_jen->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>		

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="jumlah" id="jumlah" size="16" maxlength="16" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C.Judex</label>
						<div  class="col-8" >
							<select name="cjudex"  id="cjudex" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_cjudex as $data_judex)
								<option value="{{$data_judex->kode}}">{{$data_judex->kode}} - {{$data_judex->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>	
					@endif

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@if($verified == "N")
								<button type="submit" name="update" value="update" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
								@endif
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$('#kt_table tbody').on( 'click', 'tr', function (event) {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				t.$('tr.selected').removeClass('selected');
				// $(':radio', this).trigger('click');
				if (event.target.type !== 'radio') {
					$(':radio', this).trigger('click');
				}
				$(this).addClass('selected');
			}
		} );

		//verifikasi
		$("#status1").on("change", function(){
				var bagian = $("#bagian1").val();
				var mp = $("#mp1").val();
				var nomor = $("#nomor1").val();
				var tanggal = $("#tanggal").val();
				var status1 = $("#status1").val();
			$.ajax({
				url  : "{{route('postingan_kas_bank.verifikasi')}}",
				type : "POST",
				data: {
						"bagian": bagian,
						"mp": mp,
						"nomor": nomor,
						"tanggal": tanggal,
						"status1": status1,
						"_token": "{{ csrf_token() }}",
					},
				dataType : "JSON",
				success : function(data){
					if(data == 1){
						Swal.fire({
							type  : 'success',
							title : 'Data Berhasil Diverifikasi',
							text  : 'Berhasil',
							timer : 2000
						}).then(function() {
							location.reload();
						});
					}else if(data == 2){
						Swal.fire({
							type  : 'info',
							title : 'Data Sudah Di Posting, Tidak Bisa Di Tambah/Update/Hapus.',
							text  : 'Info',
							timer : 2000
							}).then(function() {
								location.reload();
							});
					}else{
						Swal.fire({
							type  : 'success',
							title : 'Verifikasi Berhasil Dibatalkan.',
							text  : 'Berhasil',
							timer : 2000
							}).then(function() {
								location.reload();
							});
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		//prosess create detail
		$('#form-tambah-detail').submit(function(){
			$.ajax({
				url  : "{{route('postingan_kas_bank.store.detail')}}",
				type : "POST",
				data : $('#form-tambah-detail').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					if(data == 1){
						Swal.fire({
							type  : 'success',
							title : 'Data Detail Berhasil Ditambah',
							text  : 'Berhasil',
							timer : 2000
						}).then(function() {
							location.reload();
						});
					}else{
						Swal.fire({
							type  : 'info',
							title : 'Data Sudah Di Posting, Tidak Bisa Di Tambah/Update/Hapus.',
							text  : 'Info',
							timer : 2000
							}).then(function() {
								location.reload();
							});
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		//tampil edit detail
		$('#editRow').on('click', function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var no = $(this).attr('docno');
					var id = $(this).attr('lineno');
					$.ajax({
						url :"{{('kontroler/postingan_kas_bank/editdetail')}}"+'/'+no+'/'+id,
						type : 'get',
						dataType:"json",
						headers: {
							'X-CSRF-Token': '{{ csrf_token() }}',
							},
						success:function(data)
						{
							$('#nourut').val(data.lineno);
							$('#rincian').val(data.keterangan);
							var d=parseFloat(data.totprice);
							var rupiah = d.toFixed(2);
							$('#jumlah').val(rupiah);
							$('#wo').val(data.pk);
							$('.modal-edit-detail').modal('show');
							$('#sanper').val(data.account).trigger('change');
							$('#lapangan').val(data.lokasi).trigger('change');
							$('#jnsbiaya').val(data.jb).trigger('change');
							$('#bagian').val(data.bagian).trigger('change');
							$('#cjudex').val(data.cj).trigger('change');

						}
					})
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		//prosess create detail
		$('#form-edit-detail').submit(function(){
			$.ajax({
				url  : "{{route('postingan_kas_bank.update.detail')}}",
				type : "POST",
				data : $('#form-edit-detail').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					if(data == 1){
						Swal.fire({
							type  : 'success',
							title : 'Data Detail Kas Bank Sudah Update.',
							text  : 'Berhasil',
							timer : 2000
							}).then(function() {
								location.reload();
							});
					}else{
						Swal.fire({
							type  : 'info',
							title : 'Data Sudah Di Posting, Tidak Bisa Di Tambah/Update/Hapus.',
							text  : 'Info',
							timer : 2000
							}).then(function() {
								location.reload();
							});
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$('#deleteRow').click(function(e) {
		e.preventDefault();
		if($('input[class=btn-radio]').is(':checked')) { 
			$("input[class=btn-radio]:checked").each(function() {
				var no = $(this).attr('docno');
				var id = $(this).attr('lineno');
				// delete stuff
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary',
						cancelButton: 'btn btn-danger'
					},
						buttonsStyling: false
					})
					swalWithBootstrapButtons.fire({
						title: "Data yang akan dihapus?",
						text: "Nourut  : " +id,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('postingan_kas_bank.delete.detail') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"no": no,
								"id": id,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : "Detail Kas Bank Dengan Nourut : " +id+" Berhasil Dihapus.",
									text  : 'Berhasil',
									
								}).then(function() {
									location.reload();
								});
							},
							error: function () {
								alert("Terjadi kesalahan, coba lagi nanti");
							}
						});
					}
				});
			});
		} else {
			swalAlertInit('hapus');
		}
	});

	$("#browser").treeview({
            // toggle: function() {
            //     console.log("%s was toggled.", $(this).find(">span").text());
            //     alert("do something");
            // }
	});

        // fourth example
        // $("#black, #gray").treeview({
        //     control: "#treecontrol",
        //     persist: "cookie",
        //     cookieId: "treeview-black"
        // });

});
	

		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
