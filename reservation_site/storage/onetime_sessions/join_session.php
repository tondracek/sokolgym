<?php
//load from json
$json = file_get_contents("../storage/sessions.json");
$sessions = json_decode($json, true);

//find the session
for ($i = 0; $i < count($sessions); $i++) {
    if ($sessions[$i]["day"] == $_GET["day"] && $sessions[$i]["start"] == $_GET["start"] && $sessions[$i]["end"] == $_GET["end"]) {
        if (count($sessions_array[$i]["attendants"]) >= $sessions_array[$i]["max_capacity"]) {
            $msg = "Rezervace je již zaplněna";
            die("<script type='text/javascript'>alert('$msg');
        window.location = '../../index.php'</script>");
        } else {
            array_push($sessions_array[$i]["attendants"], $_GET["name"]);
        }
    }
}

//save back to json
file_put_contents("../storage/sessions.json", json_encode($sessions_array));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../index.php");
    die();
}
