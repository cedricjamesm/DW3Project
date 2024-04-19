<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kidsGames";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form field values
        $username = $_POST['username'] ?? "";
        $firstName = $_POST['firstName'] ?? "";
        $lastName = $_POST['lastName'] ?? "";
        $newPassword = $_POST['newPassword'] ?? "";
        $confirmPassword = $_POST['confirmPassword'] ?? "";

        $errors = array();

        // Check for empty fields
        if (empty($username) || empty($firstName) || empty($lastName) || empty($newPassword) || empty($confirmPassword)) {
            $errors[] = "All fields are required!";
        } else {
            // Check individual field validations
            if (!preg_match("/^[a-zA-Z]/", $firstName)) {
                $errors[] = "First name must start with a letter";
            }

            if (!preg_match("/^[a-zA-Z]/", $lastName)) {
                $errors[] = "Last name must start with a letter";
            }

            if (!preg_match("/^[a-zA-Z]/", $username)) {
                $errors[] = "Username must start with a letter";
            }

            if (strlen($username) < 8) {
                $errors[] = "Username must be at least 8 characters long";
            }

            if (strlen($newPassword) < 8) {
                $errors[] = "Password must be at least 8 characters long";
            }

            if ($newPassword !== $confirmPassword) {
                $errors[] = "Please make sure the passwords match!";
            }
        }

        // Output errors
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        } else {
            // If there are no errors, proceed to update the password in the database 
            $sql_check_user = "SELECT * FROM player WHERE userName = '$username' AND fName = '$firstName' AND lName = '$lastName'";
            $result_check_user = $conn->query($sql_check_user);

            if ($result_check_user->num_rows > 0) {
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

                $sql_update_password = "UPDATE authenticator SET passCode = '$hashed_password' WHERE registrationOrder = (
                    SELECT registrationOrder FROM player WHERE userName = '$username'
                )";

                // If the password update is successful, send message
                if ($conn->query($sql_update_password) === TRUE) {           
                    $successMessage = "Password updated successfully!";
                    echo $successMessage;

                    echo "<script> document.getElementById('myForm').reset(); </script>";

                } else {
                    // Error message when unable to update password
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "User not found! Enter a valid username.";
            }
        }
    }
