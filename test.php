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