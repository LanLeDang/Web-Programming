let secretNumber,
  guessesLeft = 10,
  wins = 0,
  rounds = 0;

function initGame() {
  secretNumber = Math.floor(Math.random() * 100) + 1;
  guessesLeft = 10;
  document.getElementById("feedback").textContent = "New game! Guess a number.";
  updateStats();
}

function handleGuess() {
  const input = document.getElementById("guess-input");
  const val = parseInt(input.value);

  // edge case
  if (isNaN(val) || val < 1 || val > 100) {
    alert("Please enter a number between 1 and 100.");
    return;
  }

  guessesLeft--;

  if (val === secretNumber) {
    wins++;
    rounds++;
    new Audio("win.mp3").play().catch(() => {});
    alert("Correct! You won!");
    initGame();
  } else if (guessesLeft === 0) {
    rounds++;
    new Audio("lose.mp3").play().catch(() => {});
    alert("Out of guesses! The number was " + secretNumber);
    initGame();
  } else {
    document.getElementById("feedback").textContent =
      val > secretNumber ? "Too High!" : "Too Low!";
  }

  updateStats();
  input.value = "";
}

function updateStats() {
  document.getElementById("stats").textContent =
    `Guesses Left: ${guessesLeft} | Wins: ${wins} | Rounds: ${rounds}`;
}

setInterval(() => {
  document.getElementById("clock").textContent =
    new Date().toLocaleTimeString();
}, 1000);

document.getElementById("guess-btn").addEventListener("click", handleGuess);
window.onload = initGame;
