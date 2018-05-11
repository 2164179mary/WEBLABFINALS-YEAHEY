<?php
require_once 'toggle.php';
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT * FROM report";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

echo "<table class='userManagement'>";
echo <<<_END
 <tr>
 <td>Reporter</td>
 <td>Reported</td>
 <td>Description</td>
 <td>Date</td>
 <td>Status</td>
 </tr>
_END;

for($i = 0; $i < $rows; ++$i) {
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $customerID = $row['customerID'];
    $spID = $row['spID'];
    $description = $row['description'];
    $date = $row['date'];
    if ($row['reporter'] == 'sp') {
        $query2 = "SELECT * FROM customer where customerID = '$customerID'";
        $result2 = $conn->query($query2);
        if (!$result2) die($conn->error);
        $rows2 = $result2->num_rows;
        $result2->data_seek($i);
        $row2 = $result2->fetch_array(MYSQLI_ASSOC);
        $status = $row2['status'];
        $reporter = $spID;
        $reported = $customerID;
    } else if ($row['reporter'] == 'customer') {
        $query2 = "SELECT * FROM sp where spID = '$spID'";
        $result2 = $conn->query($query2);
        if (!$result2) die($conn->error);
        $rows2 = $result2->num_rows;
        $result2->data_seek($i);
        $row2 = $result2->fetch_array(MYSQLI_ASSOC);
        $status = $row2['status'];
        $reporter = $customerID;
        $reported = $spID;
    }
        echo <<<_END
<form name="toggleReport" method="post" action="toggle('$reported')">
 <tr>
 <td>$reporter</td>
 <td>$reported</td>
 <td>$description</td>
 <td>$date</td>
 <td><input type="submit" name="button" id="button" value="$status"></td>
 </tr>
</form>
_END;
    }
echo "</table>";

?>


