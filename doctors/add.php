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
</div><!-- End Page Title -->
  

<section class="section dashboard">
<div class="row">
    <div class="col-md-12">

    <div class="card">
            <div class="card-body pt-3">

<form class="needs-validation" action="includes/doctor-add.inc.php" enctype="multipart/form-data" method="post" novalidate  autocomplete="off">
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
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="../assets/uploads/default_user.png" id="imagePreview" width="150"  alt="Profile">
                        <div class="pt-2">
                        <input name='avatar'  class="d-none avatar " type='file'  />
                          <a href="#" class="btn btn-primary btn-sm" id="avatar" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" id="remove_avatar" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="full_name" type="text" class="form-control" id="fullName"  value="" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="number" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="number" type="text" class="form-control" id="number" value="" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="number" class="col-md-4 col-lg-3 col-form-label">Specilist</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="form-select" multiple="true" name="specialist[]" required >
                      <option selected="" value="">Select Specilities</option>
                        <?php foreach($Specialists as $Specialist) {  ?>
                              <option value="<?php echo $Specialist->name; ?>"><?php echo $Specialist->name; ?></option>
                          <?php } ?>
                    </select>
                      </div>
                    </div>

                        
       
         <div class="row mb-3">
        
             <label for="certificate" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                <div class="col-md-8 col-lg-9">
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="form-check-input" required value="m"  >
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="form-check-input" required value="f">
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="other" name="gender" class="form-check-input" required value="o">
                        <label class="custom-control-label" for="other">Other</label>
                    </div>
                </div> 
      </div>
        

      <div class="row mb-3">
                      <label for="certificate" class="col-md-4 col-lg-3 col-form-label">Doctor Certificate</label>
                      <div class="col-md-8 col-lg-9">
                       
                       
                        <input class="form-control" type="file" name="certificate" id="certificate">
                       
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="bio" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="bio" style="height: 100px"></textarea>
                      </div>
                    </div>
  
       
                     <button class="btn btn-lg btn-primary btn-block mb-5  mt-5" type="submit" name='add-doctor'>Save</button>
        </form>
                
        </div>
        </div>
        </div>
        </div>
</section>

        

</main>

<?php

include '../assets/layouts/footer.php';

?>

    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
           
                $('#imagePreview').attr('src', e.target.result );
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar").click(function() {  
    $(".avatar").click();
 
    });

    $('.avatar').change(function(){
      
    readURL(this);
  });

  $('#remove_avatar').click(function(){
    $('.avatar').val('');
    $('#imagePreview').attr('src','../assets/uploads/default_user.png');
    readURL(this);
  });

</script>
