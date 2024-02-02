<?php
session_start();

require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_logged_in();


if (isset($_POST['update-availability'])) {

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
        header("Location: ../?profile=availability");
        exit();
    }
   

    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';
    

        $id = $_SESSION['id'];
        $datasql = "SELECT id FROM availability WHERE 	parent = ".$_SESSION['id'];
        $result = $conn->query($datasql);
             if(mysqli_num_rows($result) == 0){

                            if(isset($_POST['24x7'])){
                                $twentyxs = $_POST['24x7'];
                                $sql = "INSERT INTO availability  (parent, twentyxs) VALUES ('$id', '$twentyxs')";
                            }
                            else if(isset($_POST['alldaysame']))
                            {   
                                $alldaysame = $_POST['alldaysame'];
                                $mon_from = $_POST['mon_from'];
                                $mon_to = $_POST['mon_to'];
                                if(empty($mon_from) || empty($mon_to)){
                                    $_SESSION['ERRORS']['availerror'] = 'required fields cannot be empty, try again';
                                    header("Location: ../?profile=availability");
                                    exit();
                                }
                                $sql = "INSERT INTO availability  (parent, alldaysame, mon_from, mon_to) VALUES ('$id', '$full_name','$mon_from','$mon_to')";
                               }
                        else{
                            $mon_from = $_POST['mon_from'];
                            $mon_to = $_POST['mon_to'];
                            $tue_from = $_POST['mon_from'];
                            $tue_to = $_POST['mon_to'];
                            $wed_from = $_POST['mon_from'];
                            $wed_to = $_POST['mon_to'];
                            $thu_from = $_POST['mon_from'];
                            $thu_to = $_POST['mon_to'];
                            $fri_from = $_POST['mon_from'];
                            $fri_to = $_POST['mon_to'];
                            $sat_from = $_POST['mon_from'];
                            $sat_to = $_POST['mon_to'];
                            $sun_from = $_POST['mon_from'];
                            $sun_to = $_POST['mon_to'];
                            $sql = "INSERT INTO availability  (parent, mon_from, mon_to,tue_from,tue_to,wed_from,wed_to,thus_from,thus_to,fri_from,fri_to,sat_from,sat_to,sun_from,sun_to) VALUES ('$id',  '$mon_from', '$mon_to','$tue_from','$tue_to','$wed_from','$wed_to','$thu_from','$thu_to','$fri_from','$fri_to','$sat_from','$sat_to','$sun_from','$sun_to')";
                        }
                    }
/**update */
                else{           
                    if(isset($_POST['24x7'])){
                        $twentyxs = $_POST['24x7'];

                        $sql = "UPDATE availability SET twentyxs = '$twentyxs', alldaysame = 0 WHERE parent = $id";
                    }
                    else if(isset($_POST['alldaysame']))
                    {   
                        $alldaysame = $_POST['alldaysame'];
                        $mon_from = $_POST['mon_from'];
                        $mon_to = $_POST['mon_to'];
                        if(empty($mon_from) || empty($mon_to)){
                            $_SESSION['ERRORS']['availerror'] = 'required fields cannot be empty, try again';
                            header("Location: ../?profile=availability");
                            exit();
                        }
                        $sql = "UPDATE availability SET alldaysame='$alldaysame',twentyxs=0, mon_from='$mon_from', mon_to='$mon_to' WHERE parent = $id";
                       }
                else{
                    $mon_from = $_POST['mon_from'];
                    $mon_to = $_POST['mon_to'];
                    $tue_from = $_POST['tue_from'];
                    $tue_to = $_POST['tue_to'];
                    $wed_from = $_POST['wed_from'];
                    $wed_to = $_POST['wed_to'];
                    $thu_from = $_POST['thu_from'];
                    $thu_to = $_POST['thu_to'];
                    $fri_from = $_POST['fri_from'];
                    $fri_to = $_POST['fri_to'];
                    $sat_from = $_POST['sat_from'];
                    $sat_to = $_POST['sat_to'];
                    $sun_from = $_POST['sun_from'];
                    $sun_to = $_POST['sun_to'];
                    $sql = "UPDATE availability SET alldaysame=0, mon_from='$mon_from', mon_to='$mon_to',tue_from='$tue_from',tue_to='$tue_to',wed_from='$wed_from',wed_to='$wed_to',thus_from='$thu_from',thus_to='$thu_to',fri_from='$fri_from',fri_to='$fri_to',sat_from='$sat_from',sat_to='$sat_to',sun_from='$sun_from',sun_to='$sun_to' WHERE parent = $id";

                }



                }

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['STATUS']['editavailstatus'] = 'Profile Updated Successfully';
                   header("Location: ../?profile=availability");
                   exit();
         
                 } else {
                   echo "Error: " . $sql . "<br>" . $conn->error;
                   $_SESSION['ERRORS']['sqlerror'] = 'There is an error please retry!';
                   header("Location: ../?profile=availability");
                   exit();
                   
                 }
}

    else {

        header("Location: ../");
        exit();
    
}