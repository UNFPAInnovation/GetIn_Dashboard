<?php
$password = "password";
$iterations = 1000;

// Generate a random IV using mcrypt_create_iv(),
// openssl_random_pseudo_bytes() or another suitable source of randomness
$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
echo $hash;
?>