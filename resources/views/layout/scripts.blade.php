<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('js/app.js') }}"></script>
<!--end::Global Theme Bundle -->

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$('#data-umk-table').DataTable({
        processing: true,
		serverSide: true,
		ajax: {
            url: "{{ route('uang_muka_kerja_json.index') }}",
		},
		columns: [
			{
				data: 'radio',
				name: 'radio',
				orderable: false
			},
			{
				data: 'tgl_panjar',
				name: 'tgl_panjar'
			},
			{
				data: 'noumk',
				name: 'noumk'
			},
			{
				data: 'no_kas',
				name: 'no_kas'
			},
			{
				data: 'jenisum',
				name: 'jenisum'
			},
			{
				data: 'keterangan',
				name: 'keterangan'
			},
			{
				data: 'jumlah',
				name: 'jumlah'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
		]
    });
});
</script>