<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Roboto:300,400,500,600,700", "DM Sans:400,400i,500,500i,700,700i"]
        },
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>

<!--end::Fonts -->

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{ asset('metronic/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Page Vendors Styles -->

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ asset('metronic/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->
<link href="{{ asset('metronic/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('metronic/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('metronic/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('metronic/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

<!--begin::App Style -->
<link href="{{ asset('metronic/css/app.css') }}" rel="stylesheet" type="text/css" />
<!--end::Custom Style -->

<style>
    .fa-disabled {
		opacity: 0.6;
		cursor: not-allowed;
	}

    tr {
        cursor: pointer;
    }
</style>