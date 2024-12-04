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
    $_SESSION['empty_user'] = 'Impossible d\éditer l\'utilisateur, aucune correspondance en base de données.';
    redirect_to("admin/dashboard/users/edit");
    die();
}

$validation->validate('first_name', $updated_user_data['first_name'], ['required']);
$validation->validate('last_name', $updated_user_data['last_name'], ['required']);
$validation->validate('picture', $updated_user_data['picture'], ['required', 'url']);
$validation->validate('email', $updated_user_data['email'], ['required', 'email']);
$validation->validate('role', $updated_user_data['role'], ['role', 'required']);
if ($updated_user_data['role'] === 'admin') {
    $validation->validate('password', $updated_user_data['password'], ['password']);
}
$is_valid = $validation->is_valid();

if (!$is_valid) {
    $errors = $validation->get_errors();
    $_SESSION['errors'] = $errors;
    redirect_to("admin/dashboard/users/edit");
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
