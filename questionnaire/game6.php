<!DOCTYPE html>
<html lang="en">

<style>
    H1,
    h2 {
        text-align: center;
    }

    .form6 {
        width: 50%;
        margin: 0 auto;
        border: 2px solid black;
        box-sizing: border-box;
        text-align: center;
        border-color: pink;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Games</title>
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE LAST GAME</h2>

    <div class="form6">
        <p>Lives: <span id="lives">6</span></p>
        <form name="myForm6" action="GET">
            <label for="question6">Question 6. Write the smallest and largest number!</label><br>
            <label>Use the following format 0 0</label><br>
            <label for="question6" id="numberOrder"></label><br>

            <input type="text" id="game6" name="question6" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button" onclick="cancelGame()">Cancel</button>
        </form>
    </div>

    <script>
        var lives = parseInt(sessionStorage.getItem('lives')) || 6;
        document.getElementById('lives').textContent = lives;
        var correctOrder;

        function generateRandomNumbers() {
            // Generate random numbers
            var numbers = [];
            for (var i = 0; i < 6; i++) {
                numbers.push(Math.floor(Math.random() * 100) + 1); // Random numbers from 1 to 100
            }

            // Get the smallest and largest numbers
            var smallestNumber = Math.min(...numbers);
            var largestNumber = Math.max(...numbers);

            // Construct the correct order string
            correctOrder = smallestNumber + ' ' + largestNumber;

            // Set the random numbers as the displayed order
            document.getElementById('numberOrder').textContent = numbers.join(' ');

            return correctOrder;
        }

        function checkSorting() {
            // Get the input value
            var userInput = document.getElementById('game6').value.trim();

            // Check if the user input matches the correct order
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the numbers correctly and have won the game!!!!! ");
                window.location.href = '../homepage.html';
            } else {
                alert("Sorry, the order is incorrect. Please try again. ");
                decrementLives();
            }
        }
        function decrementLives() {
            lives--; // Decrement lives counter
            document.getElementById('lives').textContent = lives; // Update lives display
            sessionStorage.setItem('lives', lives);
            if (lives === 0) {
                alert("Game Over. You have run out of lives.");
                window.location.href = '../homepage.html';
                // You can add redirection to a game over page or any other action here
            }
        }

        function cancelGame() {
            lives = 6; // Reset lives counter
            document.getElementById('lives').textContent = lives; // Update lives display
            sessionStorage.setItem('lives', lives);
            alert("Thank you for playing. Hope we can see you soon!");
            window.location.href = '../homepage.html';
            // You can add any other reset logic here
        }
        // Generate random numbers on page load
        window.onload = function () {
            generateRandomNumbers();
        };
    </script>

</body>

</html>
