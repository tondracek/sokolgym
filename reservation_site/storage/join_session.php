<?php
//load from json
$sessions_loaded = file_get_contents("../storage/sessions.json");
$json_dict = json_decode($sessions_loaded, true);

$sessions_array = array();

foreach ($json_dict as $session) {
  array_push($sessions_array, $session);
}

//find the session
for ($i = 0; $i < count($sessions_array); $i++) {
  if ($sessions_array[$i]["day"] == $_GET["day"] && $sessions_array[$i]["start"] == $_GET["start"] && $sessions_array[$i]["end"] == $_GET["end"]) {
    if (count($sessions_array[$i]["attendants"]) >= $sessions_array[$i]["max_capacity"]) {
        $msg = "Rezervace je již zaplněna";
        die("<script type='text/javascript'>alert('$msg');
        window.location = '../reservation_site/index.php'</script>");
    } else {
        array_push($sessions_array[$i]["attendants"], $_GET["name"]);
    }
  }
}

//save back to json
file_put_contents("../storage/sessions.json", json_encode($sessions_array));

if (headers_sent()) {
  die('<script>window.location.href = "../index.php";</script>');
} else {
  header("Location: ../index.php");
  die();
}
