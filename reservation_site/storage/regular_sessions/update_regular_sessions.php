<?php

$json = file_get_contents("regular_sessions.json");
$sessions = json_decode($json, true);

for ($i = 0; $i < count($sessions); $i++) {
    $sessions[$i]["attendants"] = array_unique($sessions[$i]["attendants"]);

    $today = date("y-m-d");
    if ($today > $sessions[$i]["last_updated"]) {
        $sessions[$i]["attendants"] = [];
        $sessions[$i]["last_updated"] = $today;
    }
}

file_put_contents("regular_sessions.json", json_encode($sessions));
