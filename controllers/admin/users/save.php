<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
require_once('./Classes/Crypt.php');
require_once('./Classes/UserValidation.php');
$db_config = require('./db_config.php');
$crypt = new Crypt();
$db = new Database($db_config);

$validation = new UserValidation();

$user_data = $_POST;
$is_valid_user = $validation->validate_user($user_data);

if (!$is_valid_user) {
    $_SESSION['errors'] = $validation->get_validation_errors();
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
