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
$stmt = $conn->prepare("SELECT registrationOrder FROM player WHERE userName = ?");
$stmt->bind_param("s", $userInputUsername);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Username already exists.";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Prepare the statement to insert the player
$stmtPlayer = $conn->prepare("INSERT INTO player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, NOW())");
$stmtPlayer->bind_param("sss", $userInputFirstName, $userInputLastName, $userInputUsername);

// Execute and check
if ($stmtPlayer->execute()) {
    // Get the registrationOrder of the last inserted player
    $registrationOrder = $conn->insert_id;

    // Prepare the statement to insert the password hash into authenticator
    $stmtAuthenticator = $conn->prepare("INSERT INTO authenticator (passCode, registrationOrder) VALUES (?, ?)");
    $stmtAuthenticator->bind_param("si", $passwordHash, $registrationOrder);

    // Execute and check
    if ($stmtAuthenticator->execute()) {
        // Close the authenticator statement
        $stmtAuthenticator->close();
        
        // Redirect to index.php
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmtAuthenticator->error;
    }
} else {
    echo "Error: " . $stmtPlayer->error;
}

// Close player statement and connection
$stmtPlayer->close();
$conn->close();
