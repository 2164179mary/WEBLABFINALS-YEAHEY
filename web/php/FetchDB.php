<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

/*if (isset($_POST['accepted']) && isset($_POST['status'])){
    $status = get_post($conn, 'status');
    $query = "UPDATE ";*/



//fetching data in mysql
$query = 'select username, fname, lname, typeAccount, status  from account join customer on username = customerID where status=\'pending\' union
          select username, fname, lname, typeAccount, status  from account inner join sp on username = spID where status=\'pending\'; ';

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
   $row = $result->fetch_array(MYSQLI_BOTH);

  /*echo 'Username: ' .$row['username']  .'<br>';
    echo 'Name: '     .$row['fname']. " " .$row['lname']. '<br>';
    echo 'Account: '  .$row['typeAccount']. '<br>';
    echo 'Status: '   .$row['status'].'<br> <br>';*/

    echo <<<_END
    <!Doctype html>
    <body>
    <pre>
    Username: $row[0]
    Given Name: $row[1]
    Last Name: $row[2]
    Account: $row[3]
    Status: $row[4]
    </pre>
    
   <form action = "_____.php" method="post">
   <input type = "hidden" name = "deny" value="yes">
   <input type = "hidden" name= "status" value="$row[4]">
   <input type="submit" value="Deny Request">
   
   <input type = "hidden" name = "accepted" value="yes">
   <input type = "hidden" name= "status" value="$row[4]">
   <input type="submit" value="Accept Request">
</form>
</body>
</html>

_END;


}



$result->close();
$conn->close();

//gawin sa table
//update.php
//s$typeee
/*update customer (type)
set status = 'accepted'
where (type)customerID='3';*/