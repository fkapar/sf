<?php
	include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="https://www.socialfern.com">
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-K3YH5LQ05S"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-K3YH5LQ05S');
	</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="SocialFern can help you track YouTube Channel Statistics and much more! You can compare yourself to other users and analyze your growth!">

	<title>Privacy Policy - Social Fern</title> 
	

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
		:root {
		  --puan-arkaplan-renk:<?php echo $puanArkaplanRengi; ?>;
		}
		.footer_link {
			color:#869099;
		}
	
	</style>
	
	
	
	<link rel="stylesheet" href="sf/sf_custom.css">

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
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><img src = "/images/logo-100x100.png" width = "48px"> <span class = "font-size:1.5em; padding-top:10px">Social Fern</span></h3>
              </div>
              <div class="card-body p-0"  style = "font-size:14px;">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="/info/about" class="nav-link">
                      About Social Fern
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/info/privacy" class="nav-link">
                      Privacy Policy
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/info/terms" class="nav-link">
                     Terms of Service
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/request/data/removal" class="nav-link">
                      <b>Data Removal Request</b>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/contact" class="nav-link">
                      Contact Us
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5><b>DATA REMOVAL REQUEST</b></h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-3">
              <!-- /.mailbox-controls -->
<div  style = "font-size:14px;">
<p>
Social Fern crawls and collects public facing data available from API's on multiple platforms. Our goal is to get a conclusive idea of the creator ecosystem while providing useful statistics which are available to everyone.

That said, Social Fern understands the need for privacy and data security. Below are the platform(s) that are available for Data Removal Requests, currently.</p><br>
<a class = "bg-info p-2" href = "<?php echo $url; ?>">Profile</a>
              </div>
              <!-- /.mailbox-read-message -->
            </div>

            <!-- /.card-footer -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
