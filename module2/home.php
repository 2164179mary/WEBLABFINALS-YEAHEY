<?php
session_start();

if (!isset($_SESSION["username"])) {
    include "loginForm.php";

} else {
    include "home.html";
}

?>
