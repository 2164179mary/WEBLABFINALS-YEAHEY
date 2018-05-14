<?php
/**
 * Created by PhpStorm.
 * User: shika
 * Date: 5/2/2018
 * Time: 10:50 PM
 */
session_start();
session_destroy();
header("location:../index.html");
?>