<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <?php if ($user): ?>
            <h1>Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <h1>Welcome to our website!</h1>
            <div class="links">
            <a href="login.php" style="margin-right: 50px;">Login</a>
            <a href="register.php">Register</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
