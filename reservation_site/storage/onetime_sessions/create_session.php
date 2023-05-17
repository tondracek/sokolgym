<?php
// test inputs
test_inputs();

//load from json
$sessions_loaded = file_get_contents("../storage/sessions.json");
$json_dict = json_decode($sessions_loaded, true);

$sessions_array = array();

foreach ($json_dict as $session) {
  array_push($sessions_array, $session);
}

//check if it overlaps with other sessions
for ($i = 0; $i < count($sessions_array); $i++) {
  if ($_POST["day"] == $sessions_array[$i]["day"]) {
    if ($_POST["start"] < $sessions_array[$i]["end"] && $_POST["end"] > $sessions_array[$i]["start"]) {
      error_msg("Rezervace se překrývá s jinou rezervací");
    }
  }
}

//check if it overlaps with basic reservation
if ($_POST["start"] < "20:00" && $_POST["end"] > "18:00") {
  error_msg("Rezervace se překrývá se základní rezervací");
}

//create new session in json
$attendants = array();

array_push($attendants, $_POST["trainer"]);
for ($i = 0; $i < $_POST["reserved_capacity"]; $i++) {
  array_push($attendants, "reserved");
}

$new_session = new stdClass();
$new_session -> day = $_POST["day"];
$new_session -> start = $_POST["start"];
$new_session -> end = $_POST["end"];
$new_session -> trainer = $_POST["trainer"];
$new_session -> max_capacity = $_POST["max_capacity"];
$new_session -> attendants = $attendants;
$new_session -> creator = $_POST["email"];

//add session to other jsons
array_push($sessions_array, $new_session);

file_put_contents("../storage/sessions.json", json_encode($sessions_array));

if (headers_sent()) {
  die('<script>window.location.href = "../../index.php";</script>');
} else {
  header("Location: ../index.php");
  die();
}

function check_user($your_email, $your_pass) {
  $users = json_decode(file_get_contents("users.json"), true);

  foreach($users as $user) {
    if ($user["email"] == $your_email) {
      if (password_verify($your_pass, $user["password"])) {
        return true;
      }
    }
  }
  return false;
}

function test_inputs() {
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

function error_msg($msg) {
  die("<script type='text/javascript'>alert('$msg');
  window.location = '../../index.php'</script>");
}
