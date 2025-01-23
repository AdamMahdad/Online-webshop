<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['loggedIn'] = true;

            session_regenerate_id(true);

            if ($remember) {
                $token = bin2hex(random_bytes(16));
                $expiry = time() + (30 * 24 * 60 * 60);
                setcookie('remember_me', $token, $expiry, "/", "", false, true);

                $stmt = $pdo->prepare('UPDATE users SET remember_token = :token WHERE email = :email');
                $stmt->execute(['token' => $token, 'email' => $email]);
            }

            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Onjuiste e-mail of wachtwoord!";
            header("Location: ../login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Databasefout: " . $e->getMessage();
        header("Location: ../login.php");
        exit();
    }
}
