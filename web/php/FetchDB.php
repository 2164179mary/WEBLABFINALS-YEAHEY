<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['policy']) &&
    isset($_POST['account']) &&
    isset ($_POST['username']) &&
    isset ($_POST['accept']) &&
    isset ($_POST['deny']))

{
    $policy = get_post($conn, 'policy');
    $account = get_post($conn, 'account');
    $username = get_post($conn, 'username');
    $accept = get_post($conn, 'accept');
    $deny = get_post($conn, 'deny');

    switch ($account){
        case 'customer':
            if($accept == true){

            $query1 = " UPDATE $account SET status = 'accepted' WHERE customerID = '$username';";
            $result1 = $conn->query($query1);

            }if($deny == true){
                $query2 = "DELETE from $account where customerID = '$username';";
                $result2 = $conn->query($query2);

            }

            break;


        case 'sp':
            if($accept == true){
                $query1 = " UPDATE $account SET status = 'accepted' WHERE spID = '$username';";
                $result1 = $conn->query($query1);
            } if ($deny == true){
                $query2 = "DELETE from $account where spID = '$username';";
                $result2 = $conn->query($query2);

        }

            break;

        default:
            echo "Error";
            break;

    }


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
