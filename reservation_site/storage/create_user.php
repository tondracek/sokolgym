<?php
if (!verify_code()) {
  $msg = "Špatný kód";
  die("<script type='text/javascript'>alert('$msg');
  window.location = '../index.php'</script>");
}

$users = json_decode(file_get_contents("users.json", true));

$user = new stdClass();
$user->email = $_POST["email"];
$user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

if ($user->email == "") {
  $msg = "Vyplňte email";
  die("<script type='text/javascript'>alert('$msg');
    window.location = '../index.php'</script>");
}

if ($_POST["password"] != $_POST["password_again"]) {
  $msg = "Hesla se neshodují";
  die("<script type='text/javascript'>alert('$msg');
    window.location = '../index.php'</script>");
}

foreach ($users as $user_in_db) {
  if ($user_in_db->email == $user->email){
    $msg = "Email již je v databázi";
    die("<script type='text/javascript'>alert('$msg');
      window.location = '../index.php'</script>");
  }
}

array_push($users, $user);
file_put_contents("users.json", json_encode($users));
$msg = "Účet vytvořen";
die("<script type='text/javascript'>alert('$msg');
window.location = '../index.php'</script>");

function verify_code() {
  $codes = json_decode(file_get_contents("one_time_codes.json", true));
  print_r($codes);
  $new_codes = array();
  foreach ($codes as $code) {
    print_r($code);
    if ($_POST["code"] == $code) {
      file_put_contents("one_time_codes.json", json_encode($new_codes));
      return true;
    } else {
      array_push($new_codes, $code);
    }
  }
  file_put_contents("one_time_codes.json", json_encode($new_codes));
  return false;
}
?>