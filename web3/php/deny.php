<?php
/*require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);*/
if (isset($_POST['policyDeny']) &&
    isset($_POST['accountDeny']) &&
    isset ($_POST['usernameDeny']) &&
    isset ($_POST['deny']))

{
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
//header('Refresh: 0; URL=FetchDB.php');

}


/*function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

echo <<< _END
<!DOCTYPE html>
<body>
<a href="FetchDB.php"> Go back to User</a>

</body>
</html>
_END;*/
