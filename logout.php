<?php

require_once('./php/connection.php');

if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/", "", false, true);

    $stmt = $pdo->prepare('UPDATE users SET remember_token = NULL WHERE remember_token = :token');
    $stmt->execute(['token' => $_COOKIE['remember_me']]);
}

session_unset();
session_destroy();

header("Location: ./login.php");
exit();
