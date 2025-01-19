<?php

$passwordErr = '';
$emailErr = '';

require_once('connection.php');

if (isset($_POST['submit']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password-repeat'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];

    // CSRF-token
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token verification failed.");
    }

    // Wachtwoord
    if (strlen($password) < 8) {
        $_SESSION['passwordErr'] = "Your Password Must Contain At Least 8 Characters!";
        header("Location: ../signin.php");
        exit();
    } elseif (!preg_match("#[0-9]+#", $password)) {
        $_SESSION['passwordErr'] = "Your Password Must Contain At Least 1 Number!";
        header("Location: ../signin.php");
        exit();
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        $_SESSION['passwordErr'] = "Your Password Must Contain At Least 1 Capital Letter!";
        header("Location: ../signin.php");
        exit();
    } elseif (!preg_match("#[a-z]+#", $password)) {
        $_SESSION['passwordErr'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        header("Location: ../signin.php");
        exit();
    } elseif (!preg_match('/[\'^!£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
        $_SESSION['passwordErr'] = "Your Password Must Contain At Least 1 Special Character!";
        header("Location: ../signin.php");
        exit();
    } elseif ($password !== $password_repeat) {
        $_SESSION['passwordErr'] = "Passwords do not match!";
        header("Location: ../signin.php");
        exit();
    }

    // Wachtwoord hashen
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $first_name = filter_var($first_name, FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_var($last_name, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    // E-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailErr'] = "Invalid email format!";
        header("Location: ../signup.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $emailExists = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($emailExists) {
            $_SESSION['emailErr'] = "This email is already registered!";
            header("Location: ../signup.php");
            exit();
        }
        

        $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
        $stmt->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password_hash
        ]);

        echo "Registration successful!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: ../signin.php");
        exit();
    }
} else {
    header("Location: ../signin.php");
    exit();
}
