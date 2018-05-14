
<?php
session_start();
//connect database

require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT serviceName,image, spID, gender FROM service;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $increment = 0;
    while($row = $result->fetch_assoc()) {
        echo "<div style=\"border: 1px solid black;\">";
        $increment = $increment + 1 ;
        echo "<br>";
        echo "<br>";
        echo "<img src=\"data:image/jpeg;base64," .  base64_encode( $row['image'] ) . "\">";
        echo "Service Name: " . $row["serviceName"] . "<br>";
        echo " spID : " . $row["spID"] . "<br>";
        echo " Gender: " . $row["gender"] . "<br>";
        $_SESSION['spID'] = $row["spID"];
        echo "<a href=\"TransactionM.php?content=".$_SESSION['spID']."\">View Transaction</a>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();

