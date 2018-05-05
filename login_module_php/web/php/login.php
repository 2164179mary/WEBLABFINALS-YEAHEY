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

$query = "SELECT username, password from account where username = '$username' and password = '$password'";
$result = $conn->query($query);

//if count is equal 1, register the user to logged in
$count = mysqli_num_rows($result);
if ($count == 1){
    $_SESSION['username'] = 'username';
    $_SESSION['password'] = 'password';
  //  echo "You are now logged in";
    header("location:rental_home.php");
}
else {
    echo "Wrong Username or Password";
}
    
?>
