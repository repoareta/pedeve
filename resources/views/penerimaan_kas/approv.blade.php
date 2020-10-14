@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Perbendaharaan - Kas/Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Perbendaharaan - Kas/Bank</span>
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
            @foreach($data_app as $data)
                @if($status == 'Y')
				Tabel <span style="color:blue;">Pembatalan</span> Approval Perbendaharaan - Kas/Bank
                @elseif($status == 'N')
				Tabel <span style="color:blue;">Eksekusi</span> Approval Perbendaharaan - Kas/Bank
                @endif
            @endforeach
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
        <form class="kt-form kt-form--label-right" action="{{ route('penerimaan_kas.store.app') }}" method="post">
            @csrf
            @foreach($data_app as $data)
            <div class="form-group row">
                <label for="mulai-input" class="col-2 col-form-label">No.Dokumen</label>
                <div class="col-10">
                        <input style="background-color:#DCDCDC; cursor:not-allowed" type="text" class="form-control" name="nodok" value="{{$data->docno}}" readonly />
                        <input type="text" class="form-control" hidden name="userid" value="{{Auth::user()->userid}}" readonly />
                </div>
            </div>
            <div class="form-group row">
                <label for="mulai-input" class="col-2 col-form-label">Tanggal Approval</label>
                <div class="col-10">
                    <div class="input-daterange input-group" >
                        <input type="text" class="form-control" name="tgl_app" id="date_range_picker" value="" autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Approval Harus Diisi..')" onchange="setCustomValidity('')"/>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <a  href="{{ route('penerimaan_kas.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
                        <button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
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
$(document).ready(function () {
        // range picker
        $('#date_range_picker').datepicker({
            todayHighlight: true,
            autoclose: true,
            // language : 'id',
            format   : 'dd-mm-yyyy',
            orientation: 'bottom'
        });
});
</script>
@endsection