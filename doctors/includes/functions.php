<?php
check_verified();
$sqlq = "SELECT * FROM doctors WHERE parent = ".$_SESSION['id']; 
if ($result = mysqli_query($conn, $sqlq))
{
    $resultArray = array();
    $tempArray = array();

    // Loop through each row in the result set
    while($row = $result->fetch_object())
    {
        // Add each row into our results array
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }

    // Finally, encode the array to JSON and output the results
  
}
$doctors = $resultArray;

function doctor_profile($docdata){
    print_r($docdata);
}
