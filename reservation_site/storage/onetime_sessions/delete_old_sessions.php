<?php
require_once "../Session.php";

$filename = "sessions.json";
$sessions = Session::load_sessions_array($filename);

for ($i = 0; $i < count($sessions); $i++) {
    echo $sessions[$i]->getDay() < date("Y-m-d");
    if ($sessions[$i] instanceof Session && $sessions[$i]->getDay() < date("Y-m-d")) {
        unset($sessions[$i]);
    }
}

file_put_contents($filename, json_encode($sessions));
