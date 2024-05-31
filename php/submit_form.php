<?php
session_start(); 
     
include("connection.php");
include("functions.php");

// Check if the form was submitted using POST method
if($_SERVER['REQUEST_METHOD'] == "POST") {
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
    $security_question = $_POST['security_question']; // Assuming your select element has name="question"
    $security_answer = $_POST['security_answer'];
    
    // Validate form data (you can add more validation if needed)
    if(!empty($surname) && !empty($other_names) && !empty($username) && !empty($password) && !empty($email) && !empty($mobile_number) && !empty($security_question) && !empty($security_answer)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // SQL query to insert data into the users table
        $query = "INSERT INTO users (surname, other_names, username, password, email, mobile_number, security_question, security_answer) VALUES ('$surname', '$other_names', '$username', '$hashed_password', '$email', '$mobile_number', '$security_question', '$security_answer')";
        
        // Execute the query
        if(mysqli_query($conn, $query)) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit(); // Stop further execution
        } else {
            echo "Error: " . mysqli_error($conn); // Print any errors if query execution fails
        }
    } else {
        echo "Please fill all the required fields."; // If any field is empty, show an error message
    }
}

// Function to handle login form submission
function handleLogin($conn) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate form data
    if(!empty($username) && !empty($password)) {
        // SQL query to fetch user data based on username
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1) {
            // User found, verify password
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])) {
                // Password is correct, set session variables and redirect to dashboard or user profile page
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                // Redirect to dashboard or user profile page
                header("Location: dashboard.php");
                exit(); // Stop further execution
            } else {
                echo "Invalid username or password."; // Password doesn't match
            }
        } else {
            echo "Invalid username or password."; // User not found
        }
    } else {
        echo "Please fill all the required fields."; // If any field is empty, show an error message
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
    if(!empty($username) && !empty($security_question) && !empty($security_answer) && !empty($new_password)) {
        // SQL query to fetch user data based on username and security question
        $query = "SELECT * FROM users WHERE username='$username' AND security_question='$security_question' AND security_answer='$security_answer'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1) {
            // User found, update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
            if(mysqli_query($conn, $update_query)) {
                echo "Password reset successful. You can now <a href='login.php'>login</a> with your new password.";
            } else {
                echo "Error resetting password: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid username or security question/answer combination.";
        }
    } else {
        echo "Please fill all the required fields."; // If any field is empty, show an error message
    }
}