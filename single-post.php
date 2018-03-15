<!DOCTYPE  html>
<html>
<head>
     <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php"; ?>
</head>

<body>
    <?php include "includes/header.inc.php";?>
    <main class="container">
        <div class="row">
            <?php include "includes/left.inc.php"; ?>
               <div class="col-md-10">
                    <div class="col-md-8">
                         <?php 
                            $sql = " SELECT p.PostID, p.Title, p.Message, p.PostTime, p.MainPostImage, u.FirstName, u.LastName, i.Path FROM Posts AS p JOIN Users AS u ON p.UserID = u.UserID JOIN ImageDetails i ON p.MainPostImage = i.ImageID WHERE PostID = :id";
                            $statement = $pdo->prepare($sql);
                            $statement->bindValue(':id',$_GET["id"]);
                            $statement->execute();
                            
                            if ($statement->rowCount() > 0){ 
                                while ($record = $statement -> fetch()){
                                    echo '<img class="img-responsive" src="images/medium/'.$record["Path"].'" alt="'.$record["Title"].'"/><p>'.$record["Message"].'</p>';
                                    echo '</div>';
                                    echo '<div class ="col-md-4">';
                                    echo '<h2>'.$record[Title].'</h2><div class="panel panel-default"><div class="panel-body"><ul class="details-list">';
                                    echo '<li class="list-group-item">By: <a href="single-user.php?id='.$record["UserID"].'">'.$record["FirstName"].' '.$record["LastName"].'</a></li>';
                                    echo '<li class="list-group-item">Posted on: '.$record["PostTime"].'</a></li></ul></div></div>';
                                    
                                }
                            }else{
                                header('Location: error.php');
                            }
                        ?>
                        <!-- taken from labs -->
                            <div class="btn-group btn-group-justified" roll="group">
                                <div class="btn-group" roll="group">
                                    <button class ="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span></button>
                                </div>
                                <div class="btn-group" roll="group">
                                    <button class ="btn btn-default" type="button"><span class="glyphicon glyphicon-save"></span></button>
                                </div>
                                <div class="btn-group" roll="group">
                                    <button class ="btn btn-default" type="button"><span class="glyphicon glyphicon-print"></span></button>
                                </div>
                                <div class="btn-group" roll="group">
                                    <button class ="btn btn-default" type="button"><span class="glyphicon glyphicon-comment"></span></button>
                                </div>
                            </div>
                            <div class="panel panel-default">
                            <h3>Related Pictures</h3>
                            <?php
                                $sql = " SELECT pi.PostID, i.Title, i.ImageID, i.Path FROM PostImages AS pi JOIN ImageDetails AS i ON pi.ImageID = i.ImageID JOIN Posts AS p ON p.PostID = pi.PostID WHERE pi.ImageID != p.MainPostImage AND pi.PostID = :id";
                                $statement = $pdo->prepare($sql);
                                $statement->bindValue(':id',$_GET["id"]);
                                $statement->execute();
                                
                                if ($statement->rowCount() > 0){ 
                                    while ($record = $statement -> fetch()){
                                        echo '<img class="img-responsive" src="images/medium/'.$record["Path"].'" alt="'.$record["Title"].'"/>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
        </div>
    </main>
    <?php 
        include "includes/footer.inc.php";
    ?>
</body>

</html>
