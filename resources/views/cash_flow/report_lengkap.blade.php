@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cash Flow Mutasi </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cash Flow Mutasi</span>
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
				Cetak Cash Flow Mutasi
			</h3>			
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<form class="kt-form kt-form--label-right" action="{{route('cash_flow.lengkap.export')}}" method="GET" target="_blank">
			<div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="mulai-input" class="col-2 col-form-label">Bulan Mulai<span style="color:red;">*</span></label>
                    <div class="col-10">
                        <div class="input-daterange input-group" id="date_range_picker">
                            @php
                                $bulan = date('m');
                                $tahun = date('Y');
                            @endphp
                            <select class="form-control kt-select2" name="bulan_mulai" required>
                                <option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
                                <option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
                                <option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
                                <option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
                                <option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
                                <option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
                                <option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
                                <option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
                                <option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
                                <option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
                                <option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
                                <option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">Bulan Sampai</span>
                            </div>
                            <select class="form-control kt-select2" name="bulan_sampai" required>
                                <option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
                                <option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
                                <option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
                                <option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
                                <option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
                                <option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
                                <option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
                                <option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
                                <option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
                                <option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
                                <option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
                                <option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
                            </select>
                        </div>
                        <span class="form-text text-muted">Pilih rentang waktu rekap arus kas lengkap</span>
                    </div>
                </div>

                <div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-5" >
							<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
						</div>
                </div>

				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="#" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							<button type="submit" id="btn-save" onclick="$('form').attr('target', '_blank')" class="btn btn-brand"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }

    $(document).ready(function () {
        $('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
    });
</script>
@endsection