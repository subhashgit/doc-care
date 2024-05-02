<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_POST['update-staff'])) {
    require '../../assets/setup/db.inc.php';
    if(isset($_POST['staff_id'])){

        $sqlstaff = "SELECT * FROM staff WHERE parent = '".$_SESSION['id']."' AND id= ".$_POST['staff_id']; 
        $resultstaff = mysqli_query($conn, $sqlstaff);
        
            if(mysqli_num_rows($resultstaff) === 1){
                $staffdetail  = $resultstaff->fetch_object();
                    $staffid = $_POST['staff_id'];
            }
            else{
                header("Location: ../");
            }
        }
    else{
        header("Location: ../");
       
    }
      // foreach($_POST as $key => $value){

       //     $_POST[$key] = _cleaninjections(trim($value));

       // }
    
    if (!verify_csrf_token()){
        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../edit?id=".$staffid);
        exit();
    }

    require '../../assets/includes/datacheck.php';
        $id = $_SESSION['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $role = $_POST["role"];
        

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
                        $fileDestination = '../uploads/profile/' . $FileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                    }
                    else
                    {
                        $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                        header("Location: ../edit?id=".$staffid);
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../edit?id=".$staffid);
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../edit?id=".$staffid);
                exit();
            }
        }
        else{
            $FileNameNew =  $staffdetail->staff_profile;
        }
        /** Certificate */
       



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
                        $certifyDestination = '../uploads/certificate/' . $certifyNameNew;
                        // print_r($certifyDestination);
                         //  die();
                        move_uploaded_file($certifyTmpName, $certifyDestination);

						
                    }
                    else
                    {
                        $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                        header("Location: ../edit?id=".$staffid);
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../edit?id=".$staffid);
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../edit?id=".$staffid);
                exit();
            }
        }
        else{
            $certifyNameNew =  $staffdetail->staff_document;
        }

       
        $sql = "UPDATE staff SET  staff_name = '$full_name', staff_number = '$number', staff_profile = '$FileNameNew', staff_document = '$certifyNameNew', staff_gender = '$gender', staff_bio= '$bio', role = '$role' WHERE parent = '".$_SESSION['id']."' AND id= ".$_POST['staff_id'];                  
   




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
