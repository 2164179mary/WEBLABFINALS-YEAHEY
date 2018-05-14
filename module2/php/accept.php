<?php
/*require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);*/
if (isset($_POST['policyAccept']) &&
    isset($_POST['accountAccept']) &&
    isset ($_POST['usernameAccept']) &&
    isset ($_POST['accept']))

{
    $policy = get_post($conn, 'policyAccept');
    $account = get_post($conn, 'accountAccept');
    $username = get_post($conn, 'usernameAccept');
    $accept = get_post($conn, 'accept');

    switch ($account){
        case 'customer':
                $query1 = " UPDATE $account SET status = 'accepted' WHERE customerID = '$username';";
                $result1 = $conn->query($query1);
                if (!$result1) die($conn->error);


            break;


        case 'sp':
                $query1 = " UPDATE $account SET status = 'accepted' WHERE spID = '$username';";

                $result1 = $conn->query($query1);
                if (!$result1) die($conn->error);



            break;

        default:
            echo "Error";
            break;

    }

    header('Refresh: 0; URL=FetchDB.php');

}


/*function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}*/

/*echo <<< _END
<!DOCTYPE html>
<body>
<a href="FetchDB.php"> Go back to User</a>

</body>
</html>
_END;*/
