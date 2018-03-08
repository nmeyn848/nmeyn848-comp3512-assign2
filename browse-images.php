
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
        include "includes/header.inc.php";
    ?>
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="browse-images.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php /* display list of continents */ 
                   
                  $sql ="SELECT ContinentName, ContinentCode FROM Continents";
                  $result = $pdo-> query($sql);

                  while ($record = $result -> fetch()){
                    
                    echo '<option value='.$record["ContinentCode"].'>';
                    echo $record["ContinentName"];
                    echo "</option>";
                        
                  }
                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php /* display list of countries */ 
                
                  $sql ="SELECT c.CountryName, c.ISO FROM Countries c INNER JOIN ImageDetails i ON c.ISO=i.CountryCodeISO GROUP BY c.ISO ORDER BY c.CountryName";
                  $result = $pdo-> query($sql);
                      
                  while ($record = $result -> fetch()){
                        
                  echo '<option value='.$record["ISO"].'>';
                  echo $record["CountryName"];
                  echo "</option>";
                        
                  }
                ?>
              </select> 
              <select name="city" class="form-control">
                <option value="0">Select City</option>
                <?php /* display list of countries */ 
                
                  $sql ="SELECT c.AsciiName, c.CityCode FROM Cities c INNER JOIN ImageDetails i ON c.CityCode=i.CityCode GROUP BY c.CityCode ORDER BY c.AsciiName";
                  $result = $pdo-> query($sql);
                      
                  while ($record = $result -> fetch()){
                        
                  echo '<option value='.$record["CityCode"].'>';
                  echo $record["AsciiName"];
                  echo "</option>";
                        
                  }
                ?>
              </select>   
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    
        <div class="panel panel-default">
            <?php 
              
              /*Checking type of filter*/ 
                if(!empty($_GET["country"])){
                  
                  $country= $_GET["country"];
                  $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE CountryCodeISO= :code";
                  $statement = $pdo->prepare($sql);
                  $statement->bindValue(':code',$country);
                  echo '<div class="panel-heading">Images [Country = '.$_GET["country"].']</div> <div class="panel-body">';
                }else if(!empty($_GET["continent"])){
                  $continent= $_GET["continent"];
                  $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE ContinentCode= :code";
                  $statement = $pdo->prepare($sql);
                  $statement->bindValue(':code',$continent);
                  echo '<div class="panel-heading">Images [Continent = '.$_GET["continent"].']</div> <div class="panel-body"> ';
                }else if (!empty($_GET["city"])){
                  $city= $_GET["city"];
                  $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE CityCode= :code";
                  $statement = $pdo->prepare($sql);
                  $statement->bindValue(':code',$city);
                  echo '<div class="panel-heading">Images [City = '.$_GET["city"].']</div> <div class="panel-body">';
                }else if (!empty($_GET["title"])){
                  $title= $_GET["title"];
                  $title = "%$title%";
                  $sql = "SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE Title LIKE :code";
                  $statement = $pdo->prepare($sql);
                  $statement->bindValue(':code',$title);
                  echo '<div class="panel-heading">Images [Title Like '.$_GET["title"].']</div><div class="panel-body">';
                }else{
                  $sql ="SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails";
                  $statement = $pdo->prepare($sql);
                }
                $statement->execute(); 
                if ($statement->rowCount() > 0){ 
                  echo '<div class="row">';
                  while ($record = $statement -> fetch()){
                    echo '<ul class="caption-style-2">';
                    echo '<div class="col-md-2"><li><a href="single-image.php?id='.$record["ImageID"].'" class="img-responsive">';
                    echo '<img src="images/square-medium/'.$record["Path"].'" alt="'.$record["Title"].'">';
                    echo '<div class="caption">';
                    echo '<div class="blur"></div>';
                    echo '<div class="caption-text">';
                    echo '<p>'.$record["Title"].'</p>';
                    echo '</div></div></div></a></li>'; 
                  }
                  echo '</ul> </div><div>';
                }else{
                    header('Location: error.php');
                }
              echo '<div>';
             ?>
            
      </main>
       <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
    
</body>

</html>