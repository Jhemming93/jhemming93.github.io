<?php
// REMEMBER: This will be stored in a non-web folder. In our case, /data/
$username_good = "admin8";
$yourpassword = "password8";

$pw_enc = password_hash($yourpassword, PASSWORD_DEFAULT);
?>