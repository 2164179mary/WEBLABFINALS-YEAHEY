<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['firstName']) &&
    isset($_POST['lastName']) &&
    isset($_POST['contactNumber']) &&
    isset($_POST['email']) &&
    isset($_POST['type']) &&
    isset($_POST['address'])) {
    $_type = get_post($conn, 'type');
    $_username = get_post($conn, 'username');
    $_password = get_post($conn, 'password');
    $_firstName = get_post($conn, 'firstName');
    $_lastName = get_post($conn, 'lastName');
    $_contactNum = get_post($conn, 'contactNumber');
    $_email = get_post($conn, 'email');
    $_address = get_post($conn, 'address');
    $_query = "INSERT INTO account (username, password, fName, lName, contactNum, email, typeAccount, address)
VALUES ('$_username', '$_password', '$_firstName', '$_lastName', '$_contactNum', '$_email', '$_type', '$_address');";
    $_result = $conn->query($_query);
    //setType($_type, $_username);
    switch ($_type) {
        case 'customer':
            $_query2 = "INSERT INTO $_type (customerID, status) VALUES('$_username', 'pending')";
            $_result2 = $conn->query($_query2);
            break;
        case 'sp':
            $_query2 = "INSERT INTO $_type (spID, status) VALUES('$_username', 'pending')";
            $_result2 = $conn->query($_query2);
            break;
        case 'admin':
            $_query2 = "INSERT INTO $_type (adminID) VALUES('$_username')";
            $_result2 = $conn->query($_query2);
            break;
        default:
            echo "ERROR";
    }

    /*if (!$_result) echo "INSERT failed: $_query<br>" .
        $conn->error . "<br><br>";
    } */

    echo "Welcome " . $_username . "! Your registration has been submitted.";
}

/*var setType = function(type, username){
    switch (type){
        case 'admin':
    }
}*/


function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

?>