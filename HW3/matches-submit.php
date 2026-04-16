<!DOCTYPE html>
<html>
    <head>
        <title>Matches Results</title>
        <link href="nerdieluv.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php 
        include("common.php"); 
        banner(); 

        $userName = $_GET["name"];
        
        /* 1. Read and combine both data files into one array */
        $file1 = file("singles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $file2 = file("singles2.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $users = array_merge($file1, $file2);
        
        $me = null;

        /* 2. Find the logged-in user's profile to get their preferences */
        foreach ($users as $line) {
            $data = explode(",", $line);
            if ($data[0] == $userName) {
                $me = $data;
                break;
            }
        }
        ?>

        <h1>Matches for <?= $userName ?></h1>

        <?php
        /* 3. Filter and display matches from the combined list */
        foreach ($users as $line) {
            $m = explode(",", $line);
            
            // Skip the user's own profile in the results
            if ($m[0] == $userName) { continue; }

            // Criteria 1: Opposite Gender
            $diff_gender = ($m[1] != $me[1]);

            // Criteria 2: Same Favorite OS
            $same_os = ($m[4] == $me[4]);

            // Criteria 3: Compatible Ages (Mutual between both users)
            $age_compat = ($m[2] >= $me[5] && $m[2] <= $me[6] && 
                           $me[2] >= $m[5] && $me[2] <= $m[6]);
            
            // Criteria 4: Personality (At least one letter match at same index)
            $personality_match = false;
            for ($i = 0; $i < 4; $i++) {
                if ($m[3][$i] == $me[3][$i]) {
                    $personality_match = true;
                    break;
                }
            }

            // If all conditions pass, display the match
            if ($diff_gender && $same_os && $age_compat && $personality_match) { ?>
                <div class="match">
                    <p>
                        <img src="user.jpg" alt="user icon" /> 
                        <?= $m[0] ?>
                    </p>
                    <ul>
                        <li><strong>gender:</strong> <?= $m[1] ?></li>
                        <li><strong>age:</strong> <?= $m[2] ?></li>
                        <li><strong>type:</strong> <?= $m[3] ?></li>
                        <li><strong>OS:</strong> <?= $m[4] ?></li>
                    </ul>
                </div>
            <?php }
        }
        footer(); 
        ?>
    </body>
</html>