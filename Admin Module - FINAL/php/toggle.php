<?php
extract($_POST);
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_POST['type']) &&
    isset($_POST['reported']) &&
    isset($_POST['status'])){
    $type = get_post($conn, 'type');
    $reported = get_post($conn, 'reported');
    $status = get_post($conn, 'status');

    if($status == 'blocked'){
        $statusChange = "accepted";
    } else if($status == 'accepted'){
        $statusChange = "blocked";
    }
    if($type == 'customer'){
        $query = "update $type
set status = '$statusChange' where customerID = '$reported'";
        $result = $conn->query($query);
    } else if($type == 'sp'){
        $query = "update $type
set status = '$statusChange' where spID = '$reported'";
        $result = $conn->query($query);
    }

    if (!$result){
        echo "ERROR";
    }else {
        header('Refresh: 0; URL=userManagement.php');
    }
   //echo "I AM IN";
}


function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

?>


