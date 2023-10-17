<?php 
    require 'user.php';

    $user = new user();
    $result = $user->show_users();
    echo $result;
?>