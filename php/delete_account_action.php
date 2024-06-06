<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $errors = array(); // Array to store validation errors
    
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($errors)) {
        // Proceed with account deletion
        
        // Check if the username exists in the database
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Username and password are correct, delete the account
                $sql_delete = "DELETE FROM user WHERE username = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("s", $username);
                $stmt_delete->execute();

                if ($stmt_delete->affected_rows > 0) {
                    // Account deleted successfully
                    header("Location: register.php");
                    exit();
                } else {
                    // Account may not exist
                    echo "Error: Account not found or already deleted.";
                }
            } else {
                // Incorrect password
                echo "Error: Incorrect password.";
            }
        } else {
            // Account not found
            echo "Error: Account not found. ";
        }

        // Close the statement
        $stmt->close();
        $stmt_delete->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request
    echo "Invalid request.";
}