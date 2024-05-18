<?php
$password = "hash"; // Replace "your_password_here" with the password you want to hash.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;
?>
