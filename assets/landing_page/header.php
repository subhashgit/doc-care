<?php
  session_start();
  define('BASE_URL', 'http://localhost/caredoc/');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="we are here for help you">
    <title><?php echo TITLE ; ?></title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>assets/assets_guest/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo BASE_URL ?>assets/assets_guest/css/style.css" rel="stylesheet">
</head>
<body>
    
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        <i class="bi bi-phone"></i> +1 5589 55488 55
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Medilab</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/assets_guest/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#departments">Departments</a></li>
          <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php if (!isset($_SESSION['auth'])){ ?> 
      <a href="<?php echo BASE_URL ?>/register" class="appointment-btn scrollto"><span class="d-none d-md-inline">Signup</a>
      <a href="<?php echo BASE_URL ?>/login" class="appointment-btn scrollto"><span class="d-none d-md-inline">login</a>
     <?php } else {?>
      <a href="<?php echo BASE_URL ?>/home" class="appointment-btn scrollto"><span class="d-none d-md-inline">Dashboard</a>
<?php } ?>
    </div>
  </header><!-- End Header -->
