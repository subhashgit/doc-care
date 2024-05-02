<?php
check_verified();
/**Doctors */

$sqlDoc = "SELECT * FROM doctors WHERE parent = ".$_SESSION['id']." ORDER BY id DESC"; 
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

