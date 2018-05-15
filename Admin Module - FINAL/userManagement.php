<?php
//include 'nav.php';
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT * FROM report order by date DESC";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

//echo "<table class='userManagement'>";
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
                        <a href="ServiceProviderList.php" target="_self"><img src="images/transactions.png" alt="TRANSACTIONS"><br><p>Transaction Monitoring</p></a>
                    </li>
                    <li>
                        <a href="userManagement.php" target="_self" class="active"><img src="images/users.png" alt="USER"><br><p>User<br>Management</p></a>
                    </li>
                </ul>
            </div>
        </div>

_END;

echo <<<_END
<div class="col-10 center">
<h1 class="fade-in">User Feedback</h1>
<table class="feedback fade-inn">
 <tr>
 <th>Reporter</th>
 <th>Reported</th>
 <th>Description</th>
 <th>Date</th>
 <th>Status</th>
 </tr>
_END;

for($i = 0; $i < $rows; ++$i)
{
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
        $types = 'customer';
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
        $types = 'sp';
    }
    if($status == 'accepted'){
        $statusChange = 'blocked';
    } else if($status == 'blocked'){
        $statusChange = 'accepted';
    }
    echo <<<_END


     <tr>
         <td>$reporter</td>
         <td>$reported</td>
         <td>$description</td>
         <td>$date</td>
         <td>
            <form id="toggleReport" method="post" action="userManagement.php">
                <input type="hidden" value="$types" name="type">
                <input type="hidden" value="$reported" name="reported">
                <input type="submit" value="$status" name="status">
            </form>
        </td>
     </tr>

_END;
}// end of for loop
echo "</table>";
echo <<<_END
    </div>
</div>
 </div>
</body>
<html>
_END;


if(isset($_POST['type']) &&
    isset($_POST['reported']) &&
    isset($_POST['status'])){
$type = get_post($conn, 'type');
$reported = get_post($conn, 'reported');
$status = get_post($conn, 'status');

if($status == 'blocked'){
    $statusChange = "accepted";
} else if($status == 'accepted'){
    $statusChange = "blocked";
}
if($type == 'customer'){
    $query2 = "update $type
set status = '$statusChange' where customerID = '$reported'";
    $result2 = $conn->query($query2);
} else if($type == 'sp'){
    $query2 = "update $type
set status = '$statusChange' where spID = '$reported'";
    $result2 = $conn->query($query2);
}

if (!$result2){
    echo "ERROR";
}else {
    header('Refresh: 0; URL=userManagement.php');
}
//echo "I AM IN";
}


function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>
    <script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="script/script2.js"></script>
    <!--<script>
    $(document).ready(function(){
        $("form#toggleReport").submit(function(){
            location.reload();
        });
    });
</script>-->
