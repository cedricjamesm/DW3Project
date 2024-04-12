<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game 2</title>
    <style>
        h1,
        h2 {
            text-align: center;
        }

        .form2 {
            width: 50%;
            margin: 0 auto;
            border: 2px solid black;
            box-sizing: border-box;
            text-align: center;
            border-color: blue;
        }
    </style>
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE SECOND GAME</h2>

    <div class="form2">
        <p>Lives: <span id="lives">6</span></p> <!-- Display Lives -->
        <form name="myForm2" action="GET">
            <label for="question2">Question 2. Order the 6 following letters in descending order!</label><br>
            <label>Use the following format AAAAAA</label><br>
            <label for="question2" id="letterOrder"></label><br>

            <input type="text" id="game2" name="question2" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button" onclick="cancelGame()">Cancel</button> <!-- Call cancelGame function -->
        </form>
    </div>

    <script>
        // Initialize lives counter from sessionStorage or default to 3
        var lives = parseInt(sessionStorage.getItem('lives')) || 6;
        document.getElementById('lives').textContent = lives; // Update lives display

        function generateRandomLetters() {
            var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var selectedLetters = '';
            // Select 6 unique random letters
            for (var i = 0; i < 6; i++) {
                var randomIndex = Math.floor(Math.random() * letters.length);
                selectedLetters += letters[randomIndex];
                letters = letters.slice(0, randomIndex) + letters.slice(randomIndex + 1); // Remove selected letter
            }
            return selectedLetters;
        }

        function checkSorting() {
            // Get the input value
            var userInput = document.getElementById('game2').value.trim().toUpperCase();

            // Get the correct order without commas
            var correctOrder = document.getElementById('letterOrder').textContent.split(',').join('').split('').sort().reverse().join('').trim();

            // Check if the user input matches the correct order
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly.");
                window.location.href = 'game3.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again.");
                decrementLives(); // Decrement lives if answer is wrong
            }
        }

        function decrementLives() {
            lives--; // Decrement lives counter
            document.getElementById('lives').textContent = lives; // Update lives display
            sessionStorage.setItem('lives', lives); // Store lives count in sessionStorage
            if (lives === 0) {
                alert("Game Over. You have run out of lives.");
                window.location.href = '../homepage.html';
                // You can add redirection to a game over page or any other action here
            }
        }

        function cancelGame() {
            lives = 6; // Reset lives counter
            document.getElementById('lives').textContent = lives; // Update lives display
            sessionStorage.setItem('lives', lives); // Store lives count in sessionStorage
            alert("Thank you for playing. Hope we can see you soon!");
            window.location.href = '../homepage.html';
            // You can add any other reset logic here
        }

        // Generate random letters on page load
        window.onload = function () {
            var randomLetters = generateRandomLetters();
            document.getElementById('letterOrder').textContent = randomLetters.split('').join(', ');
        };
    </script>

</body>

</html>
