<?php
	include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buraya kanal ismi gelecek - SocialFern.com</title> 

	<!-- Google Font: Source Sans Pro -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type='text/css' />
    <script src="//use.fontawesome.com/64cd5ce7ff.js"></script>
	
	<style>
		.widget-user .card-footer {
			padding-top: 5px;
		}
		.widget-user .widget-user-image {
			left: 4px;
			margin-left: 0;
			position: absolute;
			top: 130px;
		}
		.widget-user .widget-user-header {
			border-top-left-radius: 0.25rem;
			border-top-right-radius: 0.25rem;
			height: 212px;
			padding: 1rem;
			text-align: center;
		}
		#user_name{
			color: black;
			margin-left: 94px;
			margin-top: 138px;
			text-align: left;
		}
		#channel_name{
			color: black;
			margin-left: 94px;
			margin-top: -7px;
			text-align: left;
		}

		span.description-text {
			font-size:12px;
		}

		#numbers{
			font-size:10px;
		}

		#total_grade{
			position: absolute;
			right: -21px;
			margin-top: -6px;
		}
		
		@media (max-width: 576px) {
			.my-element {
				display: none;  /* Hide the element on mobile */
			}

			.my-element-mobile {
				display: block; /* Display the element on mobile */
			}
		}
		
		.rank{
			color:#888da8;
			font-size:12px;
			font-weight:normal;
			padding-top:5px;
		}
		
		.rank-value{
			color:#008080;
			font-size:20px;
			font-weight:bold;
		}
		
		.channel_infos{
			color : #495057;
		}

	
		.card {
			border-radius:5px;
			border:1px solid #e6ecf5;
		}
		
		.description-header{
			font-size:14px !important;
			padding-top:13px;
		}
		
		body {
			margin: 0;
			font-family: Roboto,-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI","Helvetica Neue",Arial,sans-serif;
			font-size: .812rem;
			font-weight: 400;
			line-height: 1.5;
			color: #888da8;
			background-color: #edf2f6;
		}
	</style>
</head>
<body class="hold-transition layout-top-nav" style = "font-family:roboto;">
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-black">
	<div class="container">
	<a href="/home" class="navbar-brand">
		<img src="images/logo.png" alt="AdminLTE Logo" class="brand-image"  style = "height:43px;">
		<span class="brand-text font-weight-light"></span>
	</a>

	<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse order-3 justify-content-end" id="navbarCollapse">
		<!-- Left navbar links -->
		<ul class="navbar-nav mt-2">
		<li class="nav-item dropdown">
			<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
			<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
			<li><a href="#" class="dropdown-item" style = "font-size:1em">Youtube </a></li>
			</ul>
		</li>
		</ul>

		<!-- SEARCH FORM -->
		<form class="form-inline ml-0 ml-md-3" method = "post">
			<div class="input-group input-group-sm">
				<input name = "q" id = "searchInput" required class="form-control form-control-navbar" type="search" placeholder="Enter YouTube Username" aria-label="Search"  style="width: 300px; height: 40px;">
				<div class="input-group-append">
				<button class="btn btn-navbar" type="submit">
					<i class="fas fa-search"></i>
				</button>
				</div>
			</div>
		</form>
	</div>


	<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto mt-1">
   
		<li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
			<?php echo $menu_title; ?>
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<div class="login-box">
				  <div class="card">
					<div class="card-body login-card-body">
					  <p class="login-box-msg"><?php echo $label; ?></p>
					  <div class="social-auth-links text-center mb-3">
							<?php echo $button; ?>
							<?php echo $button_logout; ?>
					  </div>
					</div>
				  </div>
				</div>

		</div>
		</li>
	</ul>
	</div>
</nav>
  
<div class="content-wrapper">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div style = "height:110px; background-color:#fff;"></div>
				</div>
			</div>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-ban"></i> We are sorry, but this user is not found!</h5>
It does not look like we were able to locate this user in our system. Could it be that you entered a display name by accident?
			</div>
			
		</div>
		
	</div>
	<!-- /.content -->
</div>


<?php include "footer.php"; ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<script>
	$(document).ready(function () {
		var selectedItem = $(".dropdown-item").first().text();
		$("#dropdownSubMenu1").text(selectedItem);
		$(".dropdown-item").click(function () {
			selectedItem = $(this).text();
			$("#dropdownSubMenu1").text(selectedItem);
		});
	});


    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let inputValue = document.getElementById('searchInput').value;
        inputValue = inputValue.replace(/^@/, '');
		
        const newUrl = `/search/${inputValue}`;
        window.location.href = newUrl;
    });

	
	
</script>

</body>
</html>
