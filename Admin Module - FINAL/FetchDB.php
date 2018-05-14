<?php
include "nav.php";
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//fetching data in mysql
$query = 'select username, fname, lname, typeAccount, status  from account join customer on username = customerID where status=\'pending\' union
          select username, fname, lname, typeAccount, status  from account inner join sp on username = spID where status=\'pending\' and not typeAccount = \'admin\'; ';
$result = $conn->query($query);
if (!$result) die($conn->error);


$rows = $result->num_rows;

echo <<< _END
<!DOCTYPE html>
    <body>
        <table class = "tableUser">
            <tr>
                <th> Username </th>    
                <th> Name  </th>
                <th> Account</th>
            </tr>        

_END;


for ($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_BOTH);

    echo <<<_END
                <tr>
                    <td> $row[0]</td>
                    <td> $row[1] $row[2]</td>
                    <td> $row[3] </td>
                    <td>               
                           <form action = "FetchDB.php" method="post">
                               <input type="hidden" name="deny" value="yes">
                               <input type="hidden" name = "usernameDeny" value="$row[0]">
                               <input type="hidden" name = "accountDeny" value="$row[3]">
                               <input type="submit" name = "policyDeny" value="Deny">
                            </form>
                    </td>
                    <td>
                        <form action = "FetchDB.php" method="post">
                            <input type="hidden" name="accept" value="yes">
                            <input type="hidden" name = "usernameAccept" value="$row[0]">
                            <input type="hidden" name = "accountAccept" value="$row[3]">
                            <input type="submit" name = "policyAccept" value="Accept">
                        </form>
                    </td>
                </tr>

_END;
}
echo <<<_END
            </table>
        </body>
    </html>
_END;

if(isset($_POST['usernameAccept']) &&
    isset ($_POST['accountAccept']) &&
    isset ($_POST['policyAccept']) &&
    isset ($_POST['accept'])){
    include 'accept.php';
    header('Refresh: 0; URL=FetchDB.php');
}

if(isset($_POST['usernameDeny']) &&
    isset ($_POST['accountDeny']) &&
    isset ($_POST['policyDeny']) &&
    isset ($_POST['deny'])){
    include 'deny.php';
    header('Refresh: 0; URL=FetchDB.php');
}






$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
