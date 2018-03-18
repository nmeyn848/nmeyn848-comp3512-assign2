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
                        $result = $db->findViaJoin("u");
                        $images = $db->findViaJoin("i");
                        foreach($images as $image) {
                            echo "<div class='col-md-2'><img src='images/square-medium/" . $image['Path'] . "'/></div>";
                            foreach($result as $post) {
                                if($image['PostID'] == $post['PostID']) {
                                    echo "<div class='col-md-10'><h2>".$post['Title']."</h2><br>";
                                echo "<p>Posted By: " . $post['FirstName'] . " " . $post['LastName'] . "<span class='pull-right'>";
                                echo $post['PostTime']."</span></p>";//fix date formatting
                                echo "<p>".substr($post['Message'],0,200)."...</p>";
                                echo "<a href='single-post.php?id=" . $post['PostID'] . "'>Read More</a>"; //add a link to single-post + button design
                                echo "</div>";
                                }
                            
                            }
                        } 
                        
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>

</html>