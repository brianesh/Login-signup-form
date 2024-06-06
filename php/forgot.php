<?php

include("connection.php");
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container3">
    <form action="submit_form.php" method="post">
    <input type="hidden" name="action" value="reset_password">
    <h1>RESET PASSWORD</h1>
    <div>
        <label for="username">USERNAME</label>
        <input type="text" name="username" placeholder="Your username">
    </div>
    <div>
        <label for="security_question">WHAT WAS YOUR SECURITY QUESTION?</label>
        <select name="security_question">
        <option value="mother">What is your mother's maiden name?</option>
            <option value="pet">What is the name of your first pet?</option>
            <option value="town">What is the name of the town where you were born?</option>        </select>
    </div>
    <label for="security_answer">SECURITY ANSWER</label>
    <input type="text" name="security_answer" placeholder="Security answer">
    <label for="new_password">NEW PASSWORD</label>
    <input type="password" name="new_password" placeholder="Your new password">
    <label for="confirm_new_password">CONFIRM NEW PASSWORD</label>
    <input type="password" name="confirm_new_password" placeholder="Confirm new password">
    <div class="buttons">
        <button type="submit">RESET PASSWORD</button>
    </div>
    <div class="links">
        <a href="login.php">LOGIN</a>
    </div>
</form>
</div>
</body>
</html>