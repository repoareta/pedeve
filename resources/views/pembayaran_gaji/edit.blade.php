@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Pembayaran Gaji </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pembayaran Gaji </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
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
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Menu Edit Pembayaran Gaji
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-edit">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Menu Edit Pembayaran Gaji
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<?php
							$nodok = $data->docno;
							$mp = substr($data->docno,0,1);
							$nomor = substr($data->docno,8);
							$tahun = substr($data->thnbln,0,4); 
							$bulan = substr($data->thnbln,4); 
							$bulan = substr($data->thnbln,4); 
							$bagian = substr($data->docno,2,5);
						?>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No.Dokumen</label>
							<div class="col-6">
								<input type="text" class="form-control"  value="{{$mp}}" size="1" maxlength="1" name="mp" id="mp" readonly style="background-color:#DCDCDC; cursor:not-allowed"></td>
								<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="hidden" value="{{$nodok}}"  name="nodok" readonly>
							</div>
							<div class="col-4">
								<input type="text" class="form-control"  value="{{$nomor}}" size="1" maxlength="1" name="nomor" id="nomor" readonly style="background-color:#DCDCDC; cursor:not-allowed"></td>
							</div>
						</div>

						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-4">
							<input class="form-control" type="text" value="{{$bulan}}"   name="bulan" id="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							<input class="form-control" type="hidden" value="{{$data->thnbln}}"   name="bulanbuku" id="bulanbuku" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							
						</div>
							<div class="col-6" >
								<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" id="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Bagian<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="bagian" id="bagian" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Bagian Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach($data_bagian as $row)
									<option value="{{$row->kode}}" <?php if($row->kode == $bagian ) echo 'selected' ; ?>>{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
									
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-3">
								<select name="jk" id="jk" class="form-control selectpicker" data-live-search="true" required>
									<option value="">- Pilih -</option>
									<option value="10" <?php if($data->jk == '10' ) echo 'selected' ; ?>>Kas(Rupiah)</option>
									<option value="11" <?php if($data->jk == '11' ) echo 'selected' ; ?>>Bank(Rupiah)</option>
									<option value="13" <?php if($data->jk == '13' ) echo 'selected' ; ?>>Bank(Dollar)</option>
									
								</select>							</div>
							<label class="col-2 col-form-label">Currency Index</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="ci" value="{{$data->ci}}"  id="ci" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<label class="col-1 col-form-label">Kurs<span style="color:red;">*</span></label>
							<div class="col-2" >
								<input class="form-control" type="text" name="kurs" value="{{number_format($data->rate,0)}}"  id="kurs" size="7" maxlength="7" >
							</div>
						</div>
						
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Lokasi<span style="color:red;">*</span></label>
							<div class="col-4">
								<select name="lokasi" id="lokasi" class="form-control" data-live-search="true">
									<option value="">- Pilih -</option>
									
								</select>
								<input class="form-control" type="hidden"  value="{{$data->store}}" id="lokasi2">
								<input class="form-control" type="hidden"  value="{{$data->namabank}}-{{$data->norekening}}" id="lokasi1">
							</div>
							@if($mp == 'P')
							<label class="col-1 col-form-label">No Bukti</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="nobukti" value="{{$data->voucher}}"  id="nobukti" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<label class="col-1 col-form-label">No Ver</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="nover" value="{{$data->mrs_no}}"  id="nover" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							@else
							<label class="col-1 col-form-label">No Bukti</label>
							<div class="col-5" >
								<input class="form-control" type="text" name="nobukti" value="{{$data->voucher}}"  id="nobukti" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<div class="col-1" >
								<input class="form-control" type="hidden" name="nover" value="{{$data->mrs_no}}"  id="nover" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							@endif
						</div>

						<div class="form-group row">
							<label class="col-2 col-form-label">
							@if($mp == "M") Dari @else Kepada @endif<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" name="kepada" id="kepada" value="{{$data->kepada}}" size="40" maxlength="40" required oninvalid="this.setCustomValidity('<?php if($mp == "M"){ ?> Dari <?php }else{ ?> Kepada <?php } ?> Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Sejumlah<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text"  value="{{number_format($data->nilai_dok,0,',','.')}}" size="16" maxlength="16" readonly required oninvalid="this.setCustomValidity('Sejumlah Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
								<input class="form-control" type="hidden" name="nilai" id="nilai" value="{{number_format($count,0,'','')}}" size="16" maxlength="16" required oninvalid="this.setCustomValidity('Sejumlah Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 1</label>
							<div class="col-10">
								<input class="form-control" type="text" name="ket1" id="ket1" value="{{$data->ket1}}" size="35" maxlength="35"  autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 2</label>
							<div class="col-10">
								<input class="form-control" type="text" name="ket2" id="ket2" value="{{$data->ket2}}" size="35" maxlength="35"  autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 3</label>
							<div class="col-10">
								<input class="form-control" type="text" name="ket3" id="ket3" value="{{$data->ket3}}" size="35" maxlength="35"  autocomplete='off'>
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('pembayaran_gaji.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				

					
				<div class="kt-portlet__head kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Detail Pembayaran Gaji
						</h3>			
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
								<a href="#" id="btn-create" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
										<i class="fas fa-plus-circle"></i>
									</span>
								</a>
				
								<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
									<i class="fas fa-edit" id="btn-edit"></i>
								</span>
				
								<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data Detail All">
									<i class="fas fa-trash" id="btn-delete-all"></i>
								</span>
								<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
									<i class="fas fa-times-circle" id="btn-delete"></i>
								</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail-permintaan">
						<thead class="thead-light">
							<tr>
								<th ></th>
								<th>No</th>
								<th>Rincian</th>	
								<th>KL</th>
								<th>Sanper</th>
								<th>Bagian</th>
								<th>PK</th>
								<th>JB</th>
								<th>CJ</th>	
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=0; ?>
							@foreach($data_detail as $data_d)
							<?php $no++; ?>
							<tr class="table-info">
								<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" nodok="{{$data_d->docno}}" nourut="{{$data_d->lineno}}"  class="btn-radio" ><span></span></label></td>
								<td scope="row" align="center">{{$data_d->lineno}}</td>
								<td>{{$data_d->keterangan}}</td>
								<td>{{$data_d->lokasi}}</td>
								<td align="center">{{$data_d->account}}</td>
								<td align="center">{{$data_d->bagian}}</td>
								<td align="center">{{$data_d->pk}}</td>
								<td align="center">{{$data_d->jb}}</td>
								<td align="center">{{$data_d->cj}}</td>
								<td align="center">{{number_format($data_d->totprice,2,'.',',')}}</td>
							</tr>
							@endforeach
						</tbody>
							<tr>
								<td colspan="9" align="right">Jumlah Total : </td>
								<td >Rp. <?php echo number_format($count, 0, '.', ','); ?></td>
							</tr>
					</table>
				</div>
			</form>
			<!--end: Datatable -->
		</div>
	</div>
</div>

<!--begin::Modal creaate--> 
<div class="modal fade modal-create"   tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail"></h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-create-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        
                    <div class="form-group row ">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_urut}}"  name="nourut" readonly>
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="hidden" value="{{$nodok}}"  name="nodok" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Rincian<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8" >
							<select name="status"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Rincian Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
								<option value="tetap">Pekerja Tetap</option>
								<option value="kontrak">Kontrak</option>
								<option value="perbantuan">Perbantuan</option>
								<option value="komisaris">Komisaris</option>
								<option value="komite">Komite</option>
							</select>
							<input type="hidden" name="tahun" value="{{$tahun}}">
							<input type="hidden" name="bulan" value="{{$bulan}}">
						</div>
					</div>														
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--begin::Modal Delete--> 
<div class="modal fade modal-delete-all"   tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-delete-detail"></h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-delete-all"  enctype="multipart/form-data">
					{{csrf_field()}}
                        
                    <div class="form-group row ">
						<label for="example-text-input" class="col-2 col-form-label">No. Dokumen<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$nodok}}"  name="nodok" readonly>
							<input type="hidden" name="tahun" value="{{$tahun}}">
							<input type="hidden" name="bulan" value="{{$bulan}}">
						</div>
					</div>												
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--begin::Modal Edit--> 
<div class="modal fade modal-edit" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-edit-detail"></h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-edit-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        
                    <div class="form-group row ">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value=""  name="nourut" id="nourut" readonly>
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="hidden" value=""  name="nodok" id="nodok" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Rincian<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value=""  name="rincian" id="rincian" size="50" maxlength="250" required oninvalid="this.setCustomValidity('Rincian Harus Diisi..')" oninput="setCustomValidity('')"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">KD. Lapang</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8" >
							<select name="lapangan"  id="select-lapangan" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
								@foreach($lokasi as $data_lok)
								<option value="{{$data_lok->kodelokasi}}">{{$data_lok->kodelokasi}} - {{$data_lok->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Sandi Perkiraan</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<select name="sanper"  id="select-sanper" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
								@foreach($data_account as $data_acc)
								<option value="{{$data_acc->kodeacct}}">{{$data_acc->kodeacct}} - {{$data_acc->descacct}}</option>
								@endforeach
								
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8">
							<select name="bagian" id="select-bagian" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
								@foreach($data_bagian as $data_bag)
								<option value="{{$data_bag->kode}}">{{$data_bag->kode}} - {{$data_bag->nama}}</option>
								@endforeach
								
							</select>
						</div>
					</div>
	
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text"   name="pk" id="pk" size="6" maxlength="6">
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8">
							<select name="jb" id="select-jb"  class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
								@foreach($data_jenis as $data_jen)
								<option value="{{$data_jen->kode}}">{{$data_jen->kode}} - {{$data_jen->keterangan}}</option>
								@endforeach
							
							</select>
						</div>
					</div>
									
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<select name="cj" id="select-cj" class="form-control selectpicker" data-live-search="true" >
								<option value="">-Pilih-</option>
								@foreach($data_casj as $data_cas)
								<option value="{{$data_cas->kode}}">{{$data_cas->kode}} - {{$data_cas->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="number" value="" name="nilai" id="nilai1" size="16" maxlength="16"  required oninvalid="this.setCustomValidity('Jumlah Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
		$('#tabel-detail-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		var jk = $('#jk').val();
	if(jk == '13'){
		$("#ci").val('2');
		$("#kurs").val('0');
		$( "#kurs" ).prop( "required", true );
		$( "#kurs" ).prop( "readonly", false );
		$('#kurs').css("background-color","#ffffff");
		$('#kurs').css("cursor","text");
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	} else if (jk == '11'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$( "#kurs" ).prop( "required", false );
		$( "#kurs" ).prop( "readonly", true );
		$('#kurs').css("background-color","#DCDCDC");
		$('#kurs').css("cursor","not-allowed");
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else if (jk == '10'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$( "#kurs" ).prop( "required", false );
		$( "#kurs" ).prop( "readonly", true );
		$('#kurs').css("background-color","#DCDCDC");
		$('#kurs').css("cursor","not-allowed");
		$("#jnskas").val('1');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else{
		$("#ci").val("");
		$("#kurs").val("");
		$( "#kurs" ).prop( "required", true );
		$( "#kurs" ).prop( "readonly", false );
		$('#kurs').css("background-color","#ffffff");
		$('#kurs').css("cursor","text");
		$("#jnskas").val("");
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}	

var jk = $('#jk').val();
var ci = $('#ci').val();
var lokasi1 = $('#lokasi1').val();
var lokasi2 = $('#lokasi2').val();




$.ajax({
	url : "{{route('pembayaran_gaji.lokasiJson')}}",
	type : "POST",
	dataType: 'json',
	data : {
		jk:jk,
		ci:ci
		},
	headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
	success : function(data){
				var html = '';
				var i;
					html += '<option value="'+lokasi2+'">'+lokasi1+'</option>';
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].kodestore+'">'+data[i].namabank+'-'+data[i].norekening+'</option>';
				}
				$('#lokasi').html(html);		
	},
	error : function(){
		alert("Ada kesalahan controller!");
	}
})


$('#form-edit').submit(function(){
	$.ajax({
		url  : "{{route('pembayaran_gaji.update')}}",
		type : "POST",
		data : $('#form-edit').serialize(),
		dataType : "JSON",
		headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success : function(data){
		Swal.fire({
			type  : 'success',
			title : 'Data Berhasil Diproses',
			text  : 'Berhasil',
			timer : 2000
		}).then(function() {
				window.location.replace("{{ route('pembayaran_gaji.index') }}");;
			});
		}, 
		error : function(){
			alert("Terjadi kesalahan, coba lagi nanti");
		}
	});	
	return false;
});

$("#bagian").on("change", function(e){
	e.preventDefault();
var bagian = $('#bagian').val();
var mp = $('#mp').val();
var bulan = $('#bulan').val();
var bulanbuku = $('#bulanbuku').val();
	$.ajax({
		url : "{{route('pembayaran_gaji.createJson')}}",
		type : "POST",
		dataType: 'json',
		data : {
			bagian:bagian,
			mp:mp,
			bulanbuku:bulanbuku
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
			var tahun = bulanbuku.substr(2,2);
			var nodata = tahun+''+bulan+''+data;
			var nomor = parseInt(nodata)+parseInt(1);
			$("#nomor").val(nomor);
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});


$("#jk").on("change", function(){
var jk = $('#jk').val();
	if(jk == '13'){
		$("#ci").val('2');
		$("#kurs").val('0');
		$( "#kurs" ).prop( "required", true );
		$( "#kurs" ).prop( "readonly", false );
		$('#kurs').css("background-color","#ffffff");
		$('#kurs').css("cursor","text");
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	} else if (jk == '11'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$( "#kurs" ).prop( "required", false );
		$( "#kurs" ).prop( "readonly", true );
		$('#kurs').css("background-color","#DCDCDC");
		$('#kurs').css("cursor","not-allowed");
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else if (jk == '10'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$( "#kurs" ).prop( "required", false );
		$( "#kurs" ).prop( "readonly", true );
		$('#kurs').css("background-color","#DCDCDC");
		$('#kurs').css("cursor","not-allowed");
		$("#jnskas").val('1');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else{
		$("#ci").val("");
		$("#kurs").val("");
		$( "#kurs" ).prop( "required", true );
		$( "#kurs" ).prop( "readonly", false );
		$('#kurs').css("background-color","#ffffff");
		$('#kurs').css("cursor","text");
		$("#jnskas").val("");
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}	

	var ci = $('#ci').val();

	$.ajax({
		url : "{{route('pembayaran_gaji.lokasiJson')}}",
		type : "POST",
		dataType: 'json',
		data : {
			jk:jk,
			ci:ci
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
					var html = '';
                    var i;
						html += '<option value="">- Pilih - </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].kodestore+'">'+data[i].namabank+'-'+data[i].norekening+'</option>';
                    }
                    $('#lokasi').html(html);		
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});

$("#lokasi").on("click", function(){
	$("#lokasi").on("change", function(){
		
	var lokasi = $('#lokasi').val();
	var mp = $('#mp').val();
	var tahun = $('#tahun').val();

		$.ajax({
			url : "{{route('pembayaran_gaji.nobuktiJson')}}",
			type : "POST",
			dataType: 'json',
			data : {
				lokasi:lokasi,
				mp:mp,
				tahun:tahun
				},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success : function(data){
			var nobukti = data;
				$("#nobukti").val(nobukti);
			},
			error : function(){
				alert("Ada kesalahan controller!");
			}
		})
	});
});

$('#nilai').keyup(function(){
	var nilai = $('#nilai').val();
	if(nilai < '0'){
		$("#iklan").val('CR');
	}else if(nilai > '0'){
		$("#iklan").val('DR');
	}else{
		$("#iklan").val('');
	}
});



//detail

$('#btn-create').on('click', function(e) {
	e.preventDefault();
	$('#title-detail').html("Tambah Detail Pembayaran Gaji");
	$('.modal-create').modal('show');
});
$('#btn-delete-all').on('click', function(e) {
	e.preventDefault();
	$('#title-delete-detail').html("Hapus Detail Pembayaran Gaji All");
	$('.modal-delete-all').modal('show');
});

	//prosess create detail
	$('#form-create-detail').submit(function(){
		$.ajax({
			url  : "{{route('pembayaran_gaji.store.detail')}}",
			type : "POST",
			data : $('#form-create-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
		console.log(data);

				if(data == 1){
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Ditambah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function() {
						location.reload();
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Duplikasi data dokumen detail, entri dibatalkan',
						text  : 'Failed',
						timer : 2000
					});
				}
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});
	//prosess delete all detail
	$('#form-delete-all').submit(function(){
		$.ajax({
			url  : "{{route('pembayaran_gaji.delete.detail.all')}}",
			type : "delete",
			data : $('#form-delete-all').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
				Swal.fire({
					type  : 'success',
					title : 'Data Berhasil Dihapus',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
					location.reload();
					});
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});

//tampil edit detail
$('#btn-edit').on('click', function(e) {
	e.preventDefault();
var allVals = []; 
if($('input[type=radio]').is(':checked')) {  
	$("input[type=radio]:checked").each(function() {  
		var nodok = $(this).attr('nodok').split("/").join("-");
		var nourut = $(this).attr('nourut');
			$.ajax({
				url :"{{('perbendaharaan/pembayaran_gaji/editdetail')}}"+ '/' +nodok+ '/' +nourut,
				type : 'get',
				dataType:"json",
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
					},
				success:function(data)
				{
					$('#nodok').val(data.docno);
					$('#nourut').val(data.lineno);
					$('#rincian').val(data.keterangan);
					$('#pk').val(data.pk);
					var output=parseInt(data.totprice);
					$('#nilai1').val(output);
					$('#title-edit-detail').html("Edit Detail Pembayaran Gaji");
					$('#select-lapangan').val(data.lokasi).trigger('change');
					$('#select-sanper').val(data.account).trigger('change');
					$('#select-bagian').val(data.bagian).trigger('change');
					$('#select-jb').val(data.jb).trigger('change');
					$('#select-cj').val(data.cj).trigger('change');
					$('.modal-edit').modal('show');
				}
			})
	});
}else{
	swalAlertInit('ubah'); 

}			
});


$('#form-edit-detail').submit(function(){
		$.ajax({
			url  : "{{route('pembayaran_gaji.update.detail')}}",
			type : "POST",
			data : $('#form-edit-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
				Swal.fire({
					type  : 'success',
					title : 'Data Berhasil Diubah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
					location.reload();
					});
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});

	//delete
	$('#btn-delete').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var nodok = $(this).attr('nodok');
					var nourut = $(this).attr('nourut');
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
						text: "No. Dokumen : " + nodok+ " No Detail : "+nourut,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('pembayaran_gaji.delete.detail') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"nodok": nodok,
									"nourut": nourut,
									"_token": "{{ csrf_token() }}",
								},
								success: function (data) {
									Swal.fire({
										type : 'success',
										title: 'Hapus detail Berhasil',
										text : 'Berhasil',
										timer: 2000
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


    var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
	arrows = {
		leftArrow: '<i class="la la-angle-right"></i>',
		rightArrow: '<i class="la la-angle-left"></i>'
	}
} else {
	arrows = {
		leftArrow: '<i class="la la-angle-left"></i>',
		rightArrow: '<i class="la la-angle-right"></i>'
	}
}

// Private functions
var demos = function () {



	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	
	$('#bulanbuku').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
	});
};

return {
	// public functions
	init: function() {
		demos(); 
	}
};
}();

KTBootstrapDatepicker.init();
});

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
