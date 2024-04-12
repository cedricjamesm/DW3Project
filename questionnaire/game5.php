<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link rel="stylesheet" href="../css/games.css">
</head>

<body>
    <h1>WELCOME TO OUR FUN GAME</h1>
    <h2>HERE'S THE FIFTH GAME</h2>

    <div class="form5">
        <p>Lives: <span id="lives">6</span></p>
        <form name="myForm5" action="GET">
            <label for="question5">Question 5. Write the smallest and largest letter!</label><br>
            <label>Use the following format A A</label><br>
            <label for="question5" id="letterOrder"></label><br>

            <input type="text" id="game5" name="question5" placeholder="Write here"><br>
            <button type="button" onclick="checkSorting()">Submit</button>
            <button type="button" onclick="cancelGame()">Cancel</button>
        </form>
    </div>

    <script>
        var lives = parseInt(sessionStorage.getItem('lives')) || 6;
        document.getElementById('lives').textContent = lives;

        var correctOrder;

        function generateRandomLetters() {
            var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var randomLetters = '';
            for (var i = 0; i < 6; i++) {
                var randomIndex = Math.floor(Math.random() * letters.length);
                randomLetters += letters[randomIndex];
                letters = letters.slice(0, randomIndex) + letters.slice(randomIndex + 1);
            }
            var smallestLetter = randomLetters.split('').sort()[0];
            var largestLetter = randomLetters.split('').sort()[randomLetters.length - 1];
            correctOrder = smallestLetter + ' ' + largestLetter;
            document.getElementById('letterOrder').textContent = randomLetters.split('').join(' ');
        }

        function checkSorting() {
            var userInput = document.getElementById('game5').value.trim().toUpperCase();
            if (userInput === correctOrder) {
                alert("Congratulations! You sorted the letters correctly. ");
                window.location.href = 'game6.php';
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
            generateRandomLetters();
        };
    </script>

</body>

</html>
