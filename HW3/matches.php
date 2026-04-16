<!DOCTYPE html>
<html>
    <head>
        <title>Matches</title>
        <link href="nerdieluv.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php include("common.php"); banner(); ?>
        <form action="matches-submit.php" method="get">
            <fieldset>
                <legend>Returning User:</legend>
                <ul>
                    <li><strong>Name:</strong> <input type="text" name="name" size="16" /></li>
                </ul>
                <input type="submit" value="View My Matches" />
            </fieldset>
        </form>
        <?php footer(); ?>
    </body>
</html>