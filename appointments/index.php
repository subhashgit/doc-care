<?php
define('TITLE', "Doctors");
include '../assets/layouts/head_func.php';
include 'includes/functions.php';
check_verified();
include '../assets/layouts/header.php';
?>
<link href="../assets/vendors/simple-datatables/style.css" rel="stylesheet">
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
        <?php if(empty($staff)){ ?>
          <div class="col-md-12 btn-primary p-3 text-center">Staff list is empty</div>
       <?php } else { 
        ?>
 <table class="table datatable">
                <thead>
                  <tr>
                    <th>Profile</th>
                    <th><b>N</b>ame</th>
                    <th>Role</th>
                    <th>Number</th>
                    <th>Gender</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
        <?php
        foreach($staff as $staff){
        ?>
                          <tr>
                    <th> <img src="<?php if(!empty($staff->staff_profile)){ ?>uploads/profile/<?php echo $staff->staff_profile; } else { ?> ../assets/uploads/default_user.png <?php } ?>" class="img-fluid rounded-start" width="50" alt="..."></th>
                    <th><b><?php if(!empty($staff->staff_name)){ echo $staff->staff_name; }?></b></th>
                    <th><?php if(!empty($staff->role)){ echo $staff->role; }?></th>
                    <th><?php if(!empty($staff->staff_number)){ echo $staff->staff_number; }?></th>
                    <th><?php if(!empty($staff->staff_gender)){ echo $staff->staff_gender; }?></th>
                    <th><a href="edit?id=<?php echo $staff->id; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a> 
                <a href="delete?id=<?php echo $staff->id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>  </th>
                  </tr>
        <?php
       }
       ?>
     
       
        </tbody>
              </table>
       <?php
    } ?>
    </div>
</main>


<script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <?php
    include '../assets/layouts/footer.php'
    ?> 
