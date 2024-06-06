<?php
session_start();

// Check if the request method is POST and action is logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure no further output is sent
} else {
    // Invalid request
    echo "Invalid request.";
}