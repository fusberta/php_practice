<?php

function check_cookie()
{
    require 'app_configuration.php';
    $id_user = filter_input(INPUT_COOKIE, 'id_user', FILTER_VALIDATE_INT);
    $token = filter_input(
        INPUT_COOKIE,
        'token',
        FILTER_VALIDATE_REGEXP,
        array('options' => array('regexp' => '/^[0-9a-f]+$/'))
    );
    $query = "SELECT token FROM users WHERE id_user='{$id_user}'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    if ($token == $row['token']) {
        return $id_user;
    } else {
        return false;
    }
}

?>