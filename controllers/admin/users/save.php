<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
require_once('./Classes/Crypt.php');
$db_config = require('./db_config.php');
$crypt = new Crypt();
$db = new Database($db_config);
$validation = new Validation();

$user_data = $_POST;

$validation->validate('first_name', $user_data['first_name'], ['required']);
$validation->validate('last_name', $user_data['last_name'], ['required']);
$validation->validate('picture', $user_data['picture'], ['required', 'url']);
$validation->validate('email', $user_data['email'], ['email', 'required']);
$validation->validate('password', $user_data['password'], ['required', 'password']);
$validation->validate('role', $user_data['role'], ['role']);
$is_valid = $validation->is_valid();

if (!$is_valid) {
    $errors = $validation->get_errors();
    $_SESSION['errors'] = $errors;
    redirect_to($_SERVER['HTTP_REFERER']);
    die();
}

$user = $db->fetch("SELECT * FROM public.user WHERE email= :email ", [
    'email' => $user_data['email']
]);

if ($user) {
    $_SESSION['existing_user'] = 'Cette adresse mail est déjà utilisée.';
    redirect_to($_SERVER['HTTP_REFERER']);
    die();
}

try {

    $hashed_password = $crypt->password_encryption($user_data['password']);
    $full_name = $user_data['first_name'] . ' ' . $user_data['last_name'];

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
