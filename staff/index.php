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
    <?php  if (isset($_SESSION['STATUS']['deletestatus']))  { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo   $_SESSION['STATUS']['deletestatus']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
<?php } ?>
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
                <a href="?delete_id=<?php echo $staff->id; ?>&name=<?php echo $staff->staff_name;  ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>  </th>
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
    $(window).on('load', function() {
        $('#basicModal').modal('show');
    });

</script>