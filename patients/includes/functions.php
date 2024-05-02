<?php
check_verified();
/**Doctors */

$sqlpatients = "SELECT * FROM patient WHERE parent = ".$_SESSION['id']." ORDER BY id DESC"; 
if ($resultpatients = mysqli_query($conn, $sqlpatients))
{
    $resultArraypatients = array();
    $tempArraypatients = array();

    // Loop through each row in the result set
    while($rowspatients = $resultpatients->fetch_object())
    {
        // Add each row into our results array
        $tempArraypatients = $rowspatients;
        array_push($resultArraypatients, $tempArraypatients);
    }

    // Finally, encode the array to JSON and output the results
  
}
if(!empty($resultArraypatients)){
$patients = $resultArraypatients;
}
else{
    $patients = '';
}


function patientreports($reportid){
    require '../assets/setup/db.inc.php';
    $sqlreports = "SELECT * FROM reports WHERE parent = '".$_SESSION['id']."' AND user_id= ".$reportid." ORDER by  id DESC"; 
        if ($resultreport = mysqli_query($conn, $sqlreports))
        {

            $resultArrayreports = array();
            $tempArrayreports = array();

            while($rowspatients = $resultreport->fetch_object())
            {
                $tempArrayreports  = $rowspatients;
                array_push($resultArrayreports, $tempArrayreports);
            }

             return $resultArrayreports;
            
        }
}
