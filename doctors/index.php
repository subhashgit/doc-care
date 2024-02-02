<?php
define('TITLE', "Doctors");
include '../assets/layouts/head_func.php';
check_logged_in();
include '../assets/layouts/header.php';
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1><?php echo TITLE;?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active"><?php echo TITLE;?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->


    <div class="row">
        <?php if(empty($Doctors)){ ?>
          <div class="col-md-12 btn-primary p-3 text-center">Doctors list is empty</div>
       <?php } else { 
        foreach($Doctors as $Doctor){
        ?>
        <div class="col-md-4">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?php echo $Doctor->doc_profile; ?>" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $Doctor->doc_name; ?></h5>
                  <p class="card-text"><?php echo $Doctor->doc_bio; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
       <?php } 
    } ?>
    </div>
</main>





    <?php

    include '../assets/layouts/footer.php'

    ?>