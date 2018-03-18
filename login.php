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
    <div class="container">
        <div class='jumbotron'>
            <div class='row'>
                <form action="make-session.php" method="post" role="login">
                    <div class="form-group">
                        <?php 
                            if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'user') {
                                echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                echo 'User not found</div>';
                            } else if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'login') {
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                echo 'Please login to access your account</div>';
                            }
                        ?>
                        <label for='user'>Username</label>
                        <input type='text' name='user' class='form-control'>
                    </div>
                    <div class="form-group">
                        <?php
                            if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'password') {
                                echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                echo 'Incorrect Password</div>';
                            }
                        ?>
                        <label for='pword'>Password</label>
                        <input type='password' name='pword' class='form-control'>
                    </div>
                    <input type='submit' value='Login' class='form-control'>
                    
                </form>
            </div>
        </div>
    </div>
</body>

</html>