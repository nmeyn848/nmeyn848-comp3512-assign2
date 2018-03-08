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
                            $sql = "SELECT i.ImageID, i.UserID, i.Title, i.Description, i.Path, u.FirstName, u.LastName, i.CountryCodeISO, c.CountryName, c.ISO, ct.AsciiName, ct.CityCode FROM ImageDetails AS i JOIN Users AS u ON i.UserID=u.UserID JOIN Countries AS c ON i.CountryCodeISO=c.ISO JOIN Cities AS ct ON ct.CityCode=i.CityCode WHERE ImageID= :id";
                            $statement = $pdo->prepare($sql);
                            $statement->bindValue(':id',$_GET["id"]);
                            $statement->execute();
                            
                            if ($statement->rowCount() > 0){ 
                                while ($record = $statement -> fetch()){
                                    echo '<img class="img-responsive" src="images/medium/'.$record["Path"].'" alt="'.$record["Title"].'"/><p>'.$record["Description"].'</p>';
                                    echo '</div>';
                                    echo '<div class ="col-md-4">';
                                    echo '<h2>'.$record[Title].'</h2><div class="panel panel-default"><div class="panel-body"><ul class="details-list">';
                                    echo '<li class="list-group-item">By: <a href="single-user.php?id='.$record["UserID"].'">'.$record["FirstName"].' '.$record["LastName"].'</a></li>';
                                    echo '<li class="list-group-item">Country : <a href="single-country.php?id='.$record["CountryCodeISO"].'">'.$record["CountryName"].'</a></li>';
                                    echo '<li class="list-group-item">City: '.$record["AsciiName"].'</a></li></ul></div></div>';
                                    
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
                        </div>
                    </div>
        </div>
    </main>
    <?php 
        include "includes/footer.inc.php";
    ?>
</body>

</html>
