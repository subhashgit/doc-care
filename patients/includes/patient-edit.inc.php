<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_POST['update-patient'])) {
    require '../../assets/setup/db.inc.php';
    
    $staffid =    $_POST['patient_id'];
    
    if (!verify_csrf_token()){
        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../edit?id=".$staffid);
        exit();
    }

    require '../../assets/includes/datacheck.php';
        $id = $_SESSION['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
     
        

    if(isset($_POST['gender']))
    {
        $gender =  $_POST['gender'];
    }
    else{
        $gender = null;
    }    
 
    if (empty($full_name) || empty($number) ) {
        $_SESSION['ERRORS']['editstatus'] = 'required fields cannot be empty, try again';
    
        header("Location: ../edit?id=".$staffid);
        exit();
    }
    else {
    

       
        $sql = "UPDATE patient SET  pt_name = '$full_name', pt_number = '$number', pt_gender = '$gender' WHERE parent = '".$_SESSION['id']."' AND id= ".$_POST['patient_id'];                  
   
           if ($conn->query($sql) === TRUE) {
            $_SESSION['STATUS']['editstatus'] = 'Profile Updated Successfully';
           header("Location: ../");
           exit();
 
         } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
           $_SESSION['ERRORS']['sqlerror'] = 'There is an error please retry!';
           header("Location: ../");
           exit();
           
         }

       }

     


    }

else {

    header("Location: ../");
    exit();
}
