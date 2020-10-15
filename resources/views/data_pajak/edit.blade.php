@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Perbendaharaan - Data Pajak Tahunan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan - Data Pajak Tahunan </a>
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
					Menu Edit Perbendaharaan - Data Pajak Tahunan
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
									Header Menu Tambah - Data Pajak Tahunan
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-4">
							<input class="form-control" type="text" value="{{$bulan}}"   name="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">						
						</div>
							<div class="col-6" >
								<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-10">
								<select class="form-control selectpicker" data-live-search="true" required disabled oninvalid="this.setCustomValidity('Pegawai Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach($data_pegawai as $data)
									<option value="{{$data->nopeg}}" <?php if($data->nopeg  == $nopek ) echo 'selected' ; ?>>{{$data->nopeg}} -- {{$data->nama}}</option>
									@endforeach
									<input type="hidden" name="nopek"  value="{{$nopek}}" >
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Jenis<span style="color:red;">*</span></label>
							<div class="col-10">
								<select  class="form-control selectpicker" data-live-search="true" required disabled  oninvalid="this.setCustomValidity('Jenis Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="" >-Pilih Jenis-</option>
									<option value="24" <?php if($jenis  == 24 ) echo 'selected' ; ?>>Bonus</option>
									<option value="25" <?php if($jenis  == 25 ) echo 'selected' ; ?>>THR</option>
									<option value="39" <?php if($jenis  == 39 ) echo 'selected' ; ?>>UTD</option>
									<option value="40" <?php if($jenis  == 40 ) echo 'selected' ; ?>>Tantiem</option>
									<option value="41" <?php if($jenis  == 41 ) echo 'selected' ; ?>>Tab.Akhir Kontrak</option>
									<option value="42" <?php if($jenis  == 42 ) echo 'selected' ; ?>>ONH</option>
									<option value="43" <?php if($jenis  == 43 ) echo 'selected' ; ?>>Dinas</option>
									
								</select>
									<input type="hidden" name="jenis"  value="{{$jenis}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nilai</label>
							<div class="col-10">
								<input class="form-control" name="nilai" id="nilai" type="text" value="{{number_format($nilai,0,',','.')}}" size="15" maxlength="15" onkeypress="return hanyaAngka(event)" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Pajak</label>
							<div class="col-10">
								<input class="form-control" name="pajak" id="pajak" type="text" value="{{number_format($pajak,0,',','.')}}" size="15" maxlength="15" onkeypress="return hanyaAngka(event)" autocomplete='off'>
							</div>
						</div>

						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('data_pajak.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',509)->limit(1)->get() as $data_akses)
									@if($data_akses->rubah == 1)
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
									@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('data_pajak.update')}}",
				type : "POST",
				data : $('#form-edit').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Diubah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function() {
						window.location.replace("{{ route('data_pajak.index') }}");
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
		var nilai = document.getElementById('nilai');
		nilai.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatnilai() untuk mengubah angka yang di ketik menjadi format angka
			nilai.value = formatRupiah(this.value, '');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			$a= prefix == undefined ? nilai : (nilai ? nilai: '');
         return $a;
		}

		var pajak = document.getElementById('pajak');
		pajak.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatpajak() untuk mengubah angka yang di ketik menjadi format angka
			pajak.value = formatRupiah1(this.value, '');
		});

		/* Fungsi formatRupiah1 */
		function formatRupiah1(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			$a= prefix == undefined ? nilai : (nilai ? nilai: '');
         return $a;
		}
</script>

@endsection
