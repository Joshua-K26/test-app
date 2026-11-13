<?php
require 'config.php';
$msg = ""; $ok = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']);
    $e = trim($_POST['email']);
    $p = $_POST['password'];
    if ($p !== $_POST['confirm_password']) {
        $msg = "Passwords do not match.";
    } else {
        $h = password_hash($p, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $u, $e, $h);
        try {
            $stmt->execute();
            $ok = true;
            $msg = "Account created! You can now sign in.";
        } catch (mysqli_sql_exception $ex) {
            $msg = "Username already taken.";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reader's Odyssey Registration</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="css/register.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="register-wrapper">

    <!-- LEFT PANEL -->

    <div class="left-panel">

        <img
            src="images/2.png"
            class="small-logo"
            alt="Reader's Odyssey">

        <h1>Your Journey<br>Starts Here</h1>

        <p class="left-description">
            Access thousands of magazines,
            entertaining articles and journals
            from around the world.
        </p>

        <img
            src="images/tablet.png"
            class="tablet-image"
            alt="Magazine Preview">

        <div class="feature-row">

            <div class="feature">
                <i class="fa-regular fa-bookmark"></i>
                <h6>Premium Content</h6>
                <p>Curated magazines and articles</p>
            </div>

            <div class="feature">
                <i class="fa-solid fa-shield-halved"></i>
                <h6>Secure Access</h6>
                <p>Your account protected</p>
            </div>

            <div class="feature">
                <i class="fa-regular fa-file-lines"></i>
                <h6>Anywhere</h6>
                <p>Read on any device</p>
            </div>

        </div>

        <div class="copyright">
            © 2026 Reader's Odyssey. All rights reserved.
        </div>

    </div>

    <!-- RIGHT PANEL -->

    <div class="right-panel">

        <div class="register-card">

            <h2>Create Account</h2>

            <p class="subtitle">
                Join Reader's Odyssey and start exploring.
            </p>
 
<?php if ($msg): ?>
  <div class="alert <?= $ok ? 'alert-success' : 'alert-danger' ?> mb-3"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>
            <form method="POST">


                <div class="mb-3">
                      <input type="text" name="username" class="form-control" placeholder="Username" required>

                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="mb-3">

<input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>

                </div>

                <div class="terms-row">

                    <input type="checkbox" required>

                    <label>
                        I agree to the Terms &
                        Privacy Policy
                    </label>

                </div>

                <div class="d-grid">

<button type="submit" class="btn create-btn">Create Account</button>


                </div>

            </form>

            <div class="divider">
                or continue with
            </div>

            <div class="social-buttons">

                <button class="social-btn">
                    <i class="fab fa-google"></i>
                </button>

                <button class="social-btn">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button class="social-btn">
                    <i class="fab fa-apple"></i>
                </button>

            </div>

            <p class="login-text">

                Already have an account?

                <a href="login.php">
                    Sign In
                </a>

            </p>

        </div>

    </div>

</div>

</body>
</html>
