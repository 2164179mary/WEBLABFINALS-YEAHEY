<?php
session_start();
require_once 'connectDB.php';

$conn = new mysqli($lh, $un, $pw, $db);

$var_value = isset($_GET['content']) ? $_GET['content'] : '';

$query = "select spID, contractBill, Status from sp where (spID = \"$var_value\" );";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style=\"border: 1px solid black;\">";
        echo "<br>";
        echo "<br>";
        echo " ServiceProvider : " . $row["spID"] . "<br>";
        echo " Contract Bill : " . $row["contractBill"] . "<br>";
        echo " Status: " . $row["Status"] . "<br>";
        echo "</div>";
    }
} else {
    echo "0 results";
}