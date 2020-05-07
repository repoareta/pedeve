@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Pinjaman Pekerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pinjaman Pekerja </a>
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
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Data Pinjaman Pekerja
				</h3>
			</div>
		</div>
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-update">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Pinjaman Pekerja
							</h5>	
						</div>
					</div>
				@foreach($data_list as $data)
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">ID Pinjaman<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$data->id_pinjaman}}"  name="id_pinjaman" id="id_pinjaman" size="8" maxlength="8" autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">
							<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="dari-input" class="col-2 col-form-label">NO. Pekerja<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$data->nopek}} -- {{$data->namapegawai}}"   size="8" maxlength="8" autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">					
							<input  class="form-control" type="hidden" value="{{$data->nopek}}"  name="nopek"  size="8" maxlength="8" autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">					
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">NO. Kontrak<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$data->no_kontrak}}"  name="no_kontrak" size="16" maxlength="16" autocomplete='off' required oninvalid="this.setCustomValidity('No Kontrak Harus Diisi..')" oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="form-group row">
						<label for="mulai-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-10">
							<div class="input-daterange input-group" id="date_range_picker">
							<?php 
								$tglmulai = date_create($data->mulai);
								$mulai = date_format($tglmulai, 'Y-m-d'); 
								$tglsampai = date_create($data->sampai);
								$sampai = date_format($tglsampai, 'Y-m-d'); 
							?>
								<input type="text" class="form-control" name="mulai" autocomplete="off" value="{{$mulai}}" required oninvalid="this.setCustomValidity('Mulai Harus Diisi..')" onchange="setCustomValidity('')" />
								<div class="input-group-append">
									<span class="input-group-text">Sampai</span>
								</div>
								<input type="text" class="form-control" name="sampai" value="{{$sampai}}" autocomplete="off" required oninvalid="this.setCustomValidity('Sampai Harus Diisi..')" onchange="setCustomValidity('')"/>
							</div>
							<span class="form-text text-muted">Pilih rentang waktu Pinjaman</span>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tenor<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$data->tenor}}"  name="tenor" size="4" maxlength="4" autocomplete='off' required oninvalid="this.setCustomValidity('Tenor Harus Diisi..')" onchange="setCustomValidity('')"  onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Angsuran<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{round($data->angsuran,0)}}"  name="angsuran" size="16" maxlength="16" autocomplete='off' required oninvalid="this.setCustomValidity('Angsuran Harus Diisi..')" oninput="setCustomValidity('')"  onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Pinjaman<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{round($data->jml_pinjaman,0)}}"  name="pinjaman" size="35" maxlength="35" autocomplete='off' required oninvalid="this.setCustomValidity('Pinjaman Harus Diisi..')" oninput="setCustomValidity('')"  onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					@endforeach
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('pinjaman_pekerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
						Detail Pinjaman Pekerja
					</h3>			
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								<!-- <span style="font-size: 2em;cursor:not-allowed" class="kt-font-success">
									<i class="fas fa-plus-circle"></i>
								</span>
			
								<span style="font-size: 2em;cursor:not-allowed" class="kt-font-warning">
									<i class="fas fa-edit"></i>
								</span>
			
								<span style="font-size: 2em;cursor:not-allowed" class="kt-font-danger">
									<i class="fas fa-times-circle"></i>
								</span> -->
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
						<th>No</th>	
						<th>TAHUN</th>	
						<th>BULAN</th>
						<th>SKED POKOK</th>
						<th>SKED BUNGA</th>
						<th>SKED JUMLAH</th>
						<th>REAL POKOK</th>
						<th>REAL BUNGA</th>
						<th>REAL JUMLAH</th>
						<th>NO BUKTI</th>
						</tr>
					</thead>
					<tbody>
                    <?php $no=0; ?>
					@foreach($data_detail as $data_d)
					<?php $no++; ?>
						<tr class="table-info">
							<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="" class="btn-radio" ><span></span></label></td>
							<td scope="row" align="center">{{$no}}</td>
							<td align="center">{{$data_d->tahun}}</td>
							<td align="center">{{$data_d->bulan}}</td>
							<td>Rp. <?php echo number_format($data_d->pokok, 0, ',', '.'); ?></td>
							<td>Rp. <?php echo number_format($data_d->bunga, 0, ',', '.'); ?></td>
							<td>Rp. <?php echo number_format($data_d->jumlah, 0, ',', '.'); ?></td>
							<td>Rp. <?php echo number_format($data_d->realpokok, 0, ',', '.'); ?></td>
							<td>Rp. <?php echo number_format($data_d->realbunga, 0, ',', '.'); ?></td>
							<td>Rp. <?php echo number_format($data_d->jumlah2, 0, ',', '.'); ?></td>
							<td align="center">{{$data_d->nodoc}}</td>
						</tr>
					@endforeach
					</tbody>
					@foreach($count as $data_c)
                        <tr>
                            <td colspan="4" align="right">Jumlah Total : </td>
                            <td >Rp. <?php echo number_format($data_c->jml, 0, ',', '.'); ?></td>
                            <td >Rp. <?php echo number_format($data_c->bunga, 0, ',', '.'); ?></td>
                            <td ></td>
                            <td >Rp. <?php echo number_format($data_c->realpokok, 0, ',', '.'); ?></td>
                            <td >Rp. <?php echo number_format($data_c->realbunga, 0, ',', '.'); ?></td>
                            <td colspan="2" ></td>
                        </tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</form>
		<!--end: Datatable -->
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});
		$('#date_range_picker').datepicker({
			todayHighlight: true,
			autoclose: true,
			format   : 'yyyy-mm-dd',
		});

		
		

		$('#form-update').submit(function(){
			$.ajax({
			url  : "{{route('pinjaman_pekerja.update')}}",
			type : "POST",
			data : $('#form-update').serialize(),
			dataType : "JSON",
			headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
				success : function(data){
				console.log(data);
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Disimpan',
						text  : 'Berhasil',
						timer : 2000
					}).then(function() {
						window.location.replace("{{ route('pinjaman_pekerja.index') }}");
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
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
