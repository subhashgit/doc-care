<?php
check_logged_in();
$sql = "SELECT * FROM profile WHERE user_id = ".$_SESSION['id']; 
if ($result = mysqli_query($conn, $sql))
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
$user = $resultArray[0];


$sqlspc = "SELECT * FROM specialties"; 
if ($resultspc = mysqli_query($conn, $sqlspc))
{
    $resultArraySpc = array();
    $tempArraySpc = array();

    // Loop through each row in the result set
    while($row = $resultspc->fetch_object())
    {
        // Add each row into our results array
        $tempArraySpc = $row;
        array_push($resultArraySpc, $tempArraySpc);
    }

    // Finally, encode the array to JSON and output the results
}
