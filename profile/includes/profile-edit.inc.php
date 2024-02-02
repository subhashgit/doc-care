<?php
session_start();

require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_logged_in();
require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['update-profile'])) {

    /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
      
    }

    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../");
        exit();
    }
   

    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';
    
         $id = $_SESSION['id'];
      /*  $full_name = $_POST['full_name'];
        $number = $_POST['number'];
        $bio = $_POST['bio'];
        $places = $_POST['places'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pincode = $_POST['pincode'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
*/

        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $places = mysqli_real_escape_string($conn, $_POST['places']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $lat = mysqli_real_escape_string($conn, $_POST['lat']);
        $lng = mysqli_real_escape_string($conn, $_POST['lng']);


    if(isset($_POST['gender']))
    {
        $gender =     $_POST['gender'];
    }
    else{
        $gender = null;
    }
    


// INSERT INTO customer_data (customer_id, customer_name, customer_place)  VALUES(2, "Vaani","Denver") ON DUPLICATE KEY UPDATE customer_name = "Hevika", customer_place = "Denver";
if (empty($full_name) || empty($number) || empty($places) || empty($city) || empty($state) || empty($country) || empty($pincode) || empty($lat) || empty($lng)) {
    $_SESSION['ERRORS']['editstatus'] = 'required fields cannot be empty, try again';
   
    header("Location: ../?profile=edit");
    exit();
}

    else {

        /*
        * -------------------------------------------------------------------------------
        *   Image Upload
        * -------------------------------------------------------------------------------
        */

        

        if (!empty($_FILES['avatar']['name']))
        {
            $fileName = $_FILES['avatar']['name'];
            $fileTmpName = $_FILES['avatar']['tmp_name'];
            $fileSize = $_FILES['avatar']['size'];
            $fileError = $_FILES['avatar']['error'];
            $fileType = $_FILES['avatar']['type']; 

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileActualExt, $allowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 10000000)
                    {
                        $FileNameNew = strtoupper(md5(uniqid(rand(),true))) . "profile." . $fileActualExt;
                        $fileDestination = '../../assets/uploads/users/' . $FileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        /*
                        * -------------------------------------------------------------------------------
                        *   Deleting old profile photo
                        * -------------------------------------------------------------------------------
                        */
						
                    }
                    else
                    {
                        $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                        header("Location: ../?profile=edit");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../?profile=edit");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../?profile=edit");
                exit();
            }
        }
        /** Certificate */


//        $certify = $_FILES['certificate'];

        if (!empty($_FILES['certificate']['name']))
        {
            $certifyName = $_FILES['certificate']['name'];
            $certifyTmpName = $_FILES['certificate']['tmp_name'];
            $certifySize = $_FILES['certificate']['size'];
            $certifyError = $_FILES['certificate']['error'];
            $certifyType = $_FILES['certificate']['type']; 

            $certifyExt = explode('.', $certifyName);
            $certifyActualExt = strtolower(end($certifyExt));

            $certifyallowed = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($certifyActualExt, $certifyallowed))
            {
                if ($certifyError === 0)
                {
                    if ($certifySize < 10000000)
                    {
                        $certifyNameNew = md5(uniqid(rand(),true)) . "certi." . $certifyActualExt;
                        $certifyDestination = './../../assets/uploads/' . $certifyNameNew;
                        // print_r($certifyDestination);
                         //  die();
                        move_uploaded_file($certifyTmpName, $certifyDestination);

						
                    }
                    else
                    {
                        $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                        header("Location: ../?profile=edit");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../?profile=edit");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../?profile=edit");
                exit();
            }
        }
        else{
            $certifyNameNew = null;
        }

       
        
        

        /*
        * -------------------------------------------------------------------------------
        *   User Updation
        * -------------------------------------------------------------------------------
        */


        $datasql = "SELECT id FROM profile WHERE user_id = ".$_SESSION['id'];
        $result = $conn->query($datasql);

             if(mysqli_num_rows($result) == 0){
        

       if( !empty($_FILES['avatar']['name']) && !empty($_FILES['certificate']['avatar'])){
        
        $sql = "INSERT INTO profile  (user_id, full_name, number, bio, gender, places, city, state, country, pincode, lat, lng, profile_pic, certificate)
        VALUES ('$id', '$full_name', '$number', '$bio', '$gender', '$places', '$city', '$state', '$country', '$pincode', '$lat', '$lng', '$FileNameNew', '$certifyNameNew')";
      
       }    
       else if( !empty($_FILES['avatar']['name']) && empty($_FILES['certificate']['name'])){

        $sql = "INSERT INTO profile  (user_id, full_name, number, bio, gender, places, city, state, country, pincode, lat, lng, profile_pic)
        VALUES ('$id', '$full_name', '$number', '$bio', '$gender', '$places', '$city', '$state', '$country', '$pincode', '$lat', '$lng', '$FileNameNew')";
      

        }
       else if( empty($_FILES['avatar']['name']) && !empty($_FILES['certificate']['name'])){
        $sql = "INSERT INTO profile  (user_id, full_name, number, bio, gender, places, city, state, country, pincode, lat, lng, certificate)
        VALUES ('$id', '$full_name', '$number', '$bio', '$gender', '$places', '$city', '$state', '$country', '$pincode', '$lat', '$lng', '$certifyNameNew')";
      
        }
        else{
            $sql = "INSERT INTO profile  (user_id, full_name, number, bio, gender, places, city, state, country, pincode, lat, lng)
            VALUES ('$id', '$full_name', '$number', '$bio', '$gender', '$places', '$city', '$state', '$country', '$pincode', '$lat', '$lng')";
          

        }


        
        
       }
       else{


        if( !empty($_FILES['avatar']['name']) && !empty($_FILES['certificate']['avatar'])){
        
            $sql = "UPDATE profile SET  full_name = '$full_name', number = '$number', bio = '$bio', gender = '$gender', places = '$places', city= '$city', state = '$state', country = '$country', pincode = '$pincode', lat = '$lat', lng = '$lng', profile_pic = '$FileNameNew', certificate= '$certifyNameNew' WHERE user_id = $id";
          
           }    
           else if( !empty($_FILES['avatar']['name']) && empty($_FILES['certificate']['name'])){
    
            $sql = "UPDATE profile SET  full_name = '$full_name', number = '$number', bio = '$bio', gender = '$gender', places = '$places', city= '$city', state = '$state', country = '$country', pincode = '$pincode', lat = '$lat', lng = '$lng', profile_pic = '$FileNameNew' WHERE user_id = $id";    
            }
           else if( empty($_FILES['avatar']['name']) && !empty($_FILES['certificate']['name'])){
            $sql = "UPDATE profile SET  full_name = '$full_name', number = '$number', bio = '$bio', gender = '$gender', places = '$places', city= '$city', state = '$state', country = '$country', pincode = '$pincode', lat = '$lat', lng = '$lng',  certificate = '$certifyNameNew' WHERE user_id = $id";            
            }
            else{
                $sql = "UPDATE profile SET  full_name = '$full_name', number = '$number', bio = '$bio', gender = '$gender', places = '$places', city= '$city', state = '$state', country = '$country', pincode = '$pincode', lat = '$lat', lng = '$lng' WHERE user_id = $id";                  
            }

          
            
           }


           if ($conn->query($sql) === TRUE) {
            $_SESSION['STATUS']['editstatus'] = 'Profile Updated Successfully';
           header("Location: ../?profile=edit");
           exit();
 
         } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
           $_SESSION['ERRORS']['sqlerror'] = 'There is an error please retry!';
           header("Location: ../?profile=edit");
           exit();
           
         }

       }

     


    }

else {

    header("Location: ../");
    exit();
}
