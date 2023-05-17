<?php

test_inputs();

$sessions = OnetimeSession::load_onetime_sessions_array("reservation_site/storage/onetime_sessions/sessions.json");

$new_session = OnetimeSession::load_session($_POST);

is_overlapping_with_existing($new_session, $sessions);

$attendants[] = $_POST["trainer"];
for ($i = 0; $i < $_POST["reserved_capacity"]; $i++) {
    $new_session->add_attendant("reserved");
}

$sessions[] = $new_session;

file_put_contents("../storage/sessions.json", json_encode($sessions));

if (headers_sent()) {
    die('<script>window.location.href = "../../index.php";</script>');
} else {
    header("Location: ../../index.php");
    die();
}

function check_user($your_email, $your_pass)
{
    $users = json_decode(file_get_contents("users.json"), true);

    foreach ($users as $user) {
        if ($user["email"] == $your_email) {
            if (password_verify($your_pass, $user["password"])) {
                return true;
            }
        }
    }
    return false;
}

function is_overlapping_with_existing(Session $new_session, array $sessions)
{
    foreach ($sessions as $session) {
        if ($new_session->is_overlapping($session)) {
            error_msg("Rezervace se překrývá s jinou rezervací");
        }
    }

    //check if it overlaps with basic reservation
    if ($_POST["start"] < "20:00" && $_POST["end"] > "18:00") {
        error_msg("Rezervace se překrývá s pravidelnou rezervací");
    }
}

function test_inputs()
{
    if ($_POST["day"] == "") {
        error_msg("Den není vyplněn");
    }

    if ($_POST["start"] == "" || $_POST["end"] == "") {
        error_msg("Vyplňte platný čas");
    }

    if ($_POST["end"] - $_POST["start"] > 2 || $_POST["end"] < $_POST["start"]) {
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

function error_msg($msg)
{
    die("
        <script type='text/javascript'>alert('$msg'); 
        window.location = '../../index.php'</script>
    ");
}
