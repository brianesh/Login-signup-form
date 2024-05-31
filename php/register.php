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
    <title>SIGN UP PAGE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="/js/validation.js" defer></script>
</head>
<body>
   <center>
    <div class="container2">
    <form action="submit_form.php" onsubmit="return validation()" method="post" name="registerForm">
    <h1>SIGN IN YOUR DETAILS</h1>
    <input type="hidden" name="action" value="register">
    <div>
        <label for="surname">SURNAME</label>
        <input type="text" name="surname" id="surname" placeholder="your surname">
        <label for="other_names">OTHER NAMES</label>
        <input type="text" name="other_names" id="other_names" placeholder="Other names">
    </div>
    <div>
        <label for="username">USERNAME</label>
        <input type="text" name="username" id="username" placeholder="your username">
        <label for="password">PASSWORD</label>
        <input type="text" name="password" id="password" placeholder="your password">
    </div>
    <div>
        <label for="email">EMAIL</label>
        <input type="email" name="email" id="email" placeholder="your email">
        <label for="mobile_number">MOBILE NUMBER</label>
        <input type="tel" name="mobile_number" id="mobile_number" placeholder="your mobile number">
    </div>
    <div>
        <p>Choose your security question.</p>
        <select name="security_question" id="security_question" name="security_question">
            <option value="mother">What is your mother's maiden name?</option>
            <option value="pet">What is the name of your first pet?</option>
            <option value="town">What is the name of the town where you were born?</option>
        </select>
    </div>
    <div>
        <label for="security_answer">SECURITY ANSWER</label>
        <input type="text" id="security_answer" name="security_answer" placeholder="Security answer">
    </div>
    
    <div class="buttons">
        <button type="submit">SIGN UP</button>
    </div>
    <div class="links">
        <a href="login.php">Already have an account?</a>
    </div>
</form>
</div>
</center>
</body>
</html>