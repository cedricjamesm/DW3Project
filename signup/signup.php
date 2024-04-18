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
        echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
        exit;
    }

    // Retrieve user input
    $userInputUsername = $_POST['username'];
    $userInputFirstName = $_POST['firstName'];
    $userInputLastName = $_POST['lastName'];
    $userInputPassword = $_POST['password'];
    $userInputConfirmPassword = $_POST['confirmPassword'];

    // Validate input and match passwords
    if (empty($userInputUsername) || empty($userInputFirstName) || empty($userInputLastName) || empty($userInputPassword) || empty($userInputConfirmPassword)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    if ($userInputPassword !== $userInputConfirmPassword) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
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
        echo json_encode(["success" => false, "message" => "Username already exists."]);
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Prepare the statement to insert the player
    $stmtPlayer = $conn->prepare("INSERT INTO player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, NOW())");
    $stmtPlayer->bind_param("sss", $userInputFirstName, $userInputLastName, $userInputUsername);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute and check
        if ($stmtPlayer->execute()) {
            $registrationOrder = $conn->insert_id;
            $stmtAuthenticator = $conn->prepare("INSERT INTO authenticator (passCode, registrationOrder) VALUES (?, ?)");
            $stmtAuthenticator->bind_param("si", $passwordHash, $registrationOrder);

            if ($stmtAuthenticator->execute()) {
                echo json_encode(["success" => true, "message" => "Registration successful. Redirecting..."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error: " . $stmtAuthenticator->error]);
            }
            $stmtAuthenticator->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmtPlayer->error]);
        }
    }
    $stmtPlayer->close();
    $conn->close();
