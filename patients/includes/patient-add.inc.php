<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_POST['add-patient'])) {

      // foreach($_POST as $key => $value){

       //     $_POST[$key] = _cleaninjections(trim($value));

       // }
    
    if (!verify_csrf_token()){
        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../add");
        exit();
    }
    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';
        $id = $_SESSION['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $created_at = date('Y-m-d H:i:s');

    if(isset($_POST['gender']))
    {
        $gender =  $_POST['gender'];
    }
    else{
        $gender = null;
    }    

    if (empty($full_name) || empty($number) ) {
        $_SESSION['ERRORS']['editstatus'] = 'required fields cannot be empty, try again';
    
        header("Location: ../add");
        exit();
    }
    else {



     
        $sql = "INSERT INTO patient  (parent, pt_name, pt_number, pt_gender, created_at)
        VALUES ('$id', '$full_name', '$number', '$gender', '$created_at')";
       
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

    header("Location: ../add");
    exit();
}
