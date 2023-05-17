<?php
$json = file_get_contents("../storage/regular_sessions.json");
$sessions = json_decode($json, true);

for ($i = 0; $i < count($sessions); $i++) {
    if ($sessions[$i]["id"] == $_GET["id"]) {
        if (count($sessions[$i]["attendants"]) >= $sessions[$i]["max_capacity"]) {
            $msg = "Rezervace je již zaplněna";
            die("<script type='text/javascript'>alert('$msg');
            window.location = '../../index.php'</script>");
        } else {
            $sessions[$i]["attendants"][] = $_GET["name"];
        }
    }
}

file_put_contents("../storage/regular_sessions.json", json_encode($sessions));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../index.php");
    die();
}
