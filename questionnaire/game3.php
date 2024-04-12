<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE THIRD GAME</h2>

    <div class="form3">
        <p>Lives: <span id="lives">6</span></p>
        <form name="myForm3" action="GET">
            <label for="question3">Question 3. Order the 6 following numbers in ascending order!</label><br>
            <label>Use the following format 00 00 00 00 00 00. For double digits use 00 for single digit use
                0</label><br>
            <label for="question3" id="letterOrder"></label><br>

            <input type="text" id="game3" name="question3" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button" onclick="cancelGame()">Cancel</button>
        </form>
    </div>

    <script>
        var lives = parseInt(sessionStorage.getItem('lives')) || 6;
        document.getElementById('lives').textContent = lives;

        function generateRandomNumbers() {
            var numbers = [];
            for (var i = 1; i <= 100; i++) {
                numbers.push(i);
            }
            for (var i = numbers.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                [numbers[i], numbers[j]] = [numbers[j], numbers[i]];
            }
            return numbers.slice(0, 6);
        }

        function checkSorting() {
            var userInput = document.getElementById('game3').value.trim();

            var correctOrder = document.getElementById('letterOrder').textContent;

            var sortedOrder = correctOrder.split(',').map(Number).sort((a, b) => a - b).join(' ');

            if (userInput === sortedOrder) {
                alert("Congratulations! You sorted the numbers correctly. ");
                window.location.href = 'game4.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again. ");
                decrementLives();
            }
        }
        function decrementLives() {
            lives--;
            document.getElementById('lives').textContent = lives;
            sessionStorage.setItem('lives', lives);
            if (lives === 0) {
                alert("Game Over. You have run out of lives.");
                window.location.href = '../homepage.html';
            }
        }

        function cancelGame() {
            lives = 6;
            document.getElementById('lives').textContent = lives;
            sessionStorage.setItem('lives', lives);
            alert("Thank you for playing. Hope we can see you soon!");
            window.location.href = '../homepage.html';
        }

        window.onload = function () {
            var randomNumbers = generateRandomNumbers();
            document.getElementById('letterOrder').textContent = randomNumbers.join(', ');
        };


    </script>

</body>

</html>
