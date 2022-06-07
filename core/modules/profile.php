<?php
require_once('../db/config.php');

function AdminProfile($admin_id)
{

    $db = get_config();
    $getAdmin = $db->prepare("SELECT * FROM admin_table WHERE admin_id=:admin_id");
    $getAdmin->execute(['admin_id' => $admin_id]);
    $admin = $getAdmin->fetch();
    return $admin;
}

function UserProfile($user_id)
{

    $db = get_config();
    $getUser = $db->prepare("SELECT * FROM user_table WHERE user_id=:user_id");
    $getUser->execute(['user_id' => $user_id]);
    $user = $getUser->fetch();
    return $user;
}
