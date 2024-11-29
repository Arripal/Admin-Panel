<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
require_once('./Classes/Crypt.php');
$db_config = require('./db_config.php');
$crypt = new Crypt();
$db = new Database($db_config);
$validation = new Validation();

$user_data = $_POST;

$validation->validate('picture', $user_data['picture'], ['required', 'url']);
$validation->validate('email', $user_data['email'], ['email', 'required']);
$validation->validate('password', $user_data['password'], ['required', 'password']);
$validation->validate('role', $user_data['role'], ['role']);

if (!$is_valid_url || !$is_valid_email || !$is_valid_password || !$is_valid_role) {
    redirect_to('/admin/dashboard/not_found');
    die();
}

$user = $db->fetch("SELECT * FROM public.user WHERE email= :email ", [
    'email' => $user_data['email']
]);

if ($user) {
    echo 'EXISTE';
    die();
}

try {

    $full_name = $user_data['first_name'] . ' ' . $user_data['last_name'];
    $hashed_password = $crypt->password_encryption($user_data['password']);

    $db->db_query(
        'INSERT INTO public.user (
            name,
            password,
            email,
            picture,
            role
        ) VALUES (
            :name,
            :password,
            :email,
            :picture,
            :role
         )',
        [
            'name' => strip_tags($full_name),
            'password' => strip_tags($hashed_password),
            'email' => strip_tags($user_data['email']),
            'picture' => strip_tags($user_data['picture']),
            'role' => strip_tags($user_data['role']),
        ]
    );

    redirect_to('/admin/dashboard/users');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}