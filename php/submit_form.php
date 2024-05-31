<?php
session_start();

include("connection.php");
include("functions.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check the action parameter to determine the form submission type
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'register':
            // Registration form submitted
            handleRegistration($conn);
            break;
        
        case 'login':
            // Login form submitted
            handleLogin($conn);
            break;
        
        case 'reset_password':
            // Password reset form submitted
            handlePasswordReset($conn);
            break;
        
        default:
            echo "Invalid action.";
            break;
    }
}

// Function to handle registration form submission
function handleRegistration($conn) {
    // Retrieve form data
    $surname = $_POST['surname'];
    $other_names = $_POST['other_names'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    
    // Validate form data
    if (!empty($surname) && !empty($other_names) && !empty($username) && !empty($password) && !empty($email) && !empty($mobile_number) && !empty($security_question) && !empty($security_answer)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare an SQL statement to insert data into the users table
        if ($stmt = $conn->prepare("INSERT INTO user (surname, other_names, username, password, email, mobile_number, security_question, security_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssssss", $surname, $other_names, $username, $hashed_password, $email, $mobile_number, $security_question, $security_answer);
        
            // Execute the query
            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        } else {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
    } else {
        echo "Please fill all the required fields.";
    }
}

// Function to handle login form submission
function handleLogin($conn) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate form data
    if (!empty($username) && !empty($password)) {
        // Prepare an SQL statement to fetch user data based on username
        if ($stmt = $conn->prepare("SELECT * FROM user WHERE username = ?")) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, verify password
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    // Password is correct, set session variables and redirect to dashboard
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Invalid username or password.";
                }
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
    } else {
        echo "Please fill all the required fields.";
    }
}

// Function to handle password reset form submission
function handlePasswordReset($conn) {
    // Retrieve form data
    $username = $_POST['username'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];
    
    // Validate form data
    if (!empty($username) && !empty($security_question) && !empty($security_answer) && !empty($new_password)) {
        // Prepare an SQL statement to fetch user data based on username and security question
        if ($stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND security_question = ? AND security_answer = ?")) {
            $stmt->bind_param("sss", $username, $security_question, $security_answer);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, update password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                if ($update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?")) {
                    $update_stmt->bind_param("ss", $hashed_password, $username);
                    if ($update_stmt->execute()) {
                        echo "Password reset successful. You can now <a href='login.php'>login</a> with your new password.";
                    } else {
                        echo "Execute failed: (" . $update_stmt->errno . ") " . $update_stmt->error;
                    }
                } else {
                    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                }
            } else {
                echo "Invalid username or security question/answer combination.";
            }
        } else {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
    } else {
        echo "Please fill all the required fields.";
    }
}