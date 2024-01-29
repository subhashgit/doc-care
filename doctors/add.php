<?php

define('TITLE', "Add new doctor");
include '../assets/layouts/header.php';
check_logged_in();

?>
<main role="main" class="container">
  
<div class="row">
        <div class="col-lg-12">
        <form class="form-auth" action="includes/doctor-edit.inc.php" enctype="multipart/form-data" method="post"  autocomplete="off">
            <?php insert_csrf_token(); ?>
                <div class="picCard mb-5 text-center">
                    <div class="avatar-upload">
                        <div class="avatar-preview text-center">
                            <div id="imagePreview" style="<?php if ($user->profile_pic){ echo 'background-image: url( ../assets/uploads/users/'.$user->profile_pic; }?>);">
                            <?php if (empty($user->profile_pic)){ 
                                  echo substr($_SESSION['username'], 0, 1); 
                            } ?>
                            </div>
                        </div>
                        <div class="avatar-edit">
                            <input name='avatar' id="avatar" class="fas fa-pencil" type='file' />
                            <label for="avatar"></label>
                        </div>
                    </div>
                </div>
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
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['editstatus']))
                                echo $_SESSION['ERRORS']['editstatus'];

                        ?>
                    </sub>
                </div>
     
               
                
      
       
         <div class="row">
            <div class="col-md-6  form-group">
                <input type="text" name="name" class="form-control" value="<?php if($user->full_name) {echo $user->full_name;}?>"   placeholder="Full name">
            </div>
            <div class="col-md-6  form-group">
                <input type="number"  name="number" class="form-control" value="<?php if($user->number) {echo $user->number;}?>" placeholder="mobile">
            </div>
        </div>   
        <div class="row">
       
        
                <div class="col-md-6  form-group">
                    <label for="certificate">                
                    Upload Doctor Document
                    </label>
                    <input type="file" id="certificate" name="certificate">
                    <div class="">
                    <?php if($user->certificate) {echo '<a target="_blank" href="../assets/uploads/'.$user->certificate.'">View Old Certificate</a>';}; ?>
                    </div>
                </div>           
       
        
                <div class="form-group col-md-6 mb-6">
                    <label>Gender</label>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="m" <?php if($user->gender && $user->gender == 'm') {echo 'checked';}?> >
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f"  <?php if($user->gender && $user->gender == 'f') {echo 'checked';}?>>
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="other" name="gender" class="custom-control-input" value="o" <?php if($user->gender && $user->gender == 'o') {echo 'checked';}?>>
                        <label class="custom-control-label" for="female">Other</label>
                    </div>
                </div> 

       
 </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="specialist">	Specialist	</label>
                    <select name="specialist" class="form-control" id="specialist">
                        <?php foreach ($resultArraySpc as $resultArraySp){
                            echo '<option value="'.$resultArraySp->name.'">'.$resultArraySp->name.'</option>';
                        } ?>
                    </select>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                    
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 form-group ">
                <label id="bio">Bio</label>
                <textarea name="bio" id="bio" row="5" class="form-control"><?php if($user->bio) {echo $user->bio;}?></textarea>
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

