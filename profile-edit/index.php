<?php

define('TITLE', "Edit Profile");
include '../assets/layouts/header.php';
check_logged_in();

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
<main role="main" class="container">
<div class="row">
<div class="col-md-12">
<form action="includes/sendverificationemail.inc.php" method="post">
<?php insert_csrf_token(); ?>
<p>
    Before proceeding, please check your email for a verification link. If you did not receive the email,
    <button type="submit" name="verifysubmit">click here to send another</button>.
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
</div>
</div>    
<div class="row">
       

        <div class="col-lg-12">
        <form class="form-auth" action="includes/profile-edit.inc.php" enctype="multipart/form-data" method="post"  autocomplete="off">
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
                <span class="h5 font-weight-normal text-muted mb-4">Basic Info</span>
               
                
        <div class="row">
            <div class="col-md-6  form-group">
                <input type="email" value="<?php echo $_SESSION['username']; ?>" class="form-control" required  readonly>
            </div>
            <div class="col-md-6  form-group">
                <input type="text" value="<?php echo $_SESSION['email']; ?>" class="form-control" required  readonly>
            </div>
        </div>    

       
         <div class="row">
            <div class="col-md-6  form-group">
                <input type="text" name="full_name" class="form-control" value="<?php if($user->full_name) {echo $user->full_name;}?>"   placeholder="Full name">
            </div>
            <div class="col-md-6  form-group">
                <input type="number"  name="number" class="form-control" value="<?php if($user->number) {echo $user->number;}?>" placeholder="mobile">
            </div>
        </div>   
        <div class="row">
        <?php
            if($_SESSION['role'] == 'Hospital' || $_SESSION['role'] == 'Clinic' || $_SESSION['role'] == 'Lab'){
        ?>
        
            <div class="col-md-6  form-group">
                <label for="certificate">
                    
                Upload <?php echo $_SESSION['role'] ?> Licence
                </label>
                    <input type="file" id="certificate" name="certificate">
                    <div class="">
                    <?php if($user->certificate) {echo '<a target="_blank" href="../assets/uploads/'.$user->certificate.'">View Old Certificate</a>';}; ?>
                    </div>
            </div>           
       
        <?php }
            else {
            ?>
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

        <?php   
            }
        ?>
 </div>
        <div class="row">
            <div class="col-md-12 form-group ">
                <label id="bio">Bio</label>
                <textarea name="bio" id="bio" row="5" class="form-control"><?php if($user->bio) {echo $user->bio;}?></textarea>
            </div>
        </div>
        
       

        <span class="h5 font-weight-normal text-muted mb-4">Add Location</span>
        <div class="row">
                <div class=" form-group  col-md-4">
                        <input type="text" id="pac-input" name="places"  class="form-control" value="<?php if($user->places) {echo $user->places;}?>" required placeholder="Search Place">
                </div>

                <div class=" form-group  col-md-4">
                        <input type="text" id="city" name="city" placeholder="Your City" value="<?php if($user->city) {echo $user->city;}?>" required  class="form-control" >
                </div>

                <div class=" form-group  col-md-4">
                        <input type="text" id="state" name="state" placeholder="Your State" value="<?php if($user->state) {echo $user->state;}?>" required   class="form-control" >
                </div>
            </div>
            <div class="row">
                <div class=" form-group  col-md-4">
                        <input type="text" id="country" name="country" placeholder="Your Country" value="<?php if($user->country) {echo $user->country;}?>" required   class="form-control" >
                </div>
                <div class=" form-group  col-md-4">
                        <input type="text" id="pincode" name="pincode" placeholder="Your Pin Code" value="<?php if($user->pincode) {echo $user->pincode;}?>" required   class="form-control" >
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                <input type="text" name="lat" value="<?php if($user->lat) {echo $user->lat;}?>" id="lat">
                <input type="text" name="lng" value="<?php if($user->lng) {echo $user->lng;}?>" id="lng">
                        <div id="map"></div>
                </div>
            </div>






                    <button class="btn btn-lg btn-primary btn-block mb-5  mt-5" type="submit" name='update-profile'>Save</button>
        </form>
                
                <hr>
                <form class="form-auth" action="includes/password-edit.inc.php" method="post"  autocomplete="off">
                    <?php insert_csrf_token(); ?>
                    <span class="h5 font-weight-normal text-muted mb-4">Password Edit</span>
                    <br>
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
                </div>
                    <br>

                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Current Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group">
                        <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group mb-5">
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="new-password">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mb-5" type="submit" name='update-password'>Change Password</button>
                
            </form>

        </div>
        <div class="col-md-4">

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

<script >

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 13,
    mapTypeId: "roadmap",
  });
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
