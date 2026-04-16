# Logic Design and Algorithms:
For the range check in the guessing game, I used an if-statement that checks if the input value is less than 1 or greater than 100 before the game processes the guess.
If the number is out of range, it triggers an alert and uses a return statement to stop the function so the player doesn't lose a turn.


The guess feedback logic compares the user's integer input to the secret number variable. If the input is higher than the secret number, the DOM textContent is updated to say Too High.
If it is lower, it updates to say Too Low. If they match, it triggers the win sequence.

The restart conditions are handled by an initGame function. This function is called when the page first loads, when the player correctly guesses the number, or when the guess limit reaches zero. 
It resets the secret number using Math.random and resets the guess counter back to 10 while keeping the total wins and rounds played saved in global variables.


# Edge-Case Tests:

Non-Numeric Input: I tested entering letters and symbols into the guess box. 
The code uses isNaN to detect this and prevents the game from counting it as a valid guess, which keeps the guess limit from decreasing unfairly.

Boundary Values: I tested the numbers 1 and 100 specifically. I had to ensure my random number generator used Math.floor and added 1 at the end to make sure 100 was actually reachable and that 0 was excluded.


# Bug Log:
Bug: Initially, the memory game leaderboard would disappear every time I refreshed the page, even if I had already saved scores.
Fix: I realized I was initializing the leaderboard as an empty array at the top of the script. I fixed this by changing the code to first check localStorage.getItem for any existing data. If data exists, it parses that JSON instead of starting with an empty list.