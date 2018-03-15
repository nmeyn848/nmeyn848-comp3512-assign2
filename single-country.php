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
                
                    #if ($statement->rowCount() > 0){ 
                    while ($record = $statement -> fetch()){
                        echo "<div class='col-md-1'><a href='single-image.php?id=".$record["ImageID"]." class='img-responsive'><img src='/images/square-small/".$record["Path"]."'></a></div>";
                        
                    }
                    echo "</div></div></div>";
                }else{
                    header('Location: error.php');
                }
            ?>
        </div>
        <?php 
               $sql = "SELECT c.Latitude, c.Longitude FROM ImageDetails AS i JOIN Cities AS c On c.CityCode=i.CityCode WHERE i.CountryCodeISO= :iso";
               $statement = $pdo->prepare($sql);
               $statement->bindValue(':iso',$_GET["id"]);
               $statement->execute();
               $record = $statement -> fetch();
               
        ?>
        <div id="map" class="col-md-4">
            <script>
                var latte = "<?php echo $record['CountryName']; ?>";
                function initMap() {
                var uluru = {latte};
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 4,
                  center: uluru
                });
                var marker = new google.maps.Marker({
                  position: uluru,
                  map: map
                });
              }
            </script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuI02Z5KzIBl3jXFKnqK32QjOpWxpy5II&callback=initMap">
            </script>
        </div>
    </div>
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>

</html>