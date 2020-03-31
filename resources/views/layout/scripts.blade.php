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
<script src="{{ asset('metronic/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('metronic/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!--end::Page Vendors -->

<script type="text/javascript">
    function swalAlertInit(text) {
		Swal.fire({
			type: 'warning',
			timer: 2000,
			title: 'Oops...',
			text: 'Tandai baris yang ingin di' + text
		});
	}

    function swalSuccessInit(title) {
        Swal.fire({
            type : 'success',
            title: title,
            text : 'Berhasil',
            timer: 2000
        });
    }
</script>
@yield("scripts")