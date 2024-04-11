<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsGames";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$username = $_POST['username'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Validate input and match passwords
if (empty($username) || empty($firstName) || empty($lastName) || empty($password) || empty($confirmPassword)) {
    echo "All fields are required.";
    exit;
}

if ($password !== $confirmPassword) {
    echo "Passwords do not match.";
    exit;
}

// Hash the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Check if username already exists
$sql = "SELECT id FROM your_table_name WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Username already exists.";
} else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO your_table_name (username, first_name, last_name, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $firstName, $lastName, $passwordHash);

    // Execute and check
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
