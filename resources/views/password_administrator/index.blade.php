@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Password Administrator </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Password Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Ubah</span>
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
					Ubah Password Administrator
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Password Administrator
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">PASSWORD LAMA<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="password" value="" name="userpw" id="userpw" size="50" maxlength="50" title="PASSWORD LAMA" autocomplete='off' required oninvalid="this.setCustomValidity('PASSWORD LAMA Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">PASSWORD BARU<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="password" value="" name="newpw" id="newpw" size="50" maxlength="50" title="PASSWORD BARU" autocomplete='off' required oninvalid="this.setCustomValidity('PASSWORD BARU Harus Diisi...')" oninput="setCustomValidity('')">
								<span style="display:none;color:red;" class="error"> Password harus terdiri dari huruf, angka dan minimal 8 karakter !</span>							</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">CONFIRM PASSWORD<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="password" value="" name="newpw1" id="newpw1" size="50" maxlength="50" title="CONFIRM PASSWORD" autocomplete='off' required oninvalid="this.setCustomValidity('CONFIRM PASSWORD Harus Diisi...')" oninput="setCustomValidity('')">
								<span style="display:none;color:red;" class="errorConfirm"> Password dan Confirm Password tidak .</span>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('password_administrator.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
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
	$(document).ready(function () {
		$('#newpw1').on('input', function(e) {
            e.preventDefault();
            if($('#newpw').val() !=$('#newpw1').val()){
              $('.errorConfirm').show();
            }else{
              $('.errorConfirm').hide();
            }
		});
		$('#form-create').submit(function(e){
            e.preventDefault();
            if($('#newpw').val() !=$('#newpw1').val()){
				$('#newpw').val("");
				$('#newpw1').val("");
				$( "#newpw1" ).prop( "required", true );
				$('.errorConfirm').show();
            }else{
			  $('.errorConfirm').hide();
			  $('#form-create').submit(function(){
					$.ajax({
						url  : "{{route('password_administrator.store')}}",
						type : "POST",
						data : $('#form-create').serialize(),
						dataType : "JSON",
						headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
						},
						success : function(data){
						if(data == 1){
							const swalWithBootstrapButtons = Swal.mixin({
								customClass: {
									confirmButton: 'btn btn-primary',
									cancelButton: 'btn btn-danger'
								},
									buttonsStyling: false
								})
								swalWithBootstrapButtons.fire({
									title: "Password Berhasil Diubah.",
									text: "Click Ya Untuk Logout.",
									type: 'success',
									showCancelButton: true,
									reverseButtons: true,
									confirmButtonText: 'Ya',
									cancelButtonText: 'Tidak'
								})
								.then((result) => {
								if (result.value) {
									window.location.replace("{{ route('logout.index') }}");
								}
							});
								
						}else{
							Swal.fire({
								type  : 'info',
								title : 'Password yang di masukan salah.',
								text  : 'Info',
							});
						}

						}, 
						error : function(){
							alert("Terjadi kesalahan, coba lagi nanti");
						}
					});	
					return false;
				});
            }
			
		});

		$("#newpw").on("input", function(){
			var pass = $('#newpw').val();

			$.ajax({
				url : "{{route('password_administrator.passJson')}}",
				type : "POST",
				dataType: 'json',
				data : {
					pass:pass
					},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
					},
				success : function(data){
					if(data == 1){
						$('.error').show();
					}else{
						$('.error').hide();
					}
				},
				error : function(){
					alert("Ada kesalahan controller!");
				}
			})
		});
	});
	

  

		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
