
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kidsGames";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['changepassword'])) {
            $username = $_POST['username'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            //checks if the password entered matches the confirmation password
            if ($newPassword === $confirmPassword) { 
                $sql_check_user = "SELECT * FROM player WHERE userName = '$username' AND fName = '$firstName' AND lName = '$lastName'";
                $result_check_user = $conn->query($sql_check_user);

                //checks if a user has been found in the database
                if ($result_check_user->num_rows > 0) { 

                    //hash the password for security
                    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

                    //updae the password in the database
                    $sql_update_password = "UPDATE authenticator SET passCode = '$hashed_password' WHERE registrationOrder = (
                        SELECT registrationOrder FROM player WHERE userName = '$username'
                    )";

                    //if the password update is successful, send message
                    if ($conn->query($sql_update_password) === TRUE) {
                        echo "Password updated successfully";
                    } else {
                        //error message when unable to update password
                        echo "Error updating password: " . $conn->error;
                    }
                } else {
                    echo "User not found";
                }
            } else {
                echo "Please make sure the passwords match!";
            }
        } elseif (isset($_POST['login'])) {
            header("Location: login.php");
            exit();
        }
    }

    $conn->close();
