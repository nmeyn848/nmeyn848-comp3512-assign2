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
        <div class='panel panel-info'>
            <div class="panel panel-heading">Countries with Images</div>
                <div class='panel-body'>
                    <div class='row'>
                    <?php
                    
                        $sql = "SELECT c.CountryName, i.CountryCodeISO, c.ISO  FROM Countries c JOIN ImageDetails i ON (c.ISO=i.CountryCodeISO) GROUP BY CountryName";
                        $result = $pdo->query($sql);
                    
                        while ($record = $result -> fetch()){
                            echo "<div class='col-md-3'><a href='single-country.php?id=".$record["CountryCodeISO"]."'>".$record["CountryName"]."</a></div>";
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