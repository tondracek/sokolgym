<?php
require_once "../Session.php";
require_once "OnetimeSession.php";

$filename = "sessions.json";
$sessions = OnetimeSession::load_onetime_sessions_array($filename);

for ($i = 0; $i < count($sessions); $i++) {
    if ($sessions[$i] instanceof Session && $sessions[$i]->getDay() < date("Y-m-d")) {
        unset($sessions[$i]);
    }
}

file_put_contents($filename, json_encode($sessions));
