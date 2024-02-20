<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_POST['add-doctor'])) {

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
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        if(is_array($_POST["specialist"])) {
            $specialist = implode(",", $_POST["specialist"]);
        }
        else
        {
            $specialist = $_POST["specialist"];
        }

    if(isset($_POST['gender']))
    {
        $gender =  $_POST['gender'];
    }
    else{
        $gender = null;
    }    
    if(isset($_POST['doc_id'])){
        $docid = $_POST['doc_id'];
    }
    else{
        $docid = 0;
    }
    if (empty($full_name) || empty($number) ) {
        $_SESSION['ERRORS']['editstatus'] = 'required fields cannot be empty, try again';
    
        header("Location: ../add");
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
                        header("Location: ../add");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../add");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../add");
                exit();
            }
        }
        else{
            $FileNameNew =  null;
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
                        header("Location: ../add");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../add");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../add");
                exit();
            }
        }
        else{
            $certifyNameNew = null;
        }

     
        $sql = "INSERT INTO doctors  (parent, doc_name, doc_number, doc_profile,  doc_document, doc_gender, doc_bio, specialist)
        VALUES ('$id', '$full_name', '$number','$FileNameNew',   '$certifyNameNew' , '$gender', '$bio', '$specialist')";
       
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
