<!DOCTYPE html>
<html lang="en">

<style>
    H1,
    h2 {
        text-align: center;
    }

    .form1 {
        width: 50%;
        margin: 0 auto;
        border: 2px solid black;
        box-sizing: border-box;
        text-align: center;
        border-color: red;

    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Games</title>
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE FIRST GAME</h2>

    <div class="form1">
        <form name="myForm1" action="GET">
            <label for="question1">Question 1. Order the 6 following letters in ascending order!</label><br>
            <label>Use the following format AAAAAA</label><br>
            <label for="question1" id="letterOrder"></label><br>

            <input type="text" id="game1" name="question1" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting().submit()">Submit</button>
            <button type="button"> Cancel </button>
        </form>
    </div>

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

        function checkSorting() {
            // Get the input value
            var userInput = document.getElementById('game1').value.trim().toUpperCase();

            // Get the correct order without commas
            var correctOrder = document.getElementById('letterOrder').textContent.split(',').join('').split('').sort().join('').trim();

            // Check if the user input matches the correct order
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly. ");
                window.location.href = 'game2.php';
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