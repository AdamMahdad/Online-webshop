<?php
session_start();

$passwordErr = isset($_SESSION['passwordErr']) ? $_SESSION['passwordErr'] : '';
unset($_SESSION['passwordErr']);

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
    <link rel="stylesheet" href="styling/login.css">
    <title>Login</title>
</head>

<body>
    <div id="cards" class="login-container">
        <div class="card card-right">
            <div class="card-content">
                <div class="card-info-wrapper">
                    <div class="card-info-title">
                        <h3>Login</h3>
                        <h4>Don't have an account? <a href="signin.php">Sign up</a></h4>
                    </div>
                </div>
                <form class="login-form" action="./php/login.php" method="POST">
                    <input type="email" name="email" placeholder="Email" class="input-field" required>
                    <input type="password" name="password" placeholder="Enter your password" class="input-field" required>
                    <p style="color: red;"><?php echo htmlspecialchars($passwordErr); ?></p>
                    <div class="checkbox-row">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <button type="submit" name="submit" class="login-button">Login</button>
                </form>

                <div class="social-login">
                    <button class="social-button google">Login with Google</button>
                    <button class="social-button apple">Login with Apple</button>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/script.js"></script>
    <script>
        document.getElementById("cards").onmousemove = e => {
            for (const card of document.getElementsByClassName("card")) {
                const rect = card.getBoundingClientRect(),
                    x = e.clientX - rect.left,
                    y = e.clientY - rect.top;

                card.style.setProperty("--mouse-x", `${x}px`);
                card.style.setProperty("--mouse-y", `${y}px`);
            };
        }
    </script>
</body>

</html>