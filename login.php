<?php
session_start();
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['username']);
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $id, $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['user'] = $row['username'];
        header("Location: welcome.php");
        exit;
    }
    $error = "Invalid username or password.";
}
?>






<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Reader's Odyssey</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

<link
    rel="stylesheet"
    href="css/login.css">

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
```

</head>

<body>

<div class="overlay">

```
<div class="top-logo">

    <img
        src="images/rlogo.png"
        class="logo-image"
        alt="Reader's Odyssey">

</div>

<div class="login-container">

    <div class="login-card">

        <h2>Welcome Back!</h2>

        <p class="subtitle">
            Sign in to continue your reading journey.
        </p>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger mb-3"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
        <form method="POST">



            <div class="mb-3">
<input type="text" name="username" class="form-control" placeholder="Username or Email" required>

            </div>

            <div class="mb-3">

             <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="options-row">

                <div>
                    <input type="checkbox">
                    <label>Remember me</label>
                </div>

                <a href="#">Forgot Password?</a>

            </div>

            <div class="d-grid mt-3">

                <button type="submit" class="btn login-btn">Login</button>

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

        <p class="register-text">

            New here?

            <a href="register.php">
                Create an account
            </a>

        </p>

    </div>

</div>

<div class="features">

    <div class="feature">

        <h5>Premium Content</h5>

        <p>
            Unlimited access to exclusive magazines & articles
        </p>

    </div>

    <div class="feature">

        <h5>Personalized Experience</h5>

        <p>
            Save, bookmark and continue anytime
        </p>

    </div>

    <div class="feature">

        <h5>Secure & Private</h5>

        <p>
            Your reading data is safe with us
        </p>

    </div>

</div>
```

</div>





</body>

</html>
