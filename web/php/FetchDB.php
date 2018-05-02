<?php
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


//fetching data in mysql
$query = 'select username, fname, lname, typeAccount, status  from account join customer on username = customerID where status=\'pending\' union
          select username, fname, lname, typeAccount, status  from account inner join sp on username = spID where status=\'pending\'; ';

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    echo 'Username: ' .$result->fetch_assoc()['username'] . '<br>';
    $result->data_seek($j);
    echo 'Name: ' .$result->fetch_assoc()['fname']['lname'] . '<br>';

}
