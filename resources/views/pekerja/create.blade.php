@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Pekerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pekerja </a>
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
					Tambah Pekerja
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>

		<form class="kt-form kt-form--fit kt-form--label-right">
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Full Name:</label>
					<div class="col-lg-3">
						<input type="email" class="form-control" placeholder="Enter full name">
						<span class="form-text text-muted">Please enter your full name</span>
					</div>
					<label class="col-lg-2 col-form-label">Contact Number:</label>
					<div class="col-lg-3">
						<input type="email" class="form-control" placeholder="Enter contact number">
						<span class="form-text text-muted">Please enter your contact number</span>
					</div>
				</div>	     
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Address:</label>
					<div class="col-lg-3">
						<div class="kt-input-icon">
							<input type="text" class="form-control" placeholder="Enter your address">
							<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
						</div>
						<span class="form-text text-muted">Please enter your address</span>
					</div>
					<label class="col-lg-2 col-form-label">Postcode:</label>
					<div class="col-lg-3">
						<div class="kt-input-icon">
							<input type="text" class="form-control" placeholder="Enter your postcode">
							<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
						</div>
						<span class="form-text text-muted">Please enter your postcode</span>
					</div>
				</div>	     
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Group:</label>
					<div class="col-lg-3">
						<div class="kt-radio-inline">
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="example_2" checked="" value="2"> Sales Person
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="example_2" value="2"> Customer
								<span></span>
							</label>
						</div>
						<span class="form-text text-muted">Please select user group</span>
					</div>
				</div>	            
			</div>
			<div class="kt-portlet__foot kt-portlet__foot--fit-x">
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-10">
							<button type="reset" class="btn btn-success">Submit</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		
			<div class="kt-portlet__body">

				

				<form class="kt-form kt-form--label-right" id="formAnggaran" action="{{ route('anggaran.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Nama Pegawai</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kode" id="kode">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Tempat & Tanggal Lahir</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama" id="nama">
						</div>
					</div>

					<div class="form-group row">
						<label for="tahun" class="col-2 col-form-label">Provinsi</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tahun" id="tahun" value="{{ date('Y') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Jenis Kelamin</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Agama</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Golongan Darah</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Kode Keluarga</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">No. Handphone</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">No. Telepon</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
							</div>
						</div>
					</div>
				</form>
		</div>
		{{-- END BODY --}}		
	</div>	
</div>


@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\AnggaranStore', '#formAnggaran') !!}
@endsection