<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game 2</title>

    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE SECOND GAME</h2>

    <div class="form2">
        <p>Lives: <span id="lives">6</span></p> 
        <form name="myForm2" action="GET">
            <label for="question2">Question 2. Order the 6 following letters in descending order!</label><br>
            <label>Use the following format AAAAAA</label><br>
            <label for="question2" id="letterOrder"></label><br>

            <input type="text" id="game2" name="question2" placeholder="Write here"><br>
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
            var userInput = document.getElementById('game2').value.trim().toUpperCase();

            var correctOrder = document.getElementById('letterOrder').textContent.split(',').join('').split('').sort().reverse().join('').trim();

            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly.");
                window.location.href = 'game3.php';
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
