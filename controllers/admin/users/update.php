<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
require_once('./Classes/UserValidation.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new UserValidation();

$updated_user_data = $_POST;

$corresponding_user = $db->fetch('SELECT * FROM public.user WHERE email = :email', [
    'email' => $updated_user_data['email']
]);

if (empty($corresponding_user)) {
    $_SESSION['empty_user'] = 'Impossible d\éditer l\'utilisateur, aucune correspondance en base de données.';
    redirect_to($_SERVER['HTTP_REFERER']);
    die();
}

$is_valid_user = $validation->validate_user($updated_user_data);

if (!$is_valid_user) {
    $_SESSION['errors'] = $validation->get_validation_errors();
    redirect_to($_SERVER['HTTP_REFERER']);
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
