
<?php

//connect database

$serverName = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($serverName, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT serviceName, spID, gender FROM service;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Service Name: " . $row["serviceName"] . " spID : " . $row["spID"] . " Gender: " . $row["gender"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();


