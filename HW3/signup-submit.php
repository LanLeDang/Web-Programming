<?php
    $user_data = [
        $_POST["name"], $_POST["gender"], $_POST["age"], 
        $_POST["type"], $_POST["os"], $_POST["min"], $_POST["max"]
    ];
    $line = implode(",", $user_data) . "\n";
    file_put_contents("singles.txt", $line, FILE_APPEND);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup Submitted</title>
        <link href="nerdieluv.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php include("common.php"); banner(); ?>
        <h1>Thank you!</h1>
        <p>Welcome to NerdLuv, <?= $_POST["name"] ?>!</p>
        <p>Now <a href="matches.php">log in to see your matches!</a></p>
        <?php footer(); ?>
    </body>
</html>