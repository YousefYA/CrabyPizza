<?php
session_start();

// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 0, 
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true, 
    'httponly' => true, 
    'samesite' => 'Strict', 
]);

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);
?>
