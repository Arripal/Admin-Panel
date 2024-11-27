<?php
require('./Classes/Validation.php');
require('./Classes/Crypt.php');
require_once('./Classes/Database.php');
require_once('./Classes/Authentification.php');
$db_config = require('./db_config.php');
$session = new Session();
$validation = new Validation();
$db = new Database($db_config);
$auth = new Authentification($db);
$crypt = new Crypt();


$email = $_POST['email'];
$password = $_POST['password'];

$are_valid_inputs = $validation->is_valid_email($email) && $validation->is_valid_password($password);

if (!$are_valid_inputs) {
    access_view('admin/login.view', [
        'invalid' => 'Les identifiants fournis sont incorrects.'
    ]);
    die();
}

$existing_user = $db->fetch('SELECT * FROM public.user WHERE email = :email', [
    'email' => $email,
]);

if (!$existing_user || $existing_user['role'] !== 'ADMIN') {

    access_view('admin/login.view', [
        'invalid' => 'Les identifiants fournis sont incorrects.'
    ]);
    die();
}

$hashed_password = $existing_user['password'];
$matching_passwords = $crypt->password_decryption($password, $hashed_password);

if (!$matching_passwords) {
    access_view('admin/login.view', [
        'invalid' => 'Les identifiants fournis sont incorrects.'
    ]);
    die();
}

$session->create_session([
    'role' => $existing_user['role'],
    'admin_id' => $existing_user['id']
]);

redirect_to('/admin/dashboard');
