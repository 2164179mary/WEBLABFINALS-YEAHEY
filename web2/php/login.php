<?php
session_start();

//connect database
require_once 'connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//Get the input value from the form
$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);

$query = "SELECT username, password, typeAccount from account where username = BINARY '$username' and password = BINARY '$password'";
$result = $conn->query($query);

//if count is equal 1, register the user to logged in
$count = mysqli_num_rows($result);

for($i = 0; $i < $count; $i++){
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $_type = $row['typeAccount'];
}
if ($count == 1){

    if($_type == "admin"){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: ../home.php');
    } else {
        echo <<<_END
        <div class="invalid-user">
            <p>You are not allowed to login to the admin module</p>
            <p>redirecting in 3 seconds</p>
        </div>
_END;
        header('Refresh: 3; URL=../login.html');
    }
}
else {
    echo <<<_END
    <div class="invalid-user">
        <p>Invalid username or password</p>
        <p>redirecting in 3 seconds</p>
    </div>
_END;
    header('Refresh: 3; URL=../login.html');
}

?>
