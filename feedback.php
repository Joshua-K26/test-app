<?php
session_start();
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['message']);
    $stmt->execute();
    header("Location: feedback.php");
    exit;
}
$rows = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feedback</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5" style="max-width:600px">
<h2>Feedback Form</h2>
<form method="POST" class="mb-4">
  <input type="text" name="name" class="form-control mb-2" placeholder="Your name" required>
  <textarea name="message" class="form-control mb-2" placeholder="Your message" required></textarea>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<h4>Submitted feedback</h4>
<?php while ($r = $rows->fetch_assoc()): ?>
  <div class="border rounded p-2 mb-2">
    <strong><?= htmlspecialchars($r['name']) ?></strong>
    <small class="text-muted"><?= $r['created_at'] ?></small>
    <p class="mb-0"><?= htmlspecialchars($r['message']) ?></p>
  </div>
<?php endwhile; ?>
</body>
</html>
