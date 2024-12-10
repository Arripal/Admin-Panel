<?php
require('./Classes/Validation.php');
require('./Classes/Crypt.php');
require_once('./Classes/Database.php');
require_once('./Classes/Authentification.php');
require_once('./Classes/UserValidation.php');
$db_config = require('./db_config.php');
$session = new Session();
$validation = new UserValidation();
$db = new Database($db_config);
$auth = new Authentification();
$crypt = new Crypt();

$email = $_POST['email'];
$password = $_POST['password'];
$user_data = [$email, $password];

$is_valid_user = $validation->validate_user($user_data);

if (!empty($is_valid_user)) {
    access_view('admin/login.view', [
        'errors' => $validation->get_validation_errors()
    ]);
    die();
}

$existing_user = $db->fetch('SELECT * FROM public.user WHERE email = :email AND role = :role', [
    'email' => $email,
    'role' => 'admin'
]);

if (!$existing_user) {
    access_view('admin/login.view', [
        'user_error' => 'Les données fournies sont incorrectes.'
    ]);
    die();
}

$hashed_password = $existing_user['password'];
$matching_passwords = $crypt->password_decryption($password, $hashed_password);

if (!$matching_passwords) {
    access_view('admin/login.view', [
        'user_error' => 'Les données fournies sont incorrectes.'
    ]);
    die();
}

$session->create_session([
    'role' => $existing_user['role'],
    'admin_id' => $existing_user['id']
]);

redirect_to('/admin/dashboard');
