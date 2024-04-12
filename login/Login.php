<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsGames";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if (isset($_POST['login'])) {
    $name = $_POST['username'];
    $psw = $_POST['password'];

    // Query the database to retrieve the hashed password for the given username
    $sql = "SELECT a.passCode FROM authenticator a
            INNER JOIN player p ON a.registrationOrder = p.registrationOrder
            WHERE p.userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name); // Assuming the username corresponds to the userName
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['passCode']; // Retrieve the 'passCode' column

        // Verify the hashed password
        if (password_verify($psw, $hashed_password)) {
            // Username and password are correct, start session
            $_SESSION['username'] = $name;
            header("Location: ../homepage.html");
            exit();
        }
    }

    // Incorrect username or password, redirect back to login form with error message
    $_SESSION['error_message'] = "Incorrect username or password!\nPassword: $psw\nUsername: $name";
    header("Location: index.php");
    exit();
}

// Close connection
$conn->close();
