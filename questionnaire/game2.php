<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE SECOND GAME</h2>


    <div class="form2">
        <form name="myForm2" action="GET">
            <label for="question2">Question 2. Order the 6 following letters in descending order!</label><br>
            <label>Use the following format AAAAAA</label><br>
            <label for="question2" id="letterOrder"></label><br>

            <input type="text" id="game2" name="question2" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting2()">Submit</button>
            <button type="button"> Cancel </button>
        </form>
    </div>

    <?php

    ?>
    <script>
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

        function checkSorting2() {

            var userInput = document.getElementById('game2').value.trim().toUpperCase();

            // Get the correct order without commas
            var correctOrder = document.getElementById('letterOrder').textContent.split(',').join('').split('').sort().reverse().join('').trim();

            // Check if the user input matches the correct order
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly. ");
                window.location.href = 'game3.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again. ");
            }
        }

        // Generate random letters on page load
        window.onload = function () {
            var randomLetters = generateRandomLetters();
            document.getElementById('letterOrder').textContent = randomLetters.split('').join(', ');
        };


    </script>

</body>

</html>
