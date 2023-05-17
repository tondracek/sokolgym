<?php
require_once "Session.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$filename = "sessions.json";
$sessions = Session::load_sessions_array($filename);

for ($i = 0; $i < count($sessions); $i++) {
    if ($sessions[$i] < date("Y-m-d")) {
        unset($sessions[$i]);
    }
}

file_put_contents($filename, json_encode($sessions));
