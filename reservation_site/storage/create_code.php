<?php

$codes = json_decode(file_get_contents("registration_codes.json", true));

$hash = "$2y$10$3YCECCCV4HyLwNND4cbwfuHHQnkuLDapRUQ1qiQGVe4wag9YlfP2C";
if (!password_verify($_POST["password"], $hash)) {
    $msg = "Špatné heslo";
    die("<script type='text/javascript'>alert('$msg');
    window.location = '../index.php'</script>");
}

$new_code = random_int(1000000, 9999999);

array_push($codes, $new_code);

file_put_contents("registration_codes.json", json_encode($codes));

$msg = "Jednorázový kód vytvořen: $new_code";
die("<script type='text/javascript'>alert('$msg');
window.location = '../index.php';</script>");
?>