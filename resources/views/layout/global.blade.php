<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="{{ url('/') }}">
		<meta charset="utf-8" />
		<title>
			{{ config('app.name', 'Pertamina PDV') }} | 
			{{ ucwords(str_replace('_', ' ', Request::segment(1))) }} 
			@if(Request::segment(2)) - {{ ucwords(str_replace('_', ' ', Request::segment(2))) }} @endif
		</title>
		<meta name="description" content="Server-side processing examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Global Theme Styles(used by all pages) -->
        @include('layout.stylesheets')
		<!--end::Global Theme Styles -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{ url()->current() }}">
					<img alt="Logo" src="{{ asset('assets/media/logos/pedeve.png') }}" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="{{ url()->current() }}">
								<img alt="Logo" src="{{ asset('assets/media/logos/pedeve.png') }}" />
							</a>
						</div>
					</div>

					<!-- end:: Aside -->
                    @include('layout.nav-left')
				</div>
				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    @include('layout.nav-top')

					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						@include('sweetalert::alert')
						<!-- begin:: Content -->
						@yield('content')
						<!-- end:: Content -->
					</div>
                    <!-- begin:: Footer -->
                    @include('layout.footer')
                    <!-- end:: Footer -->
				</div>
			</div>
		</div>
		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
        @include('layout.quick_panel')
		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->
		@include('layout.scripts')
	</body>
	<!-- end::Body -->
</html>