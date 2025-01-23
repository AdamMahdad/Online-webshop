<?php
require_once('connection.php');

$passwordErr = '';
$emailErr = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $password_repeat = $_POST['password-repeat'];

  // CSRF-token
  if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token verification failed.");
  }

  // Validaties voor wachtwoord
  if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password) ||
    !preg_match("#[a-z]+#", $password) || !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
    $_SESSION['passwordErr'] = "Wachtwoord voldoet niet aan de eisen!";
    header("Location: ../signin`");
    exit();
  }

  if ($password !== $password_repeat) {
    $_SESSION['passwordErr'] = "Wachtwoorden komen niet overeen!";
    header("Location: ../signin`");
    exit();
  }

  // Hash het wachtwoord
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  // Valideer en filter gegevens
  $first_name = filter_var($first_name, FILTER_SANITIZE_SPECIAL_CHARS);
  $last_name = filter_var($last_name, FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['emailErr'] = "Ongeldig e-mailadres!";
    header("Location: ../signin`");
    exit();
  }

  try {
    $stmt = $pdo->prepare('SELECT email FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
      $_SESSION['emailErr'] = "Dit e-mailadres is al geregistreerd!";
      header("Location: ../si  gnin`");
      exit();
    }

    $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
    $stmt->execute([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'password' => $password_hash
    ]);

    // Zet sessievariabelen
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['loggedIn'] = true;

    header("Location: ../index.php");
    exit();
  } catch (PDOException $e) {
    $_SESSION['error'] = "Databasefout: " . $e->getMessage();
    header("Location: ../signin`");
    exit();
  }
}
?>
