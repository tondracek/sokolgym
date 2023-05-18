<?php
require_once "../Session.php";
require_once "OnetimeSession.php";
require_once "../regular_sessions/RegularSessions.php";

use JetBrains\PhpStorm\NoReturn;

test_inputs();

$sessions = OnetimeSession::load_onetime_sessions_array("sessions.json");

$id = 0;

foreach ($sessions as $session) {
    assert($session instanceof OnetimeSession);
    if ($session->getID() > $id) {
        $id = $session->getID();
    }
}

$new_session = new OnetimeSession(
    $id + 1,
    $_POST["day"],
    $_POST["start"],
    $_POST["end"],
    $_POST["trainer"],
    $_POST["max_capacity"],
    [],
    $_POST["email"]
);

check_overlapping_with_existing($new_session, $sessions);
$regular_sessions = RegularSessions::load_regular_sessions_array("../regular_sessions/regular_sessions.json");
check_overlapping_with_existing($new_session, $regular_sessions);

$new_session->add_attendant($_POST["trainer"]);
for ($i = 0; $i < $_POST["reserved_capacity"]; $i++) {
    $new_session->add_attendant("reserved");
}

$sessions[] = $new_session;

file_put_contents("sessions.json", json_encode($sessions));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../../index.php");
    die();
}

function check_user($your_email, $your_pass): bool
{
    $users = json_decode(file_get_contents("../users.json"), true);

    foreach ($users as $user) {
        if ($user["email"] == $your_email) {
            if (password_verify($your_pass, $user["password"])) {
                return true;
            }
        }
    }
    return false;
}

function check_overlapping_with_existing(OnetimeSession $new_session, array $sessions): void
{
    foreach ($sessions as $session) {
        assert($session instanceof Session);
        if ($session->is_overlapping($new_session)) {
            error_msg("Rezervace se překrývá s jinou rezervací");
        }
    }
}

function test_inputs(): void
{

    if ($_POST["day"] == "") {
        error_msg("Den není vyplněn");
    }

    if ($_POST["start"] == "" || $_POST["end"] == "") {
        error_msg("Vyplňte platný čas");
    }

    $start_time = strtotime($_POST["start"]);
    $end_time = strtotime($_POST["end"]);

    if ($end_time - $start_time > strtotime("02:00") || $end_time < $start_time) {
        error_msg("Rezervace může trvat maximálně 2 hodiny");
    }

    if ($_POST["trainer"] == "") {
        error_msg("Vyplňte své jméno");
    }

    if ($_POST["max_capacity"] < 1) {
        error_msg("Kapacita není vyplňena");
    }

    if ($_POST["reserved_capacity"] + 1 > $_POST["max_capacity"]) {
        error_msg("Rezervované místo nesmí být větší než maximální kapacita + 1");
    }

    if (!check_user($_POST["email"], $_POST["password"])) {
        error_msg("Špatné heslo nebo email");
    }
}

#[NoReturn] function error_msg($msg): void
{
    die("
        <script type='text/javascript'>alert('$msg'); 
        window.location = '../../index.php'</script>
    ");
}
