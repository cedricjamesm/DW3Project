<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game 1</title>

    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE FIRST GAME</h2>

    <div class="form1">
        <p>Lives: <span id="lives">6</span></p>
        <form name="myForm1" action="GET">
            <label for="question1">Question 1. Order the 6 following letters in ascending order!</label><br>
            <label>Use the following format AAAAAA</label><br>
            <label for="question1" id="letterOrder"></label><br>

            <input type="text" id="game1" name="question1" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button" onclick="cancelGame()">Cancel</button>
        </form>
    </div>

    <script>
        var lives = parseInt(sessionStorage.getItem('lives')) || 6;
        document.getElementById('lives').textContent = lives;

        function generateRandomLetters() {
            var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var selectedLetters = '';
            for (var i = 0; i < 6; i++) {
                var randomIndex = Math.floor(Math.random() * letters.length);
                selectedLetters += letters[randomIndex];
                letters = letters.slice(0, randomIndex) + letters.slice(randomIndex + 1);
            }
            return selectedLetters;
        }

        function checkSorting() {
            var userInput = document.getElementById('game1').value.trim().toUpperCase();
            var correctOrder = document.getElementById('letterOrder').textContent.split(',').join('').split('').sort().join('').trim();

            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly.");
                window.location.href = 'game2.php';
            } else {
                alert("Sorry, the order is incorrect. Please try again.");
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
            var randomLetters = generateRandomLetters();
            document.getElementById('letterOrder').textContent = randomLetters.split('').join(', ');
        };
    </script>

</body>

</html>
