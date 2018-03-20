<!DOCTYPE html>
<html>
<head>
    <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php";
        $countriesDB = new CountriesGateway($connection);
        $imagesDB = new ImagesGateway($connection);
        ?>
   <script type="text/javascript">
   
        function imgHover(id){
            id.style.height = "150px";
            id.style.width = "150px";

        }

        function imgOut(id) {
            id.style.height = "75px";
            id.style.width = "75px";;
           
        }
        
        
        
      

   </script>
</head>
<body>
    
    <?php //taken from labs 
        include "includes/header.inc.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    
                    <?php 
                        /* Displays a specific country */
                        $country = $countriesDB->findById($_GET["id"]);
                        
                        echo "<h2>".$country["CountryName"]."</h2>";
                        echo "<p>Capital: <b>".$country["Capital"]."</b></p>";
                        echo "<p>Area: <b>".$country["Area"]."</b> sq km.</p>";
                        echo "<p>Population: <b>".$country["Population"]."</b></p>";
                        echo "<p>Currency Name: <b>".$country["CurrencyName"]."</b></p>";
                        echo "<p>".$country["CountryDescription"]."</p></div>";
                        echo "<div class='panel panel-info'> <div class='panel-heading'>Images from ".$country["CountryName"]."</div><div class='panel-body'><div class='row'>";
                    
                         
                        $images = $imagesDB->findByNonPrimaryID("CountryCodeISO", $_GET["id"]);
                               
                        foreach($images as $image){
                            echo '<div id="image-'.$image["ImageID"].'" class="col-md-2"><a href="single-image.php?id='.$image["ImageID"].'"><img onmouseover="imgHover(this)" onmouseout="imgOut(this)" src="/images/square-small/'.$image["Path"].'" class="img-responsive"></a></div>';
                        }
                        echo "</div></div></div></div>";
                        
                        echo '<div id="map" class="col-md-4">';
                        
                        $country = $countriesDB->findById($_GET["id"]);
                    
                        $countryName = str_replace(" ", "+", $country["CountryName"]);
                        
                        echo '<img width="350" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=350x350&maptype=roadmap&key=AIzaSyA0EMFsHYc8wInAlb7MTtVvNALfdZwLR7Q&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7C'.$countryName.'">';
                        echo "</div></div></div>";
                        
                        $images = $imagesDB->findByNonPrimaryID("CountryCodeISO", $_GET["id"]);
                        
                        // foreach($images as $image){
                        //     echo '<div id="hover-'.$image["ImageID"].'" class="hover-image" style="visibility:hidden; position:absolute"><img src="/images/square-medium/'.$image["Path"].'" class="img-responsive">'.$image["Title"].'</div>'; 
                        // }
                    ?>
    
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>
</html>
