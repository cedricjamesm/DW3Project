<?php
session_start();

// Check for error message from previous login attempt
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
unset($_SESSION['error_message']); // Clear the error message to prevent it from displaying multiple times

// Retrieve previously entered username from session
$username = isset($_SESSION['previous_username']) ? $_SESSION['previous_username'] : "";

// Clear previously entered username from session
unset($_SESSION['previous_username']);

// Clear previously entered password from session (for security reasons, do not store passwords in sessions)
unset($_SESSION['previous_password']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
    <h1>Login</h1>
    <?php if ($error_message !== ""): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="login/Login.php" method="post">
        <label for="username">Username:</label>
        <!-- Populate input field with previously entered username -->
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
        <!-- Make the registration button a link -->
        <a href="signup/signup.html">Register</a>
    </form>
    <!-- Link to prompt user for password change -->
    <p><a href="change_password/change_password.html">Forgot your password? Change it.</a></p>
</body>
</html>
