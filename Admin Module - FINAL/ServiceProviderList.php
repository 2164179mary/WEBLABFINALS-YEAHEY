<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_POST['paid']) &&
    isset($_POST['sp'])){
    $sp2 = $_POST['sp'];
    //echo $sp;
    $query2 = "UPDATE payment inner join customer_service using (rentID)
inner join service using (serviceID)
SET adminStatus = 'yes'
where spID = '$sp2'";
    $result2 = $conn->query($query2);
    //if (!$result2) die($conn->error);
    header('Refresh: 0;');
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
                        <a href="FetchDB.php" target="_self"><img src="images/dashboard.png" alt="DASHBOARD"><br><p>Dashboard</p></a>

                    </li>
                    <li>
                        <a href="ServiceProviderList.php" target="_self" class="active"><img src="images/transactions.png" alt="TRANSACTIONS"><br><p>Transaction Monitoring</p></a>
                    </li>
                    <li>
                        <a href="userManagement.php" target="_self"><img src="images/users.png" alt="USER"><br><p>User<br>Management</p></a>
                    </li>
                </ul>
            </div>
        </div>

_END;


$query = "select rentID, customerID, serviceID, requested, dispatch, returned, noOfDays, customer_service.status Status,
spID, sum(totalAmount) totalAmount, sum(totalAmount/100 * 20) profit, adminStatus
from customer_service inner join service using (serviceID)
inner join payment using (rentID)
where adminStatus = 'no'
group by spID;";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

echo <<<_END
<div class="col-10 center">
<h1 class="fade-in">Commission</h1>
<table class="transaction fade-inn">
 <tr>
 <th>Service Provider</th>
 <th>Total Amount</th>
 <th>Profit</th>
 <th>Status</th>
 </tr>
_END;

for($i = 0; $i < $rows; ++$i) {
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $sp = $row['spID'];
    $amount = $row['totalAmount'];
    $profit = $row['profit'];

    echo <<<_END
<tr>
         <td><a href="TransactionMonitoring.php?sp=$sp&amount=$amount&profit=$profit">$sp</a></td>
         <td>$amount</td>
         <td>$profit</td>
         <td>
            <form id="toggleReport" method="post" action="ServiceProviderList.php">
                <input type="hidden" value="yes" name="paid">
                <input type="hidden" value="$sp" name="sp">
                <input type="hidden" value="$amount" name="amount">
                <input type="hidden" value="$profit" name="profit">
                <input type="submit" value="Paid" name="status">
            </form>
        </td>
 </tr>
_END;
}

echo "</table>";
echo <<<_END
</div>
    </div>
</div>
</body>
<html>
_END;
?>
