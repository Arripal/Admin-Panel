<?php
require('./Classes/Validation.php');
require('./Classes/Authentification.php');
require('./Classes/Database.php');
require('./Classes/Session.php');
$db_config = require('./db_config.php');

$session = new Session();
$db = new Database($db_config);
$validation = new Validation();
$auth = new Authentification($db);


$email = $_POST['email'];
$password = $_POST['password'];



$are_valid_inputs = $validation->is_valid_email($email) && $validation->is_valid_password($password);

if (!$are_valid_inputs) {
    access_view('admin/login.view', [
        'invalid' => 'Les identifiants fournis sont incorrects.'
    ]);
    die();
}

$existing_admin = $auth->verify_existing_admin($email, $password);



if (!$existing_admin) {

    access_view('admin/login.view', [
        'invalid' => 'Les identifiants fournis sont incorrects.'
    ]);
    die();
}






$session->create_session([
    'role' => $existing_admin['role'],
    'admin_id' => $existing_admin['id']
]);

redirect_to('/admin/dashboard');
