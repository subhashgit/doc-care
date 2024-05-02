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
      <li class="breadcrumb-item"><a href="../">Home</a></li>
      <li class="breadcrumb-item active"><?php echo TITLE;?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->


    <div class="row">
    <?php  if (isset($_SESSION['STATUS']['deletestatus']))  { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo   $_SESSION['STATUS']['deletestatus']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
<?php } ?>

        <?php if(empty($patients)){ ?>
          <div class="col-md-12 btn-primary p-3 text-center">patients list is empty</div>
       <?php } else { 
        ?>
 <table class="table datatable">
                <thead>
                  <tr>
                    
                    <th><b>N</b>ame</th>
                   
                    <th>Number</th>
                    <th>Gender</th>
                    <th>Reports</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
        <?php
        foreach($patients as $patient){
        ?>
                  <tr>
                    
                    <th><b><?php if(!empty($patient->pt_name)){ echo $patient->pt_name; }?></b></th>
                    <th><?php if(!empty($patient->pt_number)){ echo $patient->pt_number; }?></th>
                    <th><?php if(!empty($patient->pt_gender)){ echo $patient->pt_gender; }?></th>
                    <th>

                      <a href="reports?pt_id=<?php  echo $patient->id;  ?>" data-bs-toggle="tooltip" data-bs-original-title="Upload" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                    </th>
                    <th><a href="edit?id=<?php echo $patient->id; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a> 
                <a href="?delete_id=<?php echo $patient->id; ?>&name=<?php echo $patient->pt_name;  ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>  </th>
                
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


<?php
if(isset($_GET['delete_id'])){
  ?>
<div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Are you sure?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    You want to delete <b>(<?php echo $_GET['name'] ?>)</b>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="includes/delete.php?id=<?php echo $_GET['delete_id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->
  <?php
}
?>






<script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
 
<?php
    include '../assets/layouts/footer.php'
    ?> 

<script type="text/javascript">
    <?php
if(isset($_GET['delete_id'])){
  ?>

$(window).on('load', function() {
        $('#basicModal').modal('show');
    });
<?php } ?>
    <?php
if(isset($_GET['pt_id'])){
  ?>
  $(window).on('load', function() {
    $('#reports').modal('show');
});

  <?php } ?>
</script>