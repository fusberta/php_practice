<?php 
    require 'user.php';

    $id = $_GET['user_id'];
    $email = $_GET['email'];

    $user = new user();
    $user->change_email($id, $email);
?>