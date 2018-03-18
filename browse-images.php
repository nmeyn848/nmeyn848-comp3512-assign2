
<!DOCTYPE html>
<html>
<head>
    <title>Assign 1 (Winter 2018)</title>
    <?php //taken from labs 
        include "includes/css.inc.php"; 
        include "includes/db_config.inc.php"; 
        $continentsDB = new ContinentsGateway($connection);
        $countriesDB = new CountriesGateway($connection);
        $citiesDB = new CitiesGateway($connection);
        $imagesDB = new ImagesGateway($connection)
        ?>
</head>
<body>
    
    <?php //taken from labs 
        include "includes/header.inc.php";
    ?>
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="browse-images.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select  name="continent" class="form-control" onchange="this.form.submit()">
                <option value="0">Select Continent</option>
                <?php /* display list of continents */ 
                   
                  $result = $continentsDB->findAll();

                  foreach($result as $continent){
                    
                    echo '<option value='.$continent["ContinentCode"].'>';
                    echo $continent["ContinentName"];
                    echo "</option>";
                        
                  }
                ?>
              </select>     
              
              <select name="country" class="form-control" onchange="this.form.submit()" >
                <option value="0">Select Country</option>
                <?php /* display list of countries */ 
                
                  //$sql ="SELECT c.CountryName, c.ISO FROM Countries c INNER JOIN ImageDetails i ON c.ISO=i.CountryCodeISO GROUP BY c.ISO ORDER BY c.CountryName";
                  //$result = $pdo-> query($sql);
                  
                  $result = $countriesDB->findViaJoin("country");

                  foreach($result as $country){
                        
                    echo '<option value='.$country["ISO"].'>';
                    echo $country["CountryName"];
                    echo "</option>";
                          
                  }
                ?>
              </select> 
              <select name="city" class="form-control" onchange="this.form.submit()" >
                <option value="0">Select City</option>
                <?php /* display list of countries */ 
                
                  $result = $citiesDB->findViaJoin("city");

                  foreach($result as $city){
                          
                    echo '<option value='.$city["CityCode"].'>';
                    echo $city["AsciiName"];
                    echo "</option>";
                          
                  }
                ?>
              </select>   
              <input type="text"  placeholder="Search title" class="form-control" name=title onchange="this.form.submit()" >
              </div>
            </form>

          </div>
        </div>     
                                    
        <div class="panel panel-default">
            <?php 
              
              /*Checking type of filter*/ 
                if(!empty($_GET["country"])){
                  
                  $result = $imagesDB->findByNonPrimaryID("CountryCodeISO", $_GET["country"]);
                  
                  // $country= $_GET["country"];
                  // $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE CountryCodeISO= :code";
                  // $statement = $pdo->prepare($sql);
                  // $statement->bindValue(':code',$country);
                  
                  echo '<div class="panel-heading">Images [Country = '.$_GET["country"].']</div> <div class="panel-body">';
                
                }else if(!empty($_GET["continent"])){
                  
                  $result = $imagesDB->findByNonPrimaryID("ContinentCode", $_GET["continent"]);
                  
                  // $continent= $_GET["continent"];
                  // $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE ContinentCode= :code";
                  // $statement = $pdo->prepare($sql);
                  // $statement->bindValue(':code',$continent);
                  
                  echo '<div class="panel-heading">Images [Continent = '.$_GET["continent"].']</div> <div class="panel-body"> ';
                }else if (!empty($_GET["city"])){
                  
                  $result = $imagesDB->findByNonPrimaryID("CityCode", $_GET["city"]);
                  
                  // $city= $_GET["city"];
                  // $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE CityCode= :code";
                  // $statement = $pdo->prepare($sql);
                  // $statement->bindValue(':code',$city);
                  
                  echo '<div class="panel-heading">Images [City = '.$_GET["city"].']</div> <div class="panel-body">';
                }else if (!empty($_GET["title"])){
                  
                  $title= $_GET["title"];
                  $titleWC = "%$title%";
                  
                  $result = $imagesDB->findByNonPrimaryID("Title", $titleWC);
                  
                  // $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE Title LIKE :code";
                  // $statement = $pdo->prepare($sql);
                  // $statement->bindValue(':code',$title);
                  
                  echo '<div class="panel-heading">Images [Title Like '.$_GET["title"].']</div><div class="panel-body">';
                }else{
                  
                  $result = $imagesDB->findAll();
                  
                  // $sql ="SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails";
                  // $statement = $pdo->prepare($sql);
                  
                }
                // $statement->execute(); 
                //if ($statement->rowCount() > 0){ 
                  
                  echo '<div class="row">';
                  
                  foreach($result as $image){
                    
                    echo '<ul class="caption-style-2">';
                    echo '<div class="col-md-2"><li><a href="single-image.php?id='.$image["ImageID"].'" class="img-responsive">';
                    echo '<img src="images/square-medium/'.$image["Path"].'" alt="'.$image["Title"].'">';
                    echo '<div class="caption">';
                    echo '<div class="blur"></div>';
                    echo '<div class="caption-text">';
                    echo '<p>'.$image["Title"].'</p>';
                    echo '</div></div></div></a></li>'; 
                    
                  }
                  
                  echo '</ul> </div><div>';
                  
                // }else{
                  
                //     header('Location: error.php');
                    
                // }
              echo '<div>';
             ?>
            
      </main>
       <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
    
</body>
<script>
  // var form = document.getElementById("filter-images");
  
  // document.getElementById("filter-images").addEventListener("onchange", function () {
  //   form.submit();
  // });
  // var filter = document.getElementByTagName('select');
  // for (i = 0; i < y.length; i++) {
  //   filter[i].submit();
  //   // addEventListener('click',function(event) {
  //   //   event.preventDefault();
      
  //   //   }
  //   // );

</script>
</html>