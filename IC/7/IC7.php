<?php
// Mission 1
function isEligibleToVote($age = 18)
{
    if ($age >= 18) {
        return "You are eligible to vote.";
    }
    return "You are not eligible to vote.";
}

echo isEligibleToVote(20) . "<br>";
echo isEligibleToVote(16) . "<br>";

echo isEligibleToVote() . "<br>";
?>



<?php
// Mission 2
function calculateArea($length, $width)
{
    return $length * $width;
}

$area = calculateArea(7.4, 7.5);

if (is_numeric($area)) {
    echo "The area of the room is: " . $area . " sq ft" . "<br>";
} else {
    echo $area;
}


?>


<?php
// Mission 3
function isBitten()
{
    return rand(0, 1) === 1;
}

if (isBitten()) {
    echo "Charlie bit your finger!";
} else {
    echo "Charlie did not bite your finger!";
}

echo "<br>";

$winner = "Charlie";

function displayWinner()
{
    global $winner;
    echo "Winner: " . $winner;
}

displayWinner();
?>