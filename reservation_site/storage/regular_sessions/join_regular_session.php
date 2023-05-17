<?php
require_once "RegularSessions.php";
$sessions = RegularSessions::load_regular_sessions_array("regular_sessions.json");

foreach ($sessions as $session) {
    assert($session instanceof RegularSessions);
    if ($session->getID() == $_GET["id"]) {
        if ($session->is_full()) {
            $msg = "Rezervace je již zaplněna";
            die("<script type='text/javascript'>alert('$msg');
                window.location = '../../index.php'</script>");
        } else {
            $session->add_attendant($_GET["name"]);
        }
    }
}

file_put_contents("regular_sessions.json", json_encode($sessions));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../../index.php");
    die();
}
