let cards = [],
  flipped = [],
  score = 0,
  timeLeft,
  gameInterval;

function startGame() {
  const pairCount = parseInt(document.getElementById("pairs").value);
  const diff = parseInt(document.getElementById("diff").value);
  const icons = [
    "🍎",
    "🍌",
    "🍇",
    "🍓",
    "🍒",
    "🍍",
    "🥝",
    "🍋",
    "🍐",
    "🫐",
    "🍈",
    "🍊",
  ].slice(0, pairCount);

  cards = [...icons, ...icons].sort(() => Math.random() - 0.5);
  score = 0;
  timeLeft = pairCount === 8 ? 120 : pairCount === 10 ? 150 : 180;
  render(true);

  setTimeout(() => {
    render(false);
    startCountdown();
  }, diff * 1000);
}

function render(show) {
  const grid = document.getElementById("game-grid");
  grid.innerHTML = "";
  cards.forEach((icon, i) => {
    const div = document.createElement("div");
    div.className = "card";
    div.innerHTML = show ? icon : i + 1;
    div.onclick = () => !show && handleFlip(i, div);
    grid.appendChild(div);
  });
}

function handleFlip(i, el) {
  if (flipped.length < 2 && !el.classList.contains("matched")) {
    el.innerHTML = cards[i];
    flipped.push({ i, el });
    if (flipped.length === 2) checkMatch();
  }
}

function checkMatch() {
  const [a, b] = flipped;
  if (cards[a.i] === cards[b.i]) {
    score += 10;
    a.el.classList.add("matched");
    b.el.classList.add("matched");
    flipped = [];
  } else {
    score -= 5;
    setTimeout(() => {
      a.el.innerHTML = a.i + 1;
      b.el.innerHTML = b.i + 1;
      flipped = [];
    }, 1000);
  }
  document.getElementById("current-score").textContent = score;
}

function startCountdown() {
  clearInterval(gameInterval);
  gameInterval = setInterval(() => {
    timeLeft--;
    if (timeLeft < 0) score--; // penalty
    document.getElementById("timer").textContent = timeLeft;
    if (document.querySelectorAll(".matched").length === cards.length) {
      clearInterval(gameInterval);
      saveScore();
    }
  }, 1000);
}

function saveScore() {
  const name = prompt("Game Over! Enter name:") || "Player";
  let board = JSON.parse(localStorage.getItem("scores")) || [];
  board.push({ name, score });
  board.sort((a, b) => b.score - a.score);
  localStorage.setItem("scores", JSON.stringify(board.slice(0, 5)));
  showBoard();
}

function showBoard() {
  const list = document.getElementById("scores-list");
  const board = JSON.parse(localStorage.getItem("scores")) || [];
  list.innerHTML = board.map((s) => `<li>${s.name}: ${s.score}</li>`).join("");
}
window.onload = showBoard;
