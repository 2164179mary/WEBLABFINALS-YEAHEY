<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_POST['policy'])){
    $_policy = get_post($conn, 'policy');


    switch ($_policy){
        case 'Accept Request':
            $_query ="UPDATE $_policy SET status = 'accepted' WHERE $_policy;";
            $_result = $conn->query($_query);
            if (!$_result) die($conn->error);
            break;

        /*case 'Deny Request':
            $query = "DELETE $_policy"*/

        default:
            echo "ERROR";

    }

    echo "YEY";

}


function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}


