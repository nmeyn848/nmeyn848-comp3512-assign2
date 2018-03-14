<!DOCTYPE html>
<html>
<head>
    <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php"; 
        $db = new PostsGateway($connection); ?>
</head>
<body>
    
    <?php //taken from labs 
        include "includes/header.inc.php"; ?>
    <div class="container">
        <div class='panel panel-info'>
            <div class="panel panel-heading">Posts</div>
                <div class='panel-body'>
                    <div class='row'>
                    <?php
                        $result = $db->findById(1);
                        echo "Post Time: ".$result['PostTime'];
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>

</html>