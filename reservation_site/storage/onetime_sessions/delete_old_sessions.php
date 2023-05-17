<?php
update_sessions();
update_regular_sessions();
// die();

function update_sessions()
{
    $sessions_loaded = file_get_contents("../storage/sessions.json");
    $json_dict = json_decode($sessions_loaded, true);

    $sessions_array = array();

    foreach ($json_dict as $session) {
        array_push($sessions_array, $session);
    }

    for ($i = 0; $i < count($sessions_array); $i++) {
        if ($sessions_array[$i]["day"] < date("Y-m-d")) {
            unset($sessions_array[$i]);
        }
    }

    file_put_contents("../storage/sessions.json", json_encode($sessions_array));
}

function update_regular_sessions()
{
    $json = file_get_contents("../storage/regular_sessions.json");
    $sessions = json_decode($json, true);

    for ($i = 0; $i < count($sessions); $i++) {
        $sessions[$i]["attendants"] = array_unique($sessions[$i]["attendants"]);

        $today = date("y-m-d");
        if ($today > $sessions[$i]["last_updated"]) {
            $sessions[$i]["attendants"] = [];
            $sessions[$i]["last_updated"] = $today;
        }
    }

    file_put_contents("../storage/regular_sessions.json", json_encode($sessions));
}
