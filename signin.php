<?php
session_start();

$passwordErr = isset($_SESSION['passwordErr']) ? $_SESSION['passwordErr'] : '';
$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : '';
unset($_SESSION['passwordErr']);
unset($_SESSION['emailErr']);

// CSRF-token genereren
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/signup.css">
    <title>Create an Account</title>
</head>

<body>
    <div id="cards" class="login-container">
        <div class="card card-right">
            <div class="card-content">
                <div class="card-info-wrapper">
                    <div class="card-info-title">
                        <h3>Create an Account</h3>
                        <h4>Already have an account? <a href="#">Log in</a></h4>
                    </div>
                </div>
                <form class="login-form" action="./php/signup.php" method="POST">
                    <div class="form-row">
                        <input type="text" name="first_name" placeholder="First Name" class="input-field" required>
                        <input type="text" name="last_name" placeholder="Last Name" class="input-field" required>
                    </div>
                    <input type="email" name="email" placeholder="Email" class="input-field" required>
                    <input type="password" name="password" placeholder="Enter your password" class="input-field" required>
                    <input type="password" name="password-repeat" placeholder="Repeat your password" class="input-field" required>
                    <p style="color: red;"><?php echo htmlspecialchars($passwordErr); ?></p>
                    <div class="checkbox-row">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I agree to the Terms & Conditions</label>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <button type="submit" name="submit" class="login-button">Create Account</button>
                </form>

                <div class="social-login">
                    <button class="social-button google">Register with Google</button>
                    <button class="social-button apple">Register with Apple</button>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/script.js"></script>
</body>

</html>
