<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Home</h2>
    <?php
    session_start();
    // Check if user is logged in
    if (isset($_SESSION['username'])) {
        echo "Welcome, " . $_SESSION['username'] . "!<br>";
        echo '<a href="LoginForm.php">Logout</a>';
    } else {
        echo '<a href="LoginForm.php">Login</a>';
    }
    ?>
</body>
</html>
