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
    <script src="/js/validation.js" defer></script>
</head>
<body>
    <div class="container3">
    <form action="submit_form.php" method="post" >
    <input type="hidden" name="action" value="reset_password">
        <h1>RESET PASSWORD</h1>
         <div>
            <label for="question">WHAT WAS YOUR SECURITY QUESTION?</label>
            <select>
            <option value="question">What is your mother's maiden name?</option>
            <option value="question">What is the name of your first pet?</option>
            <option value="question">What is the name of the town where you were born?</option>
          </select>
          </div>

          <label for="answer">SECURITY ANSWER</label>
          <input type="text"  placeholder="Security answer">
          <label for="text">PASSWORD</label>
          <input type="text" placeholder="your password">
            <label for="text">CONFIRM PASSWORD</label>
            <input type="text" placeholder="confirm password">

      
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