<!DOCTYPE html>
<html lang="en">

<style>
    H1,
    h2 {
        text-align: center;
    }

    .form5 {
        width: 50%;
        margin: 0 auto;
        border: 2px solid black;
        box-sizing: border-box;
        text-align: center;
        border-color: green;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Games</title>
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE FIFTH GAME</h2>

    <div class="form5">
        <form name="myForm5" action="GET">
            <label for="question5">Question 5. Write the smallest and largest letter!</label><br>
            <label>Use the following format A A</label><br>
            <label for="question5" id="letterOrder"></label><br>

            <input type="text" id="game5" name="question5" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button"> Cancel </button>
        </form>
    </div>

    <script>
        var correctOrder;

        function generateRandomLetters() {
            // Generate random letters
            var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var randomLetters = '';

            // Select 6 unique random letters
            for (var i = 0; i < 6; i++) {
                var randomIndex = Math.floor(Math.random() * letters.length);
                randomLetters += letters[randomIndex];
                letters = letters.slice(0, randomIndex) + letters.slice(randomIndex + 1); // Remove selected letter
            }

            // Get the smallest and largest letters
            var smallestLetter = randomLetters.split('').sort()[0];
            var largestLetter = randomLetters.split('').sort()[randomLetters.length - 1];

            // Construct the correct order string
            correctOrder = smallestLetter + ' ' + largestLetter;

            // Set the random letters as the displayed order
            document.getElementById('letterOrder').textContent = randomLetters.split('').join(' ');

            return correctOrder;
        }

        function checkSorting() {
            // Get the input value
            var userInput = document.getElementById('game5').value.trim().toUpperCase();

            // Check if the user input matches the correct order
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly. ");
                window.location.href = 'game6.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again. ");
            }
        }

        // Generate random letters on page load
        window.onload = function () {
            generateRandomLetters();
        };
    </script>

</body>

</html>