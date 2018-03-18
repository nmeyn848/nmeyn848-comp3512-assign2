<?php
    function setFavPost($id) {
        include "includes/db_config.inc.php";
        $db = new PostsGateway($connection);
        $records = $db->findViaJoin('i');
        foreach($records as $post) {
            if($id == $post['PostID']) {
                $fav = unserialize($_COOKIE['fav']);
                array_push($fav, 'post', $post['ImageID'], $post['Title'], $post['PostID']);
                setCookie('fav', serialize($fav), 0);
            }
        }
        $fav = unserialize($_COOKIE['fav']);
        foreach ($fav as $f) {
            echo $f;
        }
    }
?>