<?php
session_start();

if (!isset($_SESSION["username"])) {
    include "login.html";

} else {
    include "home.html";
}

?>
