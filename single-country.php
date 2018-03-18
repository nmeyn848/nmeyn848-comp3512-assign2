<!DOCTYPE html>
<html>
<head>
    <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php"; ?>
    <style>
        #map {
            height: 350px;
            width: 350px;
        }
    </style>
</head>
<body>
    
    <?php //taken from labs 
        include "includes/header.inc.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    
                    <?php 
                        $sql = "SELECT CountryName, Capital, Area, Population, CurrencyName, CountryDescription FROM Countries WHERE ISO= :iso";
                        $statement = $pdo->prepare($sql);
                        $statement->bindValue(':iso',$_GET["id"]);
                        $statement->execute(); 
                        
                        if ($statement->rowCount() > 0){ 
                            while ($record = $statement -> fetch()){
                                echo "<h2>".$record["CountryName"]."</h2>";
                                echo "<p>Capital: <b>".$record["Capital"]."</b></p>";
                                echo "<p>Area: <b>".$record["Area"]."</b> sq km.</p>";
                                echo "<p>Population: <b>".$record["Population"]."</b></p>";
                                echo "<p>Currency Name: <b>".$record["CurrencyName"]."</b></p>";
                                echo "<p>".$record["CountryDescription"]."</p></div>";
                                echo "<div class='panel panel-info'> <div class='panel-heading'>Images from ".$record["CountryName"]."</div><div class='panel-body'><div class='row'>";
                            }
                                
                            $sql = "SELECT ImageID, Path, Title, CountryCodeISO FROM ImageDetails WHERE CountryCodeISO= :iso";
                            $statement = $pdo->prepare($sql);
                            $statement->bindValue(':iso',$_GET["id"]);
                            $statement->execute(); 
                        
                            if ($statement->rowCount() > 0){ 
                                while ($record = $statement -> fetch()){
                                    echo "<div class='col-md-2'><a href='single-image.php?id=".$record["ImageID"]." class='img-responsive'><img src='/images/square-small/".$record["Path"]."'></a></div>";
                                    
                                }
                            echo "</div></div></div></div>";
                            }else{
                                header('Location: error.php');
                            }
                        }
                  
                        echo '<div id="map" class="col-md-4">';
                        
                            $sql = "SELECT ISO, CountryName, Area FROM Countries WHERE ISO= :iso";
                            $statement = $pdo->prepare($sql);
                            $statement->bindValue(':iso',$_GET["id"]);
                            $statement->execute();
                            
                            echo '<img width="350" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=350x350&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7C'.getCountry($statement).'">';

                            function getCountry($statement){    
                                if ($statement->rowCount() > 0){ 
                                    while ($record = $statement -> fetch()){
                                        $countryCentreMap = str_replace(" ", "+", $record["CountryName"]);
                                        return $countryCentreMap;
                                    }
                                }else{
                                    header('Location: error.php');
                                }
                            }
                    ?>
                </div>
        </div>
    </div>
    
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>
</html>