<?php
session_start();

$_SESSION["day"] = $_POST["day"];
$_SESSION["start"] = $_POST["start"];
$_SESSION["end"] =  $_POST["end"];

$_SESSION["id"] = $_POST["id"];
$_SESSION["regular"] = $_POST["regular"];
?>
