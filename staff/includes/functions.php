<?php
check_verified();
/**Doctors */

$sqlstaff = "SELECT * FROM staff WHERE parent = ".$_SESSION['id']." ORDER BY id DESC"; 
if ($resultstaff = mysqli_query($conn, $sqlstaff))
{
    $resultArraystaff = array();
    $tempArraystaff = array();

    // Loop through each row in the result set
    while($rowstaff = $resultstaff->fetch_object())
    {
        // Add each row into our results array
        $tempArraystaff = $rowstaff;
        array_push($resultArraystaff, $tempArraystaff);
    }

    // Finally, encode the array to JSON and output the results
  
}
if(!empty($resultArraystaff)){
$staff = $resultArraystaff;
}
else{
    $staff = '';
}

