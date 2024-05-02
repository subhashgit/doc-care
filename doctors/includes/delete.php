<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_GET['id'])) {
    require '../../assets/setup/db.inc.php';
   

        $sqlDoc = "DELETE  FROM doctors WHERE parent = '".$_SESSION['id']."' AND id= ".$_GET['id']; 
        $resultDoc = mysqli_query($conn, $sqlDoc);
        
            if($resultDoc){
                $_SESSION['STATUS']['deletestatus'] = 'Deleted Successfully';
                header("Location: ../");

            }
            else{
                $_SESSION['STATUS']['deletestatus'] = 'There is something wrong! Please try again';
                header("Location: ../");

            }
        
    }