<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Static Login Form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

<!--script-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});
	});		
</script>	
<!--script-->
<style>
	.login input[type="text"], .login input[type="password"] {
		width: 100%;
	}

	.login-bottom {
		margin-top: 7%;
		margin-left: 0%;
	}
</style>
</head>
<body style="background-image: url('{{ asset('images/gedung.jpg')}}');">
	<div class="head">
		<div class="logo">
			<div class="logo-top">
				<h1 style="background-size:100px" ><img alt="Logo" src="{{asset('images/logo-login.png')}}" /></h1>
			</div>

		</div>		
		<div class="login">
			<div class="sap_tabs">
				<div id="horizontalTab" style="display: block; width: 100%; margin: auto;padding-top:50px;">
					<ul class="resp-tabs-list">
						<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Login to your account</span></li>
						<div class="clearfix"></div>
					</ul>				  	 
					<div class="resp-tabs-container">
						<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
							<div class="login-top">
                               <form action="{{ route('perjalanan_dinas.index') }}" method="get">
                                {{csrf_field()}}
									<input type="text" name="usernm" class="email" placeholder="Username" required=""/>
									<input type="password" name="userpw" class="password" placeholder="Password" required=""/>		
									<div class="login-bottom">
										<div class="text-center">
											<a href="{{ route('perjalanan_dinas.index') }}" class="btn btn-brand" type="button">LOGIN</a>
										</div>
										<div class="clear"></div>
									</div>	
								</form>
							</div>
						</div>							
					</div>	
				</div>
			</div>	
		</div>	
		<div class="clear"></div>
	</div>	
</body>
</html>
