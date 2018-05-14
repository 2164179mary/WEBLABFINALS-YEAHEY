
<?php

//connect database

require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT serviceName, spID, gender FROM service;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<br>";
        echo "<br>";
        echo $row["image"];
        echo "Service Name: " . $row["serviceName"] . "<br>";
        echo " spID : " . $row["spID"] . "<br>";
        echo " Gender: " . $row["gender"] . "<br>";
        echo "<a href=\"TransactionM.php\">View Transaction<a/>";
        session_start();
        $_SESSION['spID'] = $row["spID"];
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();


