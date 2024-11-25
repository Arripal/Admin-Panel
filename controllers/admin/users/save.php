<?php
require('./Classes/Validation.php');
require('./Classes/Authentification.php');
require('./Classes/Database.php');
require('./Classes/Session.php');
$db_config = require('./db_config.php');

$session = new Session();
$db = new Database($db_config);
$validation = new Validation();

$auth->verify_admin_access();

$updated_user_data = $_POST;

$corresponding_logement = $db->fetch('SELECT * FROM public.user WHERE id = :id', [
    'id' => $updated_user_data['id']
]);

if (empty($corresponding_logement)) {
    $session->set_message('empty', 'Aucun utilisateur correspondant à votre demande.');
    redirect_to("location:javascript://history.go(-1)");
}

$is_valid_last_name = $validation->is_valid_length($updated_user_data['last_name']);
$is_valid_first_name = $validation->is_valid_length($updated_user_data['first_name']);
$is_valid_url = $validation->is_valid_URL($updated_user_data['cover']);
$is_valid_email = $validation->is_valid_email($updated_user_data['email']);
$is_valid_password = $validation->is_valid_password($updated_user_data['password']);
$is_valid_role = $validation->is_valid_role($updated_user_data['role']);

if (!$is_valid_last_name || !$is_valid_first_name || !$is_valid_url || !$is_valid_email || !$is_valid_password || !$is_valid_role) {
    redirect_to("location:javascript://history.go(-1)");
    die();
}

try {

    $full_name = $updated_user_data['first_name'] . ' ' . $updated_user_data['last_name'];
    //bcrypt password

    $db->db_query(
        'UPDATE public.logements SET 
                name = :name,
                password = :password,
                email = :email,
                picture = :picture,
                role = :role
            WHERE id = :id',
        [
            'id' => strip_tags($updated_user_data['id']),
            'name' => strip_tags($full_name),
            'password' => strip_tags($updated_user_data['passwors']),
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
