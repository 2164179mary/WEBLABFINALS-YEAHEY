<?php

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
extract ($_GET);
/*echo $_GET['sp'];
echo $_GET['amount'];
echo $_GET['profit'];*/
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_GET['sp']) &&
    isset($_GET['amount']) &&
    isset($_GET['profit'])){
    $sp = $_GET['sp'];
    $totalAmount = $_GET['amount'];
    $totalProfit = $_GET['profit'];
    $query = "select rentID, customerID, serviceID, requested, dispatch, returned, noOfDays, customer_service.status Status,
spID, totalAmount, totalAmount/100 * 20 profit, adminStatus
from customer_service inner join service using (serviceID)
inner join payment using (rentID)
where adminStatus = 'no' and spID = '$sp'";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    $rows = $result->num_rows;
    //header('Refresh: 0;');
echo "<h3 id='serviceChosen' class='center fade-in'>Service Provider: $sp</h3>";

echo <<<_END
<div class="col-10 center">
<table class="transaction fade-inn">
 <tr>
 <th>Customer</th>
 <th>Service</th>
 <th>Amount</th>
 <th>Profit</th>
 </tr>
_END;
    for($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $customerID = $row['customerID'];
        $serviceID = $row['serviceID'];
        $amount = $row['totalAmount'];
        $profit = $row['profit'];
        echo <<<_END
    <tr>
        <td>$customerID</td>
        <td>$serviceID</td>
        <td>$amount</td>
        <td>$profit</td>
    </tr>
_END;
}

echo "</table>";
    echo "<p id='totalAmount' class='fade-inn'><b>Total Amount</b>: $totalAmount</p>";
    echo "<p id='totalProfit' class='fade-inn'><b>Total Profit</b>: $totalProfit</p>";
    echo <<<_END
        </div>
</div>
</div>
</body>
<html>
_END;

}
?>
