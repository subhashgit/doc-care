<?php
define('TITLE', "Edit Profile");
include '../assets/layouts/head_func.php';
check_logged_in();
include '../assets/layouts/header.php';
?>
<style>
    #map {
        width: 100%;
    height: 300px;
}


.controls {
  background-color: #fff;
  border-radius: 2px;
  border: 1px solid transparent;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  box-sizing: border-box;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  height: 29px;
  margin-left: 17px;
  margin-top: 10px;
  outline: none;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

.controls:focus {
  border-color: #4d90fe;
}

.title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}


</style>
 <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<?php
//XSS filter for session variables
function xss_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<main id="main" class="main">



<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<?php if($_SESSION['auth'] == 'loggedin') { ?>
    <form action="includes/sendverificationemail.inc.php" method="post">
    <?php insert_csrf_token(); ?>
    <p class="mb-0 btn-danger btn">
        Before proceeding, please check your email for a verification link. If you did not receive the email
        <button type="submit" class="btn btn-primary" name="verifysubmit">click here to send another</button>
    </p>
    <br>
    <div class="text-center mt-5">
        <h6 class="text-success">
            <?php
                if (isset($_SESSION['STATUS']['verify']))
                    echo $_SESSION['STATUS']['verify'];

            ?>
        </h6>
    </div>
    </form>

<?php } ?>

<?php
$profileurl = '';
if (isset($_GET["profile"]))
{
    $profileurl = $_GET["profile"];
}
?>

<section class="section dashboard">
<div class="row">
    <div class="col-md-12">

    <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'overview' ){echo 'active';}  ?>" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Overview</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'edit' ){echo 'active';} else if($profileurl == ''){ echo 'active show';}  ?>" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" tabindex="-1" role="tab">Edit Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'availability' ){echo 'active';} ?>" data-bs-toggle="tab" data-bs-target="#profile-availability" aria-selected="false" tabindex="-1" role="tab">Availability</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'social' ){echo 'active';} ?>" data-bs-toggle="tab" data-bs-target="#profile-social" aria-selected="false" tabindex="-1" role="tab">Social</button>
                </li>
               

                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'setting' ){echo 'active';} ?>" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" tabindex="-1" role="tab">Settings</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link <?php if($profileurl == 'password' ){echo 'active';} ?>" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" tabindex="-1" role="tab">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  profile-overview <?php if($profileurl == 'overview' ){echo 'active show';}  ?>" id="profile-overview" role="tabpanel">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">Web Designer</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">USA</div>
                  </div>

                 

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3 <?php if($profileurl == 'edit' ){echo 'active show';} else if($profileurl == ''){ echo 'active show';} ?>" id="profile-edit" role="tabpanel">

                  <!-- Profile Edit Form -->
                  <form class="needs-validation" action="includes/profile-edit.inc.php" enctype="multipart/form-data" method="post" novalidate  autocomplete="off">
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
        <?php
            if($_SESSION['role'] == 'Hospital' || $_SESSION['role'] == 'Clinic' || $_SESSION['role'] == 'Lab'){
        ?>
        

                
                <label for="certificate" class="col-md-4 col-lg-3 col-form-label"> Upload <?php echo $_SESSION['role'] ?> Licence</label>
                <div class="col-md-8 col-lg-9">
                    <input type="file" id="certificate" name="certificate" required>
                    <div class="">
                      <?php if(!empty($user->certificate)) {echo '<a target="_blank" href="../assets/uploads/'.$user->certificate.'">View Old Certificate</a>';}; ?>
                    </div>
            </div>           
       
        <?php }
            else {
            ?>
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

        <?php   
            }
        ?>
 </div>




                    <div class="row mb-3">
                      <label for="bio" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="bio" style="height: 100px"><?php if(!empty($user->bio)) {echo $user->bio;}?></textarea>
                      </div>
                    </div>

                   
                    <div class="row mb-3">
                      <label for="places" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="places" type="text" class="form-control" id="pac-input" value="<?php if(!empty($user->places)) {echo $user->places;}?>" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="city" type="text" class="form-control" id="city" value="<?php if(!empty($user->city)) {echo $user->city;}?>" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state" type="text" class="form-control" id="state" value="<?php if(!empty($user->state)) {echo $user->state;}?>" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="country" value="<?php if(!empty($user->country)) {echo $user->country;}?>" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="pincode" class="col-md-4 col-lg-3 col-form-label">Pin Code</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pincode" type="text" class="form-control" id="pincode" value="<?php if(!empty($user->pincode)) {echo $user->pincode;}?>" required>
                      </div>
                    </div>

                  
                  
                    <div class="row mb-3">
                    <label class="col-md-12 col-lg-12 mb-2">Place the exact marker on map</label>
                      <div class="col-md-12 col-lg-12">
                      <input type="hidden"  name="lat" value="<?php if(!empty($user->lat)) {echo $user->lat;}?>" id="lat">
                      <input type="hidden" name="lng" value="<?php if(!empty($user->lng)) {echo $user->lng;}?>" id="lng">
                        <div id="map"></div>
                      </div>
                    </div>

                    

                    <div class="text-center">
                      <button type="submit" name='update-profile' class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3 <?php if($profileurl == 'availability' ){echo 'active show';} ?>" id="profile-availability" role="tabpanel">
                  <!-- Change Social Form -->
                  <form class="needs-validation" action="includes/availability-edit.inc.php" method="post" validate autocomplete="off">
                    <?php insert_csrf_token(); ?>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['availerror']))
                                echo $_SESSION['ERRORS']['availerror'];
                        ?>
                        
                    </sub>
                    <br>
                    <div class="text-center">
                    <small class="text-success font-weight-bold">
                    <?php
                            if (isset($_SESSION['STATUS']['editavailstatus']))
                                echo $_SESSION['STATUS']['editavailstatus'];

                        ?>
                    </small>
              </div>
              <div class="row mb-3">
                      <label for="pincode" class="col-md-4 col-form-label">Available 24x7</label>
                      <div class="col-md-8">
                          <div class="form-check">
                          <input class="form-check-input" name="24x7" type="checkbox" id="24x7" value="1" <?php if(!empty($Available->twentyxs) && $Available->twentyxs == 1){echo 'checked';} ?>>
                        </div>
                      </div>
              </div>
              <div class="if_available  <?php if(!empty($Available->twentyxs) && $Available->twentyxs  == 1){echo 'd-none';} ?>">
                  <div class="row">
                    <label for="Day" class="col-4  col-form-label"><strong>Day</strong></label>
                    <label for="From" class="col-4  col-form-label"><strong>From</strong></label>
                    <label for="To" class="col-4  col-form-label"><strong>To</strong></label>
                  </div>

                    <div class="row mb-3">
                      <label for="Monday" class="col-4 col-form-label">Monday</label>
                      <div class="col-4">
                        <input name="mon_from" type="time" class="form-control" id="mon_from" value="<?php if(!empty($Available->alldaysame)){echo $Available->mon_from;} ?>" >
                      </div>
                      <div class="col-4">
                        <input name="mon_to" type="time" class="form-control" id="mon_to" value="<?php if(!empty($Available->alldaysame)){echo $Available->mon_to;} ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="alldaysame" class="col-md-4 col-form-label">All day same</label>
                      <div class="col-md-8">
                          <div class="form-check">
                          <input class="form-check-input" name="alldaysame" type="checkbox" id="alldaysame" value="1" <?php if(!empty($Available->alldaysame) && $Available->alldaysame == 1){echo 'checked';} ?>>
                        </div>
                      </div>
                  </div>

                      <div class="if_alldaysame <?php if(!empty($Available->alldaysame) && $Available->alldaysame == 1){echo 'd-none';} ?>">
                        <small>Leave blank for Holiday</small>
                      <div class="row mb-3">
                      <label for="Tuesday" class="col-4 col-form-label">Tuesday</label>
                      <div class="col-4">
                        <input name="tue_from" type="time" class="form-control" id="tue_from"     value="<?php if(!empty($Available->tue_from)){echo $Available->tue_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="tue_to" type="time" class="form-control" id="tue_to"  value="<?php if(!empty($Available->tue_to)){echo $Available->tue_to;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Wednesday" class="col-4 col-form-label">Wednesday</label>
                      <div class="col-4">
                        <input name="wed_from" type="time" class="form-control" id="wed_from"  value="<?php if(!empty($Available->wed_from)){echo $Available->wed_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="wed_to" type="time" class="form-control" id="wed_to"  value="<?php if(!empty($Available->wed_to)){echo $Available->wed_to;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Thursday" class="col-4 col-form-label">Thursday</label>
                      <div class="col-4">
                        <input name="thu_from" type="time" class="form-control" id="thu_from"  value="<?php if(!empty($Available->thus_from)){echo $Available->thus_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="thu_to" type="time" class="form-control" id="thu_to"  value="<?php if(!empty($Available->thus_to)){echo $Available->thus_to;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Friday" class="col-4 col-form-label">Friday</label>
                      <div class="col-4">
                        <input name="fri_from" type="time" class="form-control" id="fri_from"  value="<?php if(!empty($Available->fri_from)){echo $Available->fri_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="fri_to" type="time" class="form-control" id="fri_to"  value="<?php if(!empty($Available->fri_to)){echo $Available->fri_to;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Saturday" class="col-4 col-form-label">Saturday</label>
                      <div class="col-4">
                        <input name="sat_from" type="time" class="form-control" id="sat_from"  value="<?php if(!empty($Available->sat_from)){echo $Available->sat_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="sat_to" type="time" class="form-control" id="sat_to"  value="<?php if(!empty($Available->sat_to)){echo $Available->sat_to;} ?>">
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="Sunday" class="col-4 col-form-label">Sunday</label>
                      <div class="col-4">
                        <input name="sun_from" type="time" class="form-control" id="sun_from"  value="<?php if(!empty($Available->sun_from)){echo $Available->sun_from;} ?>">
                      </div>
                      <div class="col-4">
                        <input name="sun_to" type="time" class="form-control" id="sun_to"  value="<?php if(!empty($Available->sun_to)){echo $Available->sun_to;} ?>">
                      </div>
                    </div>

                </div>
              </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary"  name="update-availability">Change Availability</button>
                    </div>
                  </form><!-- End  Avaulability Form -->

                </div>


                <div class="tab-pane fade pt-3 <?php if($profileurl == 'social' ){echo 'active show';} ?>" id="profile-social" role="tabpanel">
                  <!-- Change Social Form -->
                  <form class="needs-validation" action="includes/social-edit.inc.php" method="post" validate autocomplete="off">
                    <?php insert_csrf_token(); ?>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['socialerror']))
                                echo $_SESSION['ERRORS']['socialerror'];
                        ?>
                        
                    </sub>
                    <br>
                    <div class="text-center">
                    <small class="text-success font-weight-bold">
                    <?php
                            if (isset($_SESSION['STATUS']['editsstatus']))
                                echo $_SESSION['STATUS']['editsstatus'];

                        ?>
                    </small>
              </div>
                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="url" class="form-control" id="Twitter" value="<?php if(!empty($Social->twitter)){echo $Social->twitter;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="url" class="form-control" id="Facebook" value="<?php if(!empty($Social->twitter)){echo $Social->facebook;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="<?php if(!empty($Social->twitter)){echo $Social->instagram;} ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?php if(!empty($Social->twitter)){echo $Social->linkedin;} ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary"  name="update-social">Save</button>
                    </div>
                  </form><!-- End  Social Form -->

                </div>


                <div class="tab-pane fade pt-3 <?php if($profileurl == 'setting' ){echo 'active show';} ?>" id="profile-settings" role="tabpanel">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked="">
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked="">
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked="" disabled="">
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->
                </div>

                <div class="tab-pane fade pt-3 <?php if($profileurl == 'password' ){echo 'active show';} ?>" id="profile-change-password" role="tabpanel">
                  <!-- Change Password Form -->
                  <form class="needs-validation" action="includes/password-edit.inc.php" method="post" novalidate autocomplete="off">
                    <?php insert_csrf_token(); ?>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];
                        ?>
                        
                    </sub>
                    <br>
                    <div class="text-center">
                    <small class="text-success font-weight-bold">
                    <?php
                            if (isset($_SESSION['STATUS']['editpstatus']))
                                echo $_SESSION['STATUS']['editpstatus'];

                        ?>
                    </small>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newpassword" required autocomplete="new-password">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" required autocomplete="new-password">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary"  name="update-password">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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
    $('#imagePreview').attr('src','<?php if(!empty($user->profile_pic)){ echo '../assets/uploads/users/'.$user->profile_pic; } else {echo '../assets/uploads/default_user.png';} ?>');
    readURL(this);
  });
   

    $('input#24x7').click(function(){
      if ($('input#24x7').is(':checked')) {
        $('.if_available').toggleClass('d-none');
      }
      else{
        $('.if_available').toggleClass('d-none');
      }
    });
    $('input#alldaysame').click(function(){
      if ($('input#alldaysame').is(':checked')) {
        $('.if_alldaysame').toggleClass('d-none');
      }
      else{
        $('.if_alldaysame').toggleClass('d-none');
      }

    });

</script>

<script >

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
  <?php if(!empty($user->lat) || !empty($user->lng) ){ ?>
    center: { lat: <?php echo $user->lat; ?>, lng:<?php echo $user->lng; ?> },
    <?php } else { ?>
      center: { lat: -33.8688, lng: 151.2195 },
      <?php  } ?>
    zoom: 13,
    mapTypeId: "roadmap",
  });
  <?php if(!empty($user->lat) || !empty($user->lng) ){ ?>
  var marker = new google.maps.Marker({
        position: { lat: <?php echo $user->lat; ?>, lng:<?php echo $user->lng; ?> },
        map: map,
        label: "<?php echo $user->places; ?>"
    });
    <?php  } ?>
    // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

//    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!"
  });

  infoWindow.open(map);

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        }),
      );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);

      } else {
        bounds.extend(place.geometry.location);
      }
     // console.log(place.geometry.location);


/** */
const latlong = place.geometry.location.toJSON();
    $('#lat').val(latlong.lat);
    $('#lng').val(latlong.lng);

    console.log(place.geometry);

    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: place.geometry.location,
    });
    infoWindow.setContent(
      'You are here'
        //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
    );
    infoWindow.open(map);


var whole_address = place.address_components;  //alert(whole_address + 'whole_address');   
		$('#city').val('');
		$('#state').val('');
		$('#country').val('');
		$('#pincode').val('');
		
		$.each(whole_address, function(key1, value1) 
		{
			//alert(value1.long_name);
			//alert(value1.types[0]);
			
			
			if((value1.types[0]) == 'locality')
			{
				var prev_long_name_city = value1.long_name;  
				//alert(prev_long_name_city + '__prev_long_name_city');
				$('#city').val(prev_long_name_city);
			}
			
			
			if((value1.types[0]) == 'administrative_area_level_1')
			{
				var prev_long_name_state = value1.long_name;  
				//alert(prev_long_name_state + '__prev_long_name_state');
				$('#state').val(prev_long_name_state);
			}
			
			if((value1.types[0]) == 'country')
			{
				var prev_long_name_country = value1.long_name;  
				//alert(prev_long_name_country + '__prev_long_name_country');
				$('#country').val(prev_long_name_country);
			}
			
			if((value1.types[0]) == 'postal_code')
			{
				var prev_long_name_pincode = value1.long_name;  
				//alert(prev_long_name_pincode + '__prev_long_name_pincode');
				$('#pincode').val(prev_long_name_pincode);
			}
                


		});
/** */
});





    map.fitBounds(bounds);
  });


/** on click map */



map.addListener("click", (mapsMouseEvent) => {
   
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      'You are here'
        //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
    );
    const latlong = mapsMouseEvent.latLng.toJSON();
    $('#lat').val(latlong.lat);
    $('#lng').val(latlong.lng);


    infoWindow.open(map);
  });
/** */

  
}

window.initMap = initMap;
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqF4tcu-Owi8ZV0Ds89bCQBahf_3WFjOs&callback=initMap&libraries=places&v=weekly" defer></script>
