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
            <div class="panel panel-heading">Users</div>
                <div class='panel-body'>
                    <div class='row'>
                        <?php
                            $sql = "SELECT FirstName, LastName, UserID  FROM Users GROUP BY UserID ORDER BY LastName";
                            $result = $pdo->query($sql);
                
                            while ($record = $result -> fetch()){
                                #didn't use utfencode() because of character issues.
                                echo "<div class='col-md-3'><a href='single-user.php?id=".$record["UserID"]."'>".$record["FirstName"]." ".$record["LastName"]."</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //taken from labs 
        include "includes/footer.inc.php"; ?>
</body>

</html>