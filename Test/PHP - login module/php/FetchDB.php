<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['policy']) &&
    isset($_POST['account']) &&
    isset ($_POST['username']) &&
    isset ($_POST['accept']))

{
    $policy = get_post($conn, 'policy');
    $account = get_post($conn, 'account');
    $username = get_post($conn, 'username');
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

    }

    echo "The username: " . $username . " has been accepted";
}




//fetching data in mysql
$query = 'select username, fname, lname, typeAccount, status  from account join customer on username = customerID where status=\'pending\' union
          select username, fname, lname, typeAccount, status  from account inner join sp on username = spID where status=\'pending\'; ';
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
   $row = $result->fetch_array(MYSQLI_BOTH);

    echo <<<_END
    <!Doctype html>
        <body>
           <p> Username: $row[0]</p>
           <p> Name: $row[1] $row[2]</p>
           <p>Account: $row[3]</p>
    
    
        
           <form action = "FetchDB.php" method="post">
           
               <input type="hidden" name="deny" value="yes">
               <input type="hidden" name = "username" value="$row[0]">
               <input type="hidden" name = "account" value="$row[3]">
               <input type="submit" name = "policy" value="Deny">
               
               <input type="hidden" name="accept" value="yes">
               <input type="hidden" name = "username" value="$row[0]">
               <input type="hidden" name = "account" value="$row[3]">
               <input type="submit" name = "policy" value="Accept">
           </form>
        </body>
    </html>

_END;

}



$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
