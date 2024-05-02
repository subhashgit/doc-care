<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();
if (isset($_GET['id'])) {
    require '../../assets/setup/db.inc.php';
   

        $sqlDoc = "DELETE  FROM patient WHERE parent = '".$_SESSION['id']."' AND id= ".$_GET['id']; 
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
    if (isset($_GET['report_id'])) {
        require '../../assets/setup/db.inc.php';
       
    
            $sqlDoc = "DELETE  FROM reports WHERE parent = '".$_SESSION['id']."' AND id= ".$_GET['report_id']; 
            $resultDoc = mysqli_query($conn, $sqlDoc);
            
                if($resultDoc){
                    $_SESSION['STATUS']['deletestatus'] = 'Deleted Successfully';
                    header("Location: ../reports?pt_id=".$_GET['pt_id']);
    
                }
                else{
                    $_SESSION['STATUS']['deletestatus'] = 'There is something wrong! Please try again';
                    header("Location: ../reports?pt_id=".$_GET['pt_id']);
    
                }
            
        }