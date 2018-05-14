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

    $query = "SELECT username, password, typeAccount from account where username = BINARY '$username' and password = BINARY '$password'";
    $result = $conn->query($query);

    $count = mysqli_num_rows($result);

    for($i = 0; $i < $count; $i++){
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
            $errorInvalidUser = "<p style='color:#e53935;font-size:12px;text-align:center;margin-top:-1px;font-style: italic;'>You are not allowed to login to the admin module</p>";
            //header('Refresh: 3; URL=../loginForm.php');
        }
    }
    else {
        $errorInvalidUser = "<p style='color:#e53935; font-size:12px;text-align:center;margin-top:-1px;font-style: italic;'>Invalid username or password</p>";
        //header('Refresh: 3; URL=../loginForm.phpd');
    }

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
                <div class="col-6 fade-in">
                    <img class="photo" alt="logo" src="./images/samplePhoto3.jpg">
                </div>
                <div class="col-6 fade-inn">
                    <div id="login">
                        <img class="logo-login" alt="logo" src="./images/sampleLogo.png">
                        <h4 class="center" id="account">ADMIN</h4>
                        <form method="post" action="./loginForm.php">
                            <input id="user" type="text" name="username" placeholder="username">
                            <input id="loginpassword" type="password" name="password" placeholder="password">
                            <?php
                if(isset($errorInvalidUser)){
                    echo $errorInvalidUser;
                }
                ?>
                                <button id="login-button" type="submit" name="log_in_user"> Login </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
