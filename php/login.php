<?php
session_start();

include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>
    <div class="container1">
    <form action="submit_form.php" onsubmit="return validation()" method="post" name="loginForm">
    <input type="hidden" name="action" value="login">
            <h1>Login Page</h1>
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Your username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Your password" id="password">
            <label><input type="checkbox" name="remember"> Remember me for 30 days.</label>

            <div class="buttons">
                <button type="submit">Login</button>
            </div>
            <div class="links">
                <a href="register.php" style="margin-right: 30px;">Don't have an account?</a>
                <a href="forgot.php">Forgot password?</a>
            </div>
        </form>
        <script>
            function validation() {
                var username = document.forms["loginForm"]["username"].value;
                var password = document.forms["loginForm"]["password"].value;
                if (username === "" && password === "") {
                    alert("Username and Password fields are empty");
                    return false;
                } else {
                    if (username === "") {
                        alert("Username is empty");
                        return false;
                    }
                    if (password === "") {
                        alert("Password field is empty");
                        return false;
                    }
                }
            }
        </script>
    </div>
</body>
</html>
