<?php
session_start();
require_once 'connectDB.php';

$conn = new mysqli($lh, $un, $pw, $db);

$var_value = isset($_GET['content']) ? $_GET['content'] : '';

$query = "select paymentID, totalAmount, billStatus, customerID from payment where (serviceID = \"$var_value\" );";
$result = $conn->query($query);

$query2 = "SELECT sum(totalAmount) as ta FROM payment WHERE (serviceID = \"$var_value\" );";
$result2 = $conn->query($query2);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br>";
        echo "<br>";
        echo " PaymentID : " . $row["paymentID"] . "<br>";
        echo " Total Amount : " . $row["totalAmount"] . "<br>";
        echo " Bill Status : " . $row["billStatus"] . "<br>";
        echo " Customer ID : " . $row["customerID"] . "<br>";
    }
} else {
    echo "0 results";
}

if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo "<br>";
        echo "OverAll Payment Total: " . $row["ta"];
    }
} else {
    echo "There are no Contract Happens";
}