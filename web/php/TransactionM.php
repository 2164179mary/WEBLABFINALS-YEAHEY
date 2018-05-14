<?php
require_once 'connectDB.php';

$conn = new mysqli($lh, $un, $pw, $db);


session_start();
$var_value = $_SESSION['SPID'];

$query = "select spID, contractBill, Status from sp where (spID = \"$var_value\" );";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br>";
        echo "<br>";
        echo " ServiceProvider : " . $row["spID"] . "<br>";
        echo " Contract Bill : " . $row["contractBill"] . "<br>";
        echo " Status: " . $row["Status"] . "<br>";
    }
} else {
    echo "0 results";
}