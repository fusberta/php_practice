<?php

function handle_error($error_message, $system_error_message)
{
    header("Location: error.php?" . "error_message={$error_message}&" . "system_error_message={$system_error_message}");
    exit();
}

?>