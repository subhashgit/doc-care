<?php
  define('TITLE', "Edit Profile");
  include '../assets/layouts/head_func.php';
  check_verified();
  include '../assets/layouts/header.php';
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add Doctor</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Add new doctor</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body pt-3">
              <?php echo $_GET['id']; ?>
            </div>
        </div>
      </div>
  </div>
  </section>
</main>
<?php  include '../assets/layouts/footer.php'; ?>