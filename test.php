<?php

include 'includes/db_config.inc.php';

?>

<html>
    <body>
        <?php
        $db = new PostsGateway($connection);
        $result = $db->findById(3);
        echo "Post ID: ".$result['PostID'] . ' Title: ' . $result['Title'];
        echo "<br>" . $result['Message'];
        ?>
    </body>
</html>


git add *;
git commmit -m "your message";
git remote rm origin;
git remote add origin https://github.com/nmeyn848/nmeyn848-comp3512-assign2;
git push -u origin master