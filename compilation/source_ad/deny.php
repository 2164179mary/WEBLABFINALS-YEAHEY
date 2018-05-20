<?php
/*require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);*/

    $policy = get_post($conn, 'policyDeny');
    $account = get_post($conn, 'accountDeny');
    $username = get_post($conn, 'usernameDeny');
    $deny = get_post($conn, 'deny');

    switch ($account){
        case 'customer':
            $query1 = "DELETE from $account WHERE customerID = '$username';";
            $query2 = "DELETE from account WHERE username = '$username';";
            $result1 = $conn->query($query1);
            if (!$result1) die($conn->error);

            $result2 = $conn->query($query2);
            if (!$result2) die($conn->error);
            break;


        case 'sp':
            $query1 = "DELETE from $account WHERE spID = '$username';";
            $query2 = "DELETE from account WHERE username = '$username';";
            $result1 = $conn->query($query1);
            if (!$result1) die($conn->error);

            $result2 = $conn->query($query2);
            if (!$result2) die($conn->error);

            break;

        default:
            echo "Error";
            break;

    }
