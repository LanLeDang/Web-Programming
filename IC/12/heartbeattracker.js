let heartState = {
  x: 22,
  y: 22,
  targetX: 22,
  targetY: 22,
  speed: 5,
  moving: false,
};

const heart = document.getElementById("heart");
const stage = document.getElementById("heartbeatStage");
const speedRange = document.getElementById("speedRange");
const resetBtn = document.getElementById("resetHeartBtn");

function clamp(val, min, max) {
  return Math.max(min, Math.min(max, val));
}

function updateHeartPosition() {
  heart.style.left = heartState.x + "px";
  heart.style.top = heartState.y + "px";
}

function animateHeart() {
  let dx = heartState.targetX - heartState.x;
  let dy = heartState.targetY - heartState.y;
  let distance = Math.sqrt(dx * dx + dy * dy);

  if (distance < 1) {
    heartState.x = heartState.targetX;
    heartState.y = heartState.targetY;
    heartState.moving = false;
  } else {
    heartState.x += (dx / distance) * heartState.speed;
    heartState.y += (dy / distance) * heartState.speed;

    requestAnimationFrame(animateHeart);
  }
  updateHeartPosition();
}

stage.addEventListener("click", function (event) {
  const rect = stage.getBoundingClientRect();

  let clickX = event.clientX - rect.left - heart.offsetWidth / 2;
  let clickY = event.clientY - rect.top - heart.offsetHeight / 2;

  heartState.targetX = clamp(clickX, 0, stage.clientWidth - heart.offsetWidth);
  heartState.targetY = clamp(
    clickY,
    0,
    stage.clientHeight - heart.offsetHeight
  );

  if (!heartState.moving) {
    heartState.moving = true;
    animateHeart();
  }
});

speedRange.addEventListener("input", function () {
  heartState.speed = Number(speedRange.value);
});

resetBtn.addEventListener("click", function () {
  heartState.moving = false;
  heartState.x = 22;
  heartState.y = 22;
  heartState.targetX = 22;
  heartState.targetY = 22;
  updateHeartPosition();
});

updateHeartPosition();
