<?php 
    require 'user.php';

    $id = $_GET['user_id'];

    $user = new user();
    $result = $user->show_user($id);
    echo $result;
?>