<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if last activity time is set
    if (isset($_SESSION['last_activity'])) {
        // Calculate elapsed time since last activity
        $inactive_time = time() - $_SESSION['last_activity'];
        // Check if inactive time exceeds timeout threshold (15 minutes)
        if ($inactive_time > 900) {
            // Destroy the session to log out the user
            session_destroy();
            // Redirect to the home page
            header("Location: index.php");
            exit();
        }
    }
    // Update last activity time
    $_SESSION['last_activity'] = time();
}
?>
