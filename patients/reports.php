<?php
define('TITLE', "Edit Profile");
include '../assets/layouts/head_func.php';
include 'includes/functions.php';
$patientdetail = specificpatient($_GET['pt_id']); 
if(EMPTY($patientdetail)){
  header("Location: ../patients");
}
check_verified();
include '../assets/layouts/header.php';


?>
<link href="../assets/vendors/simple-datatables/style.css" rel="stylesheet">  
<main id="main" class="main">


<div class="pagetitle">
  <h1>Upload reports( <?php echo $patientdetail->pt_name; ?>)</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Edit</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<section class="section dashboard">
<div class="row">
    <div class="col-md-12">

    <div class="card">
            <div class="card-body pt-3">

<form class="needs-validation" action="includes/reports-upload.php" enctype="multipart/form-data" method="post" novalidate  autocomplete="off">
                    <?php insert_csrf_token(); ?>
                    <div class="text-center">
                        <sub class="text-danger">
                            <?php
                                if (isset($_SESSION['ERRORS']['sqlerror']))
                                    echo $_SESSION['ERRORS']['sqlerror'];
                            ?>
                        </sub>
                    </div>
                    <div class="text-center">
                        <sub class="text-danger">
                            <?php
                                if (isset($_SESSION['ERRORS']['imageerror']))
                                    echo $_SESSION['ERRORS']['imageerror'];

                            ?>
                        </sub>
                    </div>
                    <div class="text-center">
                        <sub class="text-success">
                            <?php
                                if (isset($_SESSION['STATUS']['editstatus']))
                                    echo $_SESSION['STATUS']['editstatus'];

                            ?>
                        </sub>
                    </div>
                   <input type="hidden" name="pt_id" value="<?php echo $patientdetail->id; ?>">

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName"  value="" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="reports" class="col-md-4 col-lg-3 col-form-label">Upload Reports</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="reports[]" type="file" class="form-control" id="reports" required multiple />
                        
                      </div>
                    </div>
                   
       
 <button class="btn btn-lg btn-primary btn-block mb-5  mt-0" type="submit" name='upload-reports'>Upload</button>
        </form>
                
             


        <?php $reports =   patientreports($_GET['pt_id']); 
             
             if(!EMPTY($reports)){
             ?>
                     <table class="table datatable">
                       <tr>
                         <th>#</th>
                         <th>Name</th>
                         <th>File</th>
                         <th>Action</th>
                     </tr>

                     <?php
                $counter=1;
                     foreach($reports as $report){
                     ?>
                     <tr>
                         <th><?php echo $counter++ ?></th>
                         <th><?php echo $report->name; ?></th>
                         <th>
                           <a href="uploads/reports/<?php echo $report->file; ?>" data-bs-toggle="tooltip" data-bs-original-title="View" Title="View" class="btn btn-primary"><i class="bi  bi-eye-fill"></i></a>
                           <a href="uploads/reports/<?php echo $report->file; ?>" data-bs-toggle="tooltip" data-bs-original-title="Download" Title="Download" download="<?php echo $report->file; ?>" class="btn btn-primary"><i class="bi  bi-cloud-download-fill"></i></a>
                         </th>
                         <th><a href="?delete_report=<?php echo $report->id; ?>&pt_id=<?php echo $_GET['pt_id'];?>&name=<?php echo $report->name;?>" data-bs-toggle="tooltip" data-bs-original-title="Delete" class="btn btn-danger"><i class="bi bi-trash"></i></a>  </th>
                     </tr>
                     <?php } ?>
                     </table>
<?php }  else {

echo 'No report found'; 
}?>


        </div>
       
    </div>
</div>
</section>

<?php
if(isset($_GET['delete_report'])){
  ?>
<div class="modal fade" id="reportsdelete" tabindex="-1">
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
                      <a href="includes/delete.php?report_id=<?php echo $_GET['delete_report']; ?>&pt_id=<?php echo $_GET['pt_id'];  ?>" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->
  <?php
}
?>

</main>
<script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
<?php
include '../assets/layouts/footer.php';
?>
<script>
  <?php
if(isset($_GET['delete_report'])){
  ?>
  $(window).on('load', function() {
    $('#reportsdelete').modal('show');
});

  <?php } ?>

  </script>

