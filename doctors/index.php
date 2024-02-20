<?php
define('TITLE', "Doctors");
include '../assets/layouts/head_func.php';
check_verified();
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
                <img src="<?php if(!empty($Doctor->doc_profile)){ ?>uploads/profile/<?php echo $Doctor->doc_profile; } else { ?> ../assets/uploads/default_user.png <?php } ?>" class="img-fluid rounded-start" alt="...">
              </div>
              
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $Doctor->doc_name; ?></h5>
                  <p class="card-text"><?php echo $Doctor->doc_bio; ?></p>
                  
                </div>
              </div>

              <div class="btn-group mt-2" role="group" aria-label="Basic mixed styles example">
                <a href="edit?id=<?php echo $Doctor->id; ?>" class="btn btn-success">Edit</a> 
                <a href="delete?id=<?php echo $Doctor->id; ?>" class="btn btn-danger">Delete</a>
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