let playerTurn = true;
let computerMoveTimeout = 0;

const gameStatus = {
  MORE_MOVES_LEFT: 1,
  HUMAN_WINS: 2,
  COMPUTER_WINS: 3,
  DRAW_GAME: 4,
};

window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
  const newBtn = document.getElementById("newGameButton");
  newBtn.addEventListener("click", newGame);

  const buttons = getGameBoardButtons();
  for (let button of buttons) {
    button.addEventListener("click", function () {
      boardButtonClicked(button);
    });
  }
  newGame();
}

function getGameBoardButtons() {
  return document.querySelectorAll("#gameBoard > button");
}

function newGame() {
  clearTimeout(computerMoveTimeout);
  computerMoveTimeout = 0;

  const buttons = getGameBoardButtons();
  for (let button of buttons) {
    button.innerHTML = "";
    button.classList.remove("x", "o");
    button.removeAttribute("disabled");
  }

  playerTurn = true;

  document.getElementById("turnInfo").innerHTML = "Your turn";
}

function boardButtonClicked(button) {
  if (playerTurn) {
    button.innerHTML = "X";
    button.classList.add("x");
    button.disabled = true;
    switchTurn();
  }
}

function switchTurn() {
  const result = checkForWinner();

  if (result === gameStatus.MORE_MOVES_LEFT) {
    if (playerTurn) {
      document.getElementById("turnInfo").innerHTML = "Computer's turn...";
      computerMoveTimeout = setTimeout(makeComputerMove, 1000);
    } else {
      document.getElementById("turnInfo").innerHTML = "Your turn";
    }

    // toggle playerTurn
    playerTurn = !playerTurn;
  } else {
    playerTurn = false;
    let message = "";

    if (result === gameStatus.HUMAN_WINS) {
      message = "You win!";
    } else if (result === gameStatus.COMPUTER_WINS) {
      message = "Computer wins!";
    } else {
      message = "It's a draw!";
    }

    document.getElementById("turnInfo").innerHTML = message;
  }
}

function makeComputerMove() {
  const buttons = getGameBoardButtons();
  let availableIndices = [];

  buttons.forEach((btn, index) => {
    if (btn.innerHTML === "") {
      availableIndices.push(index);
    }
  });

  if (availableIndices.length > 0) {
    const randomIndex =
      availableIndices[Math.floor(Math.random() * availableIndices.length)];
    const selectedButton = buttons[randomIndex];

    selectedButton.innerHTML = "O";
    selectedButton.classList.add("o");
    selectedButton.disabled = true;

    switchTurn();
  }
}

function checkForWinner() {
  const buttons = getGameBoardButtons();

  const possibilities = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8], // rows
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8], // columns
    [0, 4, 8],
    [2, 4, 6], // diagonals
  ];

  for (let p of possibilities) {
    const [a, b, c] = p;
    if (
      buttons[a].innerHTML !== "" &&
      buttons[a].innerHTML === buttons[b].innerHTML &&
      buttons[b].innerHTML === buttons[c].innerHTML
    ) {
      return buttons[a].innerHTML === "X"
        ? gameStatus.HUMAN_WINS
        : gameStatus.COMPUTER_WINS;
    }
  }

  const isDraw = Array.from(buttons).every((button) => button.innerHTML !== "");
  if (isDraw) {
    return gameStatus.DRAW_GAME;
  }

  return gameStatus.MORE_MOVES_LEFT;
}
