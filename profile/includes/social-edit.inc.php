<?php
session_start();

require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_logged_in();


if (isset($_POST['update-social'])) {

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

        $_SESSION['ERROR']['availerror'] = 'Request could not be validated';
        header("Location: ../?profile=social");
        exit();
    }
   

    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';


        $id = $_SESSION['id'];
        $twitter = $_POST['twitter'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $linkedin = $_POST['linkedin'];

        $datasql = "SELECT id FROM social WHERE parent = ".$_SESSION['id'];
        
        $result = $conn->query($datasql);
             if(mysqli_num_rows($result) == 0){
                          $sql = "INSERT INTO social  (parent, twitter, facebook, instagram, linkedin) VALUES ('$id', '$twitter', '$facebook','$instagram','$linkedin')";
                           
                    }
/**update */
                
                else{
                  
                    $sql = "UPDATE social SET twitter='$twitter', facebook='$facebook', instagram='$instagram',linkedin='$linkdein' WHERE parent = $id";

                }
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['STATUS']['editavailstatus'] = 'Profile Updated Successfully';
                   header("Location: ../?profile=social");
                   exit();
                 } else {
                   echo "Error: " . $sql . "<br>" . $conn->error;
                   $_SESSION['ERRORS']['sqlerror'] = 'There is an error please retry!';
                   header("Location: ../?profile=social");
                   exit();                   
                 }
}

    else {

        header("Location: ../");
        exit();
    
}