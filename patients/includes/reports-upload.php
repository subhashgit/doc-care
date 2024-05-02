<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_POST['upload-reports'])) {

      // foreach($_POST as $key => $value){

       //     $_POST[$key] = _cleaninjections(trim($value));

       // }
    
    if (!verify_csrf_token()){
        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../reports?pt_id=".$_POST['pt_id']);
        exit();
    }
    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';
        $id = $_SESSION['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['name']);
        $pt_id = $_POST['pt_id'];
         date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
         $created_at = date('Y-m-d H:i:s');
        $countfiles = count($_FILES['reports']['name']);
        $totalFileUploaded = 0;
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['reports']['name'][$i];

            $location = "../uploads/reports/".md5(uniqid(rand(),true)).$i.$filename;
            $extension = pathinfo($location,PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            ## File upload allowed extensions
            $valid_extensions = array("jpg","jpeg","png","pdf","docx");

            $response = 0;
            ## Check file extension
            if(in_array(strtolower($extension), $valid_extensions)) {
                
             
                 ## Upload file
                 if(move_uploaded_file($_FILES['reports']['tmp_name'][$i],$location)){
   
                                $sql = "INSERT INTO reports  (parent, user_id, name, file, created_at)
                                VALUES ('$id', '$pt_id', '$full_name', '$filename', '$created_at')";
                                mysqli_query($conn, $sql);
                              $totalFileUploaded++;
                 }
            }
   
       }
       header("Location: ../reports?pt_id=".$_POST['pt_id']);
     exit();
       
        


       }

     




    

else {

    header("Location: ../reports?pt_id=".$pt_id);
    exit();
}
