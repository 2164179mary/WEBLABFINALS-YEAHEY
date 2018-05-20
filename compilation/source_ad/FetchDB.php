<?php
//include "nav.php";
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);



//fetching data in mysql
$query = 'select username, concat(lname,", ", fname), typeAccount, status  from account join customer on username = customerID where status=\'pending\' union
          select username, concat(lname,", ", fname), typeAccount, status  from account inner join sp on username = spID where status=\'pending\' and not typeAccount = \'admin\'; ';
$result = $conn->query($query);
if (!$result) die($conn->error);


$rows = $result->num_rows;
if(isset($_POST['usernameAccept']) &&
    isset ($_POST['accountAccept']) &&
    isset ($_POST['policyAccept']) &&
    isset ($_POST['accept'])){
    include 'accept.php';
    //header("Location: accept.php");
    header('Refresh: 0; URL=FetchDB.php');
}else if(isset($_POST['usernameDeny']) &&
    isset ($_POST['accountDeny']) &&
    isset ($_POST['policyDeny']) &&
    isset ($_POST['deny'])){
    include 'deny.php';
    //header("Location: FetchDB.php");
    header('Refresh: 0; URL=FetchDB.php');
}

echo <<<_END
<!DOCTYPE html>
<body lang="en">

<head>
    <title>Arkila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link rel="Stylesheet" type="text/css" href="css/styles.css">
</head>
<div class="container">
    <div class="content">
        <div class="col-2">
            <div id='cssmenu'>
                <ul>
                    <li>
                        <img src="images/Arkila-Logo-1.png" alt="logo">
                        <p>Hi, ADMIN</p>
                        <form action="logout.php">
                            <div>
                                <button class="dashboard" type="submit" name="logout_user"> Logout </button>
                            </div>
                        </form>
                    </li><br><br>
                    <li>
                        <a href="FetchDB.php" target="_self" class="active"><img src="images/dashboard.png" alt="DASHBOARD"><br><p>Dashboard</p></a>

                    </li>
                    <li>
                        <a href="ServiceProviderList.php" target="_self"><img src="images/transactions.png" alt="TRANSACTIONS"><br><p>Transaction Monitoring</p></a>
                    </li>
                    <li>
                        <a href="userManagement.php" target="_self"><img src="images/users.png" alt="USER"><br><p>User<br>Management</p></a>
                    </li>
                </ul>
            </div>
        </div>

_END;


echo <<< _END
    <div class="col-10 center">
        <h1 class="fade-in">List of Pending Accounts</h1>
        <table class = "tableUser fade-inn">
            <tr>
                <th> Username </th>    
                <th> Name  </th>
                <th> Account</th>
                <th colspan="2"> Deny/Accept</th>
            </tr>        

_END;


for ($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_BOTH);

    echo <<<_END
                <tr>
                    <td> $row[0]</td>
                    <td> $row[1]</td>
                    <td> $row[2] </td>
                    <td>               
                           <form action = "FetchDB.php" method="post">
                               <input type="hidden" name="deny" value="yes">
                               <input type="hidden" name = "usernameDeny" value="$row[0]">
                               <input type="hidden" name = "accountDeny" value="$row[2]">
                               <input type="submit" name = "policyDeny" value="Deny">
                            </form>
                    </td>
                    <td>
                        <form action = "FetchDB.php" method="post">
                            <input type="hidden" name="accept" value="yes">
                            <input type="hidden" name = "usernameAccept" value="$row[0]">
                            <input type="hidden" name = "accountAccept" value="$row[2]">
                            <input type="submit" name = "policyAccept" value="Accept">
                        </form>
                    </td>
                </tr>

_END;
}

$result->close();
$conn->close();

echo <<<_END
            </table>
            </div>
            </div>
            </div>
        </body>
    </html>
_END;

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
