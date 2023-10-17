<?php
class user
{
    static function show_user($id)
    {
        $query = 'SELECT * FROM users WHERE id_user=' . $id;
        require 'app_configuration.php';
        $result = mysqli_query($connect, $query);
        $user = mysqli_fetch_assoc($result);
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        if (!$user) {
            http_response_code(404);
            return json_encode([
                'status' => 404,
                'message' => "User not found"
            ]);
        }
        unset($user['password']);
        http_response_code(200);
        return json_encode($user);
    }
    static function show_users()
    {
        $query = 'SELECT * FROM users';
        require 'app_configuration.php';
        $result = mysqli_query($connect, $query);
        $users = [];
        while ($user = mysqli_fetch_assoc($result)) {
            $users[] = $user;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode($users);
    }
    static function change_email($id, $email)
    {
        require 'app_configuration.php';
        $stmt = mysqli_prepare($connect, 'UPDATE users SET email=(?) WHERE id_user=(?)') or die(error_get_last());
        mysqli_stmt_bind_param($stmt, 'sd', $email, $id);
        $ans = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        die(print_r($ans));
        if ($answ) {
            http_response_code(204);
            return null;
        } else {
            http_response_code('406');
            return json_encode([
                'code' => 406,
                'message' => 'Unsuccessfully'
            ]);
        }
    }
}


?>