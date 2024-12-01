<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new Validation();

$updated_user_data = $_POST;

$corresponding_user = $db->fetch('SELECT * FROM public.user WHERE id = :id', [
    'id' => $updated_user_data['id']
]);

if (empty($corresponding_user)) {
    redirect_to("location:javascript://history.go(-1)");
}

$is_valid_password;
$is_valid_url = $validation->is_valid_URL($updated_user_data['picture']);
$is_valid_email = $validation->is_valid_email($updated_user_data['email']);
$is_valid_role = $validation->is_valid_role($updated_user_data['role']);
/*
if ($updated_user_data['role'] === strtoupper('admin')) {
    $is_valid_password =  $validation->is_valid_password($updated_user_data['password']);
}
*/
if (!$is_valid_url || !$is_valid_email  || !$is_valid_role) {
    redirect_to("location:javascript://history.go(-1)");
    die();
}

try {

    $full_name = $updated_user_data['first_name'] . ' ' . $updated_user_data['last_name'];

    $db->db_query(
        'UPDATE public.user SET 
                name = :name,
                password = :password,
                email = :email,
                picture = :picture,
                role = :role
            WHERE id = :id',
        [
            'id' => strip_tags($updated_user_data['id']),
            'name' => strip_tags($full_name),
            'password' => strip_tags($updated_user_data['password']),
            'email' => strip_tags($updated_user_data['email']),
            'picture' => strip_tags($updated_user_data['picture']),
            'role' => strip_tags($updated_user_data['role']),
        ]
    );

    redirect_to('/admin/dashboard/users');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
