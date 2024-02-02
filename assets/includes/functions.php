<?php
check_logged_in();
/**Users  */
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
if(!empty($resultArray)){
$user = $resultArray[0];
}
else{
    $user = '';
}
/**Doctors */

$sqlDoc = "SELECT * FROM doctors WHERE parent = ".$_SESSION['id']; 
if ($resultDoc = mysqli_query($conn, $sqlDoc))
{
    $resultArrayDoc = array();
    $tempArrayDoc = array();

    // Loop through each row in the result set
    while($rowDoc = $resultDoc->fetch_object())
    {
        // Add each row into our results array
        $tempArrayDoc = $rowDoc;
        array_push($resultArrayDoc, $tempArrayDoc);
    }

    // Finally, encode the array to JSON and output the results
  
}
if(!empty($resultArrayDoc)){
$Doctors = $resultArrayDoc;
}
else{
    $Doctors = '';
}
/** Availability */

$sqlavail = "SELECT * FROM availability WHERE parent = ".$_SESSION['id']; 
if ($resultAvail = mysqli_query($conn, $sqlavail))
{
    $resultArrayAvail = array();
    $tempArrayAvail = array();

    // Loop through each row in the result set
    while($rowAvail = $resultAvail->fetch_object())
    {
        // Add each row into our results array
        $tempArrayAvail = $rowAvail;
        array_push($resultArrayAvail, $tempArrayAvail);
    }

    // Finally, encode the array to JSON and output the results
  
}
if(!empty($resultArrayAvail)){
$Available = $resultArrayAvail[0];
}
else{
    $Available = '';
}
/** Social */

$sqlSocial = "SELECT * FROM social WHERE parent = ".$_SESSION['id']; 
if ($resultSocial = mysqli_query($conn, $sqlSocial))
{
    $resultArraySocial = array();
    $tempArraySocial = array();

    // Loop through each row in the result set
    while($rowSocial = $resultSocial->fetch_object())
    {
        // Add each row into our results array
        $tempArraySocial = $rowSocial;
        array_push($resultArraySocial, $tempArraySocial);
    }

    // Finally, encode the array to JSON and output the results
  
}
if(!empty($resultArraySocial)){
$Social = $resultArraySocial[0];
}
else{
    $Social = '';
}
/**Specilist */

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
