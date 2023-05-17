<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once "../reservation_site/storage/Session.php";
require_once "../reservation_site/storage/onetime_sessions/OnetimeSession.php";
require_once "../reservation_site/storage/regular_sessions/RegularSessions.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_POST["name"] == "") {
    $msg = "Vyplňte jméno";
    die("<script type='text/javascript'>alert('$msg');
    window.location = '../reservation_site/index.php'</script>");
}

if ($_POST["email"] == "") {
    $msg = "Vyplňte email";
    die("<script type='text/javascript'>alert('$msg');
    window.location = '../reservation_site/index.php'</script>");
}

session_start();

if ($_SESSION["regular"]) {
    $filename = "../reservation_site/storage/regular_sessions/regular_sessions.json";
    $sessions = RegularSessions::load_regular_sessions_array($filename);
} else {
    $filename = "../reservation_site/storage/onetime_sessions/sessions.json";
    $sessions = OnetimeSession::load_onetime_sessions_array($filename);
}

foreach ($sessions as $session) {
    if ($session instanceof Session && $session->getID() == $_POST["id"]) {
        $_SESSION["day"] = $session->getDay();
        $_SESSION["start"] = $session->getStart();
        $_SESSION["end"] = $session->getEnd();
    }
    break;
}


$address = $_SERVER['HTTP_HOST'];

$email = new PHPMailer\PHPMailer\PHPMailer();

$email->isSMTP();
$email->Host = 'smtp.gmail.com';
$email->SMTPAuth = true;
$email->Username = "sokolgymmohelnorezervace@gmail.com";
$email->Password = "ntfnkzhlurajakmb";
$email->SetFrom("sokolgymmohelnorezervace@gmail.com", "SokolGym");
$email->AddAddress($_POST["email"]);
$time = date('H:i');
$email->Subject = "Potvrzení rezervace v SokolGym - $time";
$email->CharSet = 'UTF-8';
$email->isHTML(true);

if ($_SESSION["regular"]) {
    $email->Body = regular_body($address);
} else {
    $email->Body = onetime_body($address);
}

if (!$email->Send()) {
    $msg = "Prosím zkuste to znovu. $email->ErrorInfo";
} else {
    $msg = "Potvrďte přihlášení na vašem emailu";
}
die();
die("<script type='text/javascript'>alert('$msg');
window.location = '../reservation_site/index.php'</script>");

function regular_body($address)
{
    return "
    <html>
      <head>
        <meta charset='UTF-8'>
        <style>
        div {
          position: absolute;
          background-color: #1b1d1f;
          color: #ffffff;
          font-family: monospace;
          font-size: 18px;
          margin: 0px;
          overflow-anchor: none;
          width: 100%;
          overflow: overlay;
          padding: 20px 0%;
        }
        </style>
      </head>
      <body>
        <div style='text-align: center;'>
          <h1>Prosím, potvrďte své přihlášení</h1>
          <a href='$address'/reservation_site/storage/join_regular_session.php?id={$_SESSION['id']}&name={$_POST['name']}'>Potvrdit</a>
          <h1>Zvolili jste dnešní pravidelný termín</h1>
          <p>{$_SESSION['start']} - {$_SESSION['end']}</p>
          <p>{$_POST['name']}</p>
        </div>
      </body>
    </html>
    ";
}

function onetime_body($address)
{
    return "
    <html>
      <head>
        <meta charset='UTF-8'>
        <style>
        div {
          position: absolute;
          background-color: #1b1d1f;
          color: #ffffff;
          font-family: monospace;
          font-size: 18px;
          margin: 0px;
          overflow-anchor: none;
          width: 100%;
          overflow: overlay;
          padding: 20px 0%;
        }
        </style>
      </head>
      <body>
        <div style='text-align: center;'>
          <h1>Prosím, potvrďte své přihlášení</h1>
          <a href='$address''/reservation_site/storage/join_session.php?day={$_SESSION['day']}&start={$_SESSION['start']}&end={$_SESSION['end']}&name={$_POST['name']}'>Potvrdit</a>
          <h1>Zvolili jste termín</h1>
          <p>{$_SESSION['day']}</p>
          <p>{$_SESSION['start']} - {$_SESSION['end']}</p>
          <p>{$_POST['name']}</p>
        </div>
      </body>
    </html>
    ";
}