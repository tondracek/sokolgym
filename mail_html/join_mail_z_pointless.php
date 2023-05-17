<?php
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

// PŘEDĚLAT CELÉ

$to = $_POST["email"];

$subject = 'Potvrzení přihlášení do SokolGym';

$headers  = "From: sokolgymmohelno@gmail.com" . "\r\n";
$headers .= "Reply-To: sokolgymmohelno@gmail.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = //"
<head>
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
    <h1>Zvolili jste termín</h1>
    <p>{$_SESSION['day']}</p>
    <p>{$_SESSION['start']} - {$_SESSION['end']}</p>
    <p>{$_POST['name']}</p>
    <h1>Prosím, potvrďte své přihlášení</h1>
    <a href='https://www.sokolgym.cz/reservation_site/storage/join_session.php?day={$_SESSION['day']}&start={$_SESSION['start']}&end={$_SESSION['end']}&name={$_POST['name']}'>Potvrdit</a>
  </div>
</body>";

mail($to, $subject, $message, $headers);

$msg = "Prosím, potvrďte rezervaci na vašem emailu!";
die("<script type='text/javascript'>alert('$msg');
window.location = '../reservation_site/index.php'</script>");
?>
