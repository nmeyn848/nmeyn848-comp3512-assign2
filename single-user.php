<!DOCTYPE html>
<html>
<head>
    <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php"; ?>
</head>
<body>
    
    <?php //taken from labs 
        include "includes/header.inc.php"; ?>
    <div class="container">
        <div class="jumbotron">
            <?php 
               $sql = "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email FROM Users WHERE UserId= :user";
               $statement = $pdo->prepare($sql);
               $statement->bindValue(':user',$_GET["id"]);
               $statement->execute(); 
                
                if ($statement->rowCount() > 0){ 
                    while ($record = $statement -> fetch()){
                        $fname = $record["FirstName"];
                        $lname = $record["LastName"];
                        echo "<h2>".$record["FirstName"]." ".$record["LastName"]."</h2>";
                        echo "<p>".$record["Address"]."<p>";
                        echo "<p>".$record["City"].", ".$record["Region"].", ".$record["Postal"].", ".$record["Country"]."<p>";
                        echo "<p>".$record["Phone"]."<p>";
                        echo "<p>".$record["Email"]."<p></div>";
                        echo "<div class='panel panel-info'> <div class='panel-heading'>Images from ".$record["FirstName"]." ".$record["LastName"]."</div><div class='panel-body'><div class='row'>";
                    }
                }else{
                    header('Location: error.php');
                }
               
            
             
                $sql = "SELECT ImageID, Path, Title, UserID FROM ImageDetails WHERE UserID= :user";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(':user',$_GET["id"]);
                $statement->execute(); 
                
                
                if ($statement->rowCount() > 0){ 
                    while ($record = $statement -> fetch()){
                        echo "<div class='col-md-1'><a href='single-image.php?id=".$record["ImageID"]." class='img-responsive'><img src='/images/square-small/".$record["Path"]."'></a></div>";
                        
                    }
                    echo "</div></div></div>";
                }else{
                    header('Location: error.php');
                }
            echo "</div>";
            //taken from labs 
            include "includes/footer.inc.php"; ?>
</body>

</html>