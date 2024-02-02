<?php
define('TITLE', "Edit Profile");
include '../assets/layouts/head_func.php';
check_logged_in();
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
  




<form class="needs-validation" action="includes/doctor-edit.inc.php" enctype="multipart/form-data" method="post" novalidate  autocomplete="off">
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
                        <img src="<?php if (!empty($user->profile_pic)){ echo '../assets/uploads/users/'.$user->profile_pic;} else{echo '../assets/uploads/default_user.png'; }?>" id="imagePreview" width="150"  alt="Profile">
                        <div class="pt-2">
                        <input name='avatar'  class="d-none avatar " type='file' />
                          <a href="#" class="btn btn-primary btn-sm" id="avatar" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" id="remove_avatar" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="full_name" type="text" class="form-control" id="fullName"  value="<?php if(!empty($user->full_name)) {echo $user->full_name;}?>" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="number" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="number" type="text" class="form-control" id="number" value="<?php if(!empty($user->number)) {echo $user->number;}?>" required>
                      </div>
                    </div>

                    
                    <div class="row mb-3">               
                        <label for="certificate" class="col-md-4 col-lg-3 col-form-label"> Upload Document</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="file" id="certificate" name="certificate" required>
                            <div class="">
                            <?php if(!empty($user->certificate)) {echo '<a target="_blank" href="../assets/uploads/'.$user->certificate.'">View Old Certificate</a>';}; ?>
                            </div>
                    </div>           
       
       
        
             <label for="certificate" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                <div class="col-md-8 col-lg-9">
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="m" <?php if(!empty($user->gender) && $user->gender == 'm') {echo 'checked';}?> >
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f"  <?php if(!empty($user->gender) && $user->gender == 'f') {echo 'checked';}?>>
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="other" name="gender" class="custom-control-input" value="o" <?php if(!empty($user->gender) && $user->gender == 'o') {echo 'checked';}?>>
                        <label class="custom-control-label" for="female">Other</label>
                    </div>
                </div> 

        





                    <div class="row mb-3">
                      <label for="bio" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="bio" style="height: 100px"><?php if(!empty($user->bio)) {echo $user->bio;}?></textarea>
                      </div>
                    </div>
  
       
 <button class="btn btn-lg btn-primary btn-block mb-5  mt-5" type="submit" name='update-profile'>Save</button>
        </form>
                
             

        </div>
       
    </div>
</div>

</main>

<?php

include '../assets/layouts/footer.php';

?>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        console.log("here");
        readURL(this);
    });
</script>

