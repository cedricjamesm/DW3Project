<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "kidsGames"; 


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    
    $sql_check_user = "SELECT * FROM player WHERE userName = '$username'";
    $result_check_user = $conn->query($sql_check_user);

    
    if ($result_check_user->num_rows > 0) {
        
        $sql_update_password = "UPDATE authenticator SET passCode = ? WHERE registrationOrder = (
            SELECT registrationOrder FROM player WHERE userName = ?
        )";

        $stmt = $conn->prepare($sql_update_password);

        $stmt->bind_param("ss", $new_password_hash, $username);

        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        if ($stmt->execute()) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }

        $stmt->close();
        
    } else {
        echo "User not found";
    }
}

$conn->close();
