<?php

session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'onlinebookstore';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
