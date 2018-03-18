<?php
    unset($_COOKIE['user']);
    setCookie('user', '', -3600);
    header('Location: login.php');
?>