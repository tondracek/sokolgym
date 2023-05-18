<?php
require_once "../Session.php";
require_once "OnetimeSession.php";

$sessions = OnetimeSession::load_onetime_sessions_array("sessions.json");

foreach ($sessions as $session) {
    assert($session instanceof OnetimeSession);
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

file_put_contents("sessions.json", json_encode($sessions));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../../index.php");
    die();
}
