<?php
session_start();

if (!isset($_SESSION["admin"])) {
    include "admin.html";

} else {
   /* include "includes/menu.html";*/
}

?>
