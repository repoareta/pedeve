@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Jurnal Umum </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Jurnal Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
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
					Tambah Jurnal Umum
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Jurnal Umum
								</h5>	
							</div>
						</div>
						@foreach($data_jur as $data)
						<?php 
							$docno = $data->docno;
							$mp = $data->mp;
							$bagian = $data->bagian;
							$nomor = $data->nomor;
							$thnbln = $data->thnbln;
							$bulan = $data->bulan;
							$tahun = $data->tahun;
							$jk = $data->jk;
							$suplesi = $data->suplesi;
							$store = $data->store;
							$keterangan = $data->keterangan;
							$ci = $data->ci;
							$rate = $data->rate;
							$debet = $data->debet;
							$kredit = $data->kredit;
							$nobukti = $data->voucher;
							$status2 = $data->posted;
							$nama_bagian = $data->nama_bagian;
						?>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No.Dokumen</label>
							<div class="col-5">
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="mp" value="{{$mp}}" id="mp" readonly>
							</div>
							<div class="col-5">
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nomor" value="{{$nomor}}" id="nomor" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bulan</label>
							<div class="col-3">
								<input class="form-control" type="text" value="{{$bulan}}"   name="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<label for="spd-input" class="col-1 col-form-label">Tahun</label>
							<div class="col-3" >
								<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
							<label for="spd-input" class="col-1 col-form-label">suplesi</label>
							<div class="col-2" >
								<input class="form-control" type="text" value="{{$suplesi}}"   name="suplesi" size="2" maxlength="2" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bagian</label>
							<div class="col-5">
								<input class="form-control" type="text" name="bagian" value="{{$bagian}}" id="bagian" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<div class="col-5">
								<input class="form-control" type="text" name="nama_bagian" value="{{$nama_bagian}}" id="nama_bagian" readonly readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Jenis Kartu</label>
							<div class="col-5">
								<select name="jk" id="jk" class="form-control selectpicker" data-live-search="true">
									<option value="15">Rupiah</option>
									<option value="18">Dollar</option>

								</select>
								<input name="kurs" type="hidden" value="{{$rate}}"></td>
							</div>
							<label for="nopek-input" class="col-2 col-form-label">Currency Index</label>
							<div class="col-3">
								<input class="form-control" type="hidden" name="ci" value="1"  id="ci"  readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="text" value="1.RP"    readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Store</label>
							<div class="col-5">
								<input class="form-control" type="text" value="99" name="nokas" size="50" maxlength="200" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<div class="col-5">
								<input class="form-control" type="text" value="JURNAL" name="nama_kas" size="50" maxlength="200" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No. Bukti</label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$nobukti}}" name="nobukti" size="50" maxlength="200" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
							<div class="col-10">
								<textarea class="form-control" type="text" value=""  id="kepada" name="kepada" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')"></textarea>
								<input class="form-control" type="hidden" name="tanggal" value="{{ date('Y-m-d') }}" size="15" maxlength="15">
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('jurnal_umum.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<?php if($status2 <> "Y"){ ?> 
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
									<?php } ?>
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
							Detail Jurnal Umum
						</h3>			
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
								<a href="#" data-toggle="modal" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-success">
										<i class="fas fa-plus-circle"></i>
									</span>
								</a>
				
								<a href="#" id="editRow">
									<span style="font-size: 2em;" class="kt-font-warning">
										<i class="fas fa-edit"></i>
									</span>
								</a>
				
								<a href="#" id="deleteRow">
									<span style="font-size: 2em;" class="kt-font-danger">
										<i class="fas fa-times-circle"></i>
									</span>
								</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail">
						<thead class="thead-light">
							<tr>
								<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
								<th>NO</th>
								<th>LP</th>	
								<th>SANPER</th>
								<th>BAGIAN</th>
								<th>PK</th>
								<th>JB</th>
								<th>DR</th>
								<th>CR</th>
								<th>KURS</th>
								<th>KETERANGAN</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data_detail as $data_d)
							<tr>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
								<td>c</td>
							</tr>
						@endforeach

							
						</tbody>
					</table>
				</div>
			</form>
			<!--end: Datatable -->
	</div>
</div>


<!--begin::Modal-->
<div class="modal fade modal-create-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Tambah Menu Rincian Minta Bayar</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-bayar-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value=""  name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value=""  name="keterangan" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')"></textarea>
						</div>
					</div>
									
					

									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="nilai" onkeypress="return hanyaAngka(event)" required oninvalid="this.setCustomValidity('Jumlah Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
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
		$('#tabel-detail').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$("#jk").on("change", function(){
		var jk = $('#jk').val();
		if(jk == '18'){
			$("#ci").val('2');
			$("#kurs").val('');
			$("#kurspjk").val('2');
			$("#kurs" ).prop( "readonly", false );
			$("#kurspjk" ).prop( "readonly", false );
			$("#jnskas").val("2");
		} else if (jk == '15'){
			$("#ci").val('1');
			$("#kurs").val('1');
			$("#kurspjk").val('0');
			$("#kurs" ).prop( "required", true );
			$("#kurspjk" ).prop( "required", true );
			$("#jnskas").val("1");
		}else{
			$("#ci").val('');
			$("#kurs").val('');
			$("#kurspjk").val('');
			$("#kurs" ).prop( "readonly", false );
			$("#kurspjk" ).prop( "readonly", false );
			$("#jnskas").val("");
		}	
	});
		


		
	});
	

  

		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
