<?php
require_once('../db/config.php');

function AdminLogin($admin_id, $admin_pass)
{
    $db = get_config();
    $query = "SELECT * FROM `admin_table` WHERE admin_id = :admin_id AND admin_password = :admin_pass";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            'admin_id' => $admin_id,
            'admin_pass' => $admin_pass
        )
    );
    $AdminStatus = $statement->rowCount();
    return $AdminStatus;
}

function UserLogin($user_id, $user_pass)
{
    $db = get_config();
    $query = "SELECT * FROM `user_table` WHERE user_id = :user_id AND user_password = :user_pass";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            'user_id' => $user_id,
            'user_pass' => $user_pass
        )
    );
    $UserStatus = $statement->rowCount();
    return $UserStatus;
}
