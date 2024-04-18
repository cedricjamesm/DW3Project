<!-- history.html -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game History</title>
    <link rel="stylesheet" href="css/history.css">
</head>

<body>
    <header>
        <h1>Game History</h1>
        <nav>
            <a href="homepage.html">Home</a>
        </nav>
    </header>
    <div class="container">
        <h2>Your Game History</h2>
        <table>
            <tr>
                <th>Player ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Game Result</th>
                <th>Lives Used</th>
                <th>Date and Time</th>
            </tr>
            <!-- PHP script to fetch and display game history -->
            <?php
            session_start();

            // Check if the user is logged in
            if (!isset($_SESSION['username'])) {
                // Redirect to the login page if not logged in
                header("Location: login.php");
                exit();
            }

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kidsGames";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch the user's registrationOrder based on the logged-in username
            $username = $_SESSION['username'];
            $sql = "SELECT registrationOrder FROM player WHERE userName = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $registrationOrder = $row['registrationOrder'];

                // Fetch game history for the logged-in user from the database
                $sql = "SELECT p.id, p.fName, p.lName, s.result, s.livesUsed, s.scoreTime 
            FROM player p
            JOIN score s ON p.registrationOrder = s.registrationOrder
            WHERE p.registrationOrder = $registrationOrder";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["fName"] . "</td>";
                        echo "<td>" . $row["lName"] . "</td>";
                        echo "<td>" . $row["result"] . "</td>";
                        echo "<td>" . $row["livesUsed"] . "</td>";
                        echo "<td>" . $row["scoreTime"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No game history found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>User not found.</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>



        </table>
    </div>

</body>

</html>