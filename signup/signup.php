<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "kidsGames";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$userInputUsername = $_POST['username'];
$userInputFirstName = $_POST['firstName'];
$userInputLastName = $_POST['lastName'];
$userInputPassword = $_POST['password'];
$userInputConfirmPassword = $_POST['confirmPassword'];

// Validate input and match passwords
if (empty($userInputUsername) || empty($userInputFirstName) || empty($userInputLastName) || empty($userInputPassword) || empty($userInputConfirmPassword)) {
    echo "All fields are required.";
    exit;
}

if ($userInputPassword !== $userInputConfirmPassword) {
    echo "Passwords do not match.";
    exit;
}

// Hash the password
$passwordHash = password_hash($userInputPassword, PASSWORD_DEFAULT);

// Check if username already exists using prepared statements
$stmt = $conn->prepare("SELECT id FROM player WHERE userName = ?");
$stmt->bind_param("s", $userInputUsername);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Username already exists.";
    $stmt->close();
    $conn->close();
    exit;
}
// Username does not exist, continue with insert
$stmt = $conn->prepare("INSERT INTO player (userName, fName, lName, passCode) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $userInputUsername, $userInputFirstName, $userInputLastName, $passwordHash);

// Execute and check
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
