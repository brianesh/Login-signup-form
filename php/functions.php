<?php

function login($conn, $username, $password) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if user exists
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User exists, set session variables or perform further actions
        $_SESSION['username'] = $username;
        // Redirect or display success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}

function register($conn, $surname, $other_names, $username, $password, $email, $mobile_number, $security_question, $security_answer) {
    // Validate input
    $surname = mysqli_real_escape_string($conn, $surname);
    $other_names = mysqli_real_escape_string($conn, $other_names);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile_number = mysqli_real_escape_string($conn, $mobile_number);
    $security_question = mysqli_real_escape_string($conn, $security_question);
    $security_answer = mysqli_real_escape_string($conn, $security_answer);

    // Query to insert user into database
    $query = "INSERT INTO users (surname, other_names, username, password, email, mobile_number, security_question, security_answer) 
              VALUES ('$surname', '$other_names', '$username', '$password', '$email', '$mobile_number', '$security_question', '$security_answer')";

    if (mysqli_query($conn, $query)) {
        // Registration successful
        echo "Registration successful";
    } else {
        // Registration failed
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

function reset_password($conn, $username, $security_question, $security_answer, $new_password) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);
    $security_question = mysqli_real_escape_string($conn, $security_question);
    $security_answer = mysqli_real_escape_string($conn, $security_answer);
    $new_password = mysqli_real_escape_string($conn, $new_password);

    // Query to update password if security question and answer match
    $query = "UPDATE users SET password='$new_password' WHERE username='$username' AND security_question='$security_question' AND security_answer='$security_answer'";

    if (mysqli_query($conn, $query)) {
        // Password reset successful
        echo "Password reset successful";
    } else {
        // Password reset failed
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}