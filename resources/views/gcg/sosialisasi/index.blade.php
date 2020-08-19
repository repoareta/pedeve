@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Implementasi GCG </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
                    Sosialisasi
                </a>
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
					Sosialisasi
				</h3>	
				
				<div class="kt-portlet__head-actions" style="font-size: 2rem">
					<a href="{{ route('gcg.sosialisasi.create') }}">
						<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
							<i class="fas fa-plus-circle"></i>
						</span>
					</a>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
				<thead class="thead-light">
					<tr>
						<th>
							Keterangan
						</th>
						<th>
							Dokumen
						</th>
						<th>
							Tanggal Dibuat
						</th>
						<th>
							Dibuat Oleh
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($sosialisasi_list as $sosialisasi)
						<tr>
							<td>{{ $sosialisasi->keterangan }}</td>
							<td>
								<a href="{{ asset('storage/sosialisasi/'.$sosialisasi->dokumen) }}" target="_blank">{{ $sosialisasi->dokumen }}</a>
							</td>
							<td>{{ Carbon\Carbon::parse($sosialisasi->created_at)->translatedFormat('d F Y') }}</td>
							<td>{{ $sosialisasi->pekerja->nama }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$('#kt_table').DataTable();
		});
	</script>
@endsection