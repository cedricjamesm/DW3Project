<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE FOURTH GAME</h2>

    <div class="form4">
        <form name="myForm4" action="GET">
            <label for="question4">Question 4. Order the 6 following numbers in descending order!</label><br>
            <label>Use the following format 00 00 00 00 00 00. For double digits use 00 for single digit use
                0</label><br>
            <label for="question4" id="letterOrder"></label><br>

            <input type="text" id="game4" name="question4" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button"> Cancel </button>
        </form>
    </div>

    <script>
        function generateRandomNumbers() {
            var numbers = [];
            // Generate random numbers from 1 to 100
            for (var i = 1; i <= 100; i++) {
                numbers.push(i);
            }
            // Shuffle the numbers
            for (var i = numbers.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                [numbers[i], numbers[j]] = [numbers[j], numbers[i]]; // Swap elements
            }
            // Select the first 6 numbers
            return numbers.slice(0, 6);
        }

        function checkSorting() {
            // Get the input value
            var userInput = document.getElementById('game4').value.trim();

            // Get the correct order without commas
            var correctOrder = document.getElementById('letterOrder').textContent;

            // Get the sorted correct order in descending order
            var sortedOrder = correctOrder.split(',').map(Number).sort((a, b) => b - a).join(' ');

            // Check if the user input matches the sorted correct order
            if (userInput === sortedOrder) {
                alert("Congratulations! You sorted the numbers correctly. ");
                window.location.href = 'game5.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again. ");
            }
        }

        // Generate random numbers on page load
        window.onload = function () {
            var randomNumbers = generateRandomNumbers();
            document.getElementById('letterOrder').textContent = randomNumbers.join(', ');
        };


    </script>

</body>

</html>
