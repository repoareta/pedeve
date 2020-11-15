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

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!--end::Page Vendors -->


<!-- treeview JS -->
<script type="text/javascript" src="{{ asset('tree/jquery.treeview.js')}}"></script>
<!-- end treeview JS -->

<script type="text/javascript">

    $( document ).ready(function() {
        // alert (localStorage ['minimize']);
        // replace
        $("a[href='#']").attr('href','{{ url()->current() }}');

        // cek kt menu settings
        if (localStorage ['minimize'] == 'true') {
            $('#body-style').addClass('kt-aside--minimize');
        } else {
            $('#body-style').removeClass('kt-aside--minimize');
        }
    });

    function kt_minimize() {
        if(typeof(Storage) == "undefined") {
            alert ("local storage not supported by this Broswer");
        } 
        
        else if(localStorage ['minimize'] == 'true') {
            localStorage ['minimize'] = 'false';
            $('#body-style').removeClass('kt-aside--minimize');
        }

        else {
            localStorage ['minimize'] = 'true';
        }

        // alert (localStorage ['minimize']);
    }

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

    (function ($, DataTable) {
        // Datatable global configuration
        $.extend(true, DataTable.defaults, {
            language: {
                // url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json",
                "sEmptyTable":	 "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing":   '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Sedang memproses...',
                "sLengthMenu":   "Tampilkan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext":     "Selanjutnya",
                    "sLast":     "Terakhir"
                }
            },
        });

    })(jQuery, jQuery.fn.dataTable);

    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
        return this.flatten().reduce( function ( a, b ) {
            if ( typeof a === 'string' ) {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if ( typeof b === 'string' ) {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }

            return a + b;
        }, 0 );
    });

    $('#nopek').select2().on('change', function() {
        var id = $(this).val();
        var url = '{{ route("pekerja.show.json", ":pekerja") }}';
        // go to page edit
        url = url.replace(':pekerja',id);
        $.ajax({
            url: url,
            type: "GET",
            data: {
                _token:"{{ csrf_token() }}"		
            },
            success: function(response){
                // console.log(response);
                // isi jabatan
                $('#jabatan').val(response.jabatan).trigger('change');
                // isi golongan
                $('#golongan').val(response.golongan);
                console.log(response.pekerja.noktp);
            },
            error: function () {
                alert("Terjadi kesalahan, coba lagi nanti");
            }
        });
    });

    $('#nopek_detail').select2().on('change', function() {
        // console.log($(this).val());
        var id = $(this).val().split('-')[0];
        // var id = $('#nopek_detail').val().split('-')[0];
        var url = '{{ route("pekerja.show.json", ":pekerja") }}';
        // go to page edit
        url = url.replace(':pekerja',id);
        if(id != ''){
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token:"{{ csrf_token() }}"		
                },
                success: function(response){
                    // console.log(response);
                    // isi jabatan
                    $('#jabatan_detail').val(response.jabatan).trigger('change');
                    // isi golongan
                    $('#golongan_detail').val(response.golongan);
                },
                error: function () {
                    alert("Terjadi kesalahan, coba lagi nanti");
                }
            });
        }
    });

    $('#no_panjar').select2().on('change', function() {
        var id = $(this).val().split('/').join('-');
        var url = '{{ route("perjalanan_dinas.show.json") }}';

        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id,
                _token:"{{ csrf_token() }}"		
            },
            success: function(response){
                console.log(response);
                // isi keterangan
                $('#keterangan').val(response.keterangan);
                // isi jumlah
                const jumlah = parseFloat(response.jum_panjar).toFixed(2);
                $('#jumlah').data('jumlah', jumlah);
                $('#jumlah').val(jumlah).trigger("change");
                $('#nopek').val(response.nopek).trigger("change");
            },
            error: function () {
                alert("Terjadi kesalahan, coba lagi nanti");
            }
        });
    });

    $('#no_umk').select2().on('change', function(e) {
        var id  = $(this).val().split('/').join('-');
        var url = '{{ route("uang_muka_kerja.show.json") }}';

        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id,
                _token:"{{ csrf_token() }}"		
            },
            success: function(response){
                // isi keterangan
                $('#keterangan').val(response.keterangan);
                // isi jumlah
                const jumlah = parseFloat(response.jumlah).toFixed(2);
                $('#jumlah').data('jumlah', jumlah);
                $('#jumlah').val(jumlah).trigger("change");
                // $('#nopek').val(response.nopek).trigger("change");
            },
            error: function () {
                alert("Terjadi kesalahan, coba lagi nanti");
            }
        });
    });
</script>

<script type="text/javascript">
    $('#btn-profile').on('click', function(e) {
        e.preventDefault();
        $('#profile').modal('show');
    });

        $('#form-upload-profil').submit(function(){
			let formData = new FormData($('#form-upload-profil')[0]);
			let file = $('input[type=file]')[0].files[0];
			formData.append('file', file, file.name);
			$.ajax({
				url  : "{{route('upload_profil.store')}}",
				type : "POST",
				data : formData,
				dataType : "JSON",  
				cache: false,
				contentType: false,
				processData: false,
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
						Swal.fire({
							type : 'success',
							title: "Profil berhasil dirubah",
							text : 'Success',
						}).then(function() {
                            window.location.replace("{{route('default.index')}}");
                        });
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
    
    var KTAvatarDemo = function () {
		// Private functions
		var initDemos = function () {
			var avatar2 = new KTAvatar('kt_user_avatar_2_2');
		}

		return {
			// public functions
			init: function() {
				initDemos();
			}
		};
    }();
    
    KTUtil.ready(function() {
		KTAvatarDemo.init();
	});
</script>
@yield("scripts")