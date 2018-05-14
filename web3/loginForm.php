<?php
require_once 'php/connectDB.php';
$conn = new mysqli($lh, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_POST['username']) &&
    isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn,$password);

    $query = "Select username, password, typeAccount from account where username = BINARY '$username'";
    $result = $conn->query($query);
    $count = mysqli_num_rows($result);


    if ($count == 0){
        $errorInvalidUser = "<p id='invalidLogIn'>Invalid username or password</p>";
    } else{


        for($i = 0; $i < $count; $i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $_password = $row['password'];
        }

        for($i = 0; $i < $count; $i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $_type = $row['typeAccount'];
        }


        if(password_verify($password, $_password)){
            if($_type == "customer"){
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header('location: home.php');
            } else {
                $errorInvalidUser = "<p id='invalidLogIn'>You are not allowed to login to the admin module</p>";
                //header('Refresh: 3; URL=../loginForm.php');
            }
        }else {
            $errorInvalidUser = "<p id='invalidLogIn'>Invalid username or password</p>";
        }
    }




   /* for($i = 0; $i < $count; $i++){
        $result->data_seek($i);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $_type = $row['typeAccount'];
    }
    if ($count == 1){

        if($_type == "admin"){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('location: home.php');
        } else {
            $errorInvalidUser = "<p id='invalidLogIn'>You are not allowed to login to the admin module</p>";
            //header('Refresh: 3; URL=../loginForm.php');
        }
    } else {
        $errorInvalidUser = "<p id='invalidLogIn'>Invalid username or password</p>";
        //header('Refresh: 3; URL=../loginForm.phpd');
    }*/

}
//Get the input value from the form

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Arkila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/favicon.ico">
    <link rel="Stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
<div class="container">
    <div class="content">
        <div class="col-6">
            <img class="photo" alt="logo" src="./images/samplePhoto3.jpg">
        </div>
        <div class="col-6">
            <div id="login">
                <img class="logo-login" alt="logo" src="./images/sampleLogo.png">
                <h4 class="center" id="account">ADMIN</h4>
                <form method="post" action="./loginForm.php">
                    <input id="user" type="text" name="username" placeholder="username">
                    <input id="passwordLogin" type="password" name="password" placeholder="password">
                    <button id="login-button" type="submit" name="log_in_user"> Login </button>
                </form>
                <?php
                if(isset($errorInvalidUser)){
                    echo $errorInvalidUser;
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>

