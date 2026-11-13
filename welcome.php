<?php session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; } ?>
<h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>! Login successful.</h1>
<a href="logout.php">Logout</a>
